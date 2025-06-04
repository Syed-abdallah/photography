<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Paymethod;
use App\Models\SalesAgent;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class BookingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create booking')->only('create');
        $this->middleware('permission:view booking')->only('index');
        $this->middleware('permission:edit booking')->only('edit');
        $this->middleware('permission:update booking')->only('update');
        $this->middleware('permission:delete booking')->only('destroy');
    }

    public function index()
    {
            $statuses = Status::all(); // Assuming you have a Status model

        $bookings = Booking::with(['service', 'promotion', 'salesAgent'])->get();
        return view('booking.index', compact('bookings','statuses'));
    }



    public function create()
    {
            $paymentMethods = Paymethod::all(); // Assuming you have a PayMethod model
    $statuses = Status::all(); // Assuming you have a Status model

        $services = Service::all();
        $promotions = Promotion::all();
        $salesAgents = SalesAgent::all();
            $bookingAgents = User::get(); // or whatever logic you use to get booking agents

 return view('booking.create', compact(
        'services',
        'promotions',
        'salesAgents',
        'statuses',
        'paymentMethods',
        'bookingAgents'
    ));   
 }






public function store(Request $request)
{
    // 1) Validate incoming data
    $validated = $request->validate([
        'booking_number'   => ['required', 'string', 'unique:bookings,booking_number'],
        'title'            => ['required', Rule::in(['Mr','Mrs','Miss','Ms','Dr'])],
        'name'             => ['required', 'string', 'max:255'],
        'contact_number'   => ['required', 'string', 'max:50'],
        'email'            => ['required', 'email', 'max:255'],
        'address'          => ['nullable', 'string', 'max:255'],
        'post_code'        => ['nullable', 'string', 'max:20'],
        'services'         => ['required', 'exists:services,id'],
        'no_of_guest'      => ['required', 'integer', 'min:1'],
        'booking_date'     => ['required', 'date', 'after_or_equal:today'],
        'start_time'       => ['required', 'date_format:H:i'],
        'deposit_amount'   => ['required', 'numeric', 'min:0'],
        'pay_on_day'       => ['nullable', 'numeric', 'min:0'],
        'payment_method'   => ['nullable', 'exists:paymethods,id'],
        'promotions'       => ['nullable', 'exists:promotions,id'],
        'sales_agents'     => ['required', 'exists:sales_agents,id'],
        'booking_agent'    => ['required', 'exists:users,id'],
        'status'           => ['required', 'string', 'max:50'],
    ]);

    // 2) Implement 12-minute slot system (5 slots per hour)
    $selectedTime = Carbon::createFromFormat('H:i', $validated['start_time']);
    $slotDate = Carbon::parse($validated['booking_date'])->format('Y-m-d');
    
    // Calculate which 12-minute slot this falls into
    $minutes = $selectedTime->format('i');
    $initialSlotNumber = floor($minutes / 12);
    $hour = $selectedTime->format('H');
    
    // Get all booked slots for this date and hour
    $bookedSlots = Booking::whereDate('booking_date', $slotDate)
        ->whereTime('start_time', '>=', "{$hour}:00:00")
        ->whereTime('start_time', '<', "{$hour}:59:59")
        ->pluck('start_time')
        ->map(function ($time) {
            return Carbon::parse($time)->format('H:i');
        })
        ->toArray();
    
    // Find the next available slot
    $slotNumber = $initialSlotNumber;
    $foundSlot = false;
    $attempts = 0;
    
    while (!$foundSlot && $attempts < 5) {
        // Calculate current slot start time (00, 12, 24, 36, 48 minutes)
        $currentSlotStart = sprintf("%02d:%02d", $hour, $slotNumber * 12);
        
        if (!in_array($currentSlotStart, $bookedSlots)) {
            $foundSlot = true;
            break;
        }
        
        // Move to next slot (wrap around if needed)
        $slotNumber = ($slotNumber + 1) % 5;
        $attempts++;
    }
    
    if (!$foundSlot) {
        return back()
            ->withInput()
            ->withErrors([
                'start_time' => "All slots for this hour are booked. Please choose another time."
            ]);
    }

    // 3) Create the booking with the available slot
    $finalSlotStart = sprintf("%02d:%02d", $hour, $slotNumber * 12);
    $finalSlotEnd = sprintf("%02d:%02d", $hour, ($slotNumber * 12) + 12);
    
    // Handle the case where end time crosses to next hour (e.g., 9:48-10:00)
    if (($slotNumber * 12 + 12) >= 60) {
        $finalSlotEnd = sprintf("%02d:00", $hour + 1);
    }

    // Check again if slot is available right before creating (race condition protection)
    $existingBooking = Booking::whereDate('booking_date', $slotDate)
        ->where('start_time', $finalSlotStart)
        ->exists();

    if ($existingBooking) {
        return back()
            ->withInput()
            ->withErrors([
                'start_time' => "This slot was just booked by someone else. Please try again."
            ]);
    }

    // Create the booking
    Booking::create([
        'booking_number'  => $validated['booking_number'],
        'title'           => $validated['title'],
        'name'            => $validated['name'],
        'contact_number'  => $validated['contact_number'],
        'email'           => $validated['email'],
        'address'         => $validated['address'],
        'post_code'       => $validated['post_code'],
        'services'        => $validated['services'],
        'no_of_guest'     => $validated['no_of_guest'],
        'booking_date'    => $slotDate,
        'start_time'      => $finalSlotStart,
        'end_time'        => $finalSlotEnd,
        'deposit_amount'  => $validated['deposit_amount'],
        'pay_on_day'      => $validated['pay_on_day'] ?? 0,
        'payment_method'  => $validated['payment_method'] ?? null,
        'promotions'      => $validated['promotions'] ?? null,
        'sales_agents'    => $validated['sales_agents'],
        'booking_agent'   => $validated['booking_agent'],
        'status'          => $validated['status'],
    ]);

 try {
        Mail::to($booking->email)
            ->send(new BookingConfirmation($booking));
    } catch (\Exception $e) {
        // If email fails, you can log or handle it gracefully.
        \Log::error("Booking confirmation email failed: " . $e->getMessage());
    }


    return redirect()
        ->route('bookings.index')
        ->with('success', "Booking created successfully for time slot {$finalSlotStart}-{$finalSlotEnd}.");
}



    public function edit(Booking $booking)
    {
                    $bookingAgents = User::get(); // or whatever logic you use to get booking agents
            $paymentMethods = Paymethod::all(); // Assuming you have a PayMethod model
        $statuses = Status::all();

        $services = Service::all();
        $promotions = Promotion::all();
        $salesAgents = SalesAgent::all();
        return view('booking.edit', compact('booking', 'services', 'promotions', 'salesAgents','paymentMethods','statuses','bookingAgents'));
    }


    public function update(Request $request, Booking $booking)
{
    // 1) Validate incoming data (same as store with some exceptions)
    $validated = $request->validate([
        'title'            => ['required', Rule::in(['Mr','Mrs','Miss','Ms','Dr'])],
        'name'             => ['required', 'string', 'max:255'],
        'contact_number'   => ['required', 'string', 'max:50'],
        'email'            => ['required', 'email', 'max:255'],
        'address'          => ['nullable', 'string', 'max:255'],
        'post_code'        => ['nullable', 'string', 'max:20'],
        'services'         => ['required', 'exists:services,id'],
        'no_of_guest'      => ['required', 'integer', 'min:1'],
        'booking_date'     => ['required', 'date', 'after_or_equal:today'],
        'start_time'       => ['required', 'date_format:H:i'],
        'deposit_amount'   => ['required', 'numeric', 'min:0'],
        'pay_on_day'       => ['nullable', 'numeric', 'min:0'],
        'payment_method'   => ['nullable', 'exists:paymethods,id'],
        'promotions'       => ['nullable', 'exists:promotions,id'],
        'sales_agents'     => ['required', 'exists:sales_agents,id'],
        'booking_agent'    => ['required', 'exists:users,id'],
        'status'           => ['required', 'string', 'max:50'],
    ]);

    // 2) Implement 12-minute slot system (5 slots per hour)
    $selectedTime = Carbon::createFromFormat('H:i', $validated['start_time']);
    $slotDate = Carbon::parse($validated['booking_date'])->format('Y-m-d');
    
    // Calculate which 12-minute slot this falls into
    $minutes = $selectedTime->format('i');
    $initialSlotNumber = floor($minutes / 12);
    $hour = $selectedTime->format('H');
    
    // Get all booked slots for this date and hour (excluding current booking)
    $bookedSlots = Booking::whereDate('booking_date', $slotDate)
        ->whereTime('start_time', '>=', "{$hour}:00:00")
        ->whereTime('start_time', '<', "{$hour}:59:59")
        ->where('id', '!=', $booking->id) // Exclude current booking
        ->pluck('start_time')
        ->map(function ($time) {
            return Carbon::parse($time)->format('H:i');
        })
        ->toArray();
    
    // Find the next available slot
    $slotNumber = $initialSlotNumber;
    $foundSlot = false;
    $attempts = 0;
    
    while (!$foundSlot && $attempts < 5) {
        // Calculate current slot start time (00, 12, 24, 36, 48 minutes)
        $currentSlotStart = sprintf("%02d:%02d", $hour, $slotNumber * 12);
        
        if (!in_array($currentSlotStart, $bookedSlots)) {
            $foundSlot = true;
            break;
        }
        
        // Move to next slot (wrap around if needed)
        $slotNumber = ($slotNumber + 1) % 5;
        $attempts++;
    }
    
    if (!$foundSlot) {
        return back()
            ->withInput()
            ->withErrors([
                'start_time' => "All slots for this hour are booked. Please choose another time."
            ]);
    }

    // 3) Calculate final slot times
    $finalSlotStart = sprintf("%02d:%02d", $hour, $slotNumber * 12);
    $finalSlotEnd = sprintf("%02d:%02d", $hour, ($slotNumber * 12) + 12);
    
    // Handle the case where end time crosses to next hour (e.g., 9:48-10:00)
    if (($slotNumber * 12 + 12) >= 60) {
        $finalSlotEnd = sprintf("%02d:00", $hour + 1);
    }

    // Check again if slot is available right before updating (race condition protection)
    $existingBooking = Booking::whereDate('booking_date', $slotDate)
        ->where('start_time', $finalSlotStart)
        ->where('id', '!=', $booking->id) // Exclude current booking
        ->exists();

    if ($existingBooking) {
        return back()
            ->withInput()
            ->withErrors([
                'start_time' => "This slot was just booked by someone else. Please try again."
            ]);
    }

    // 4) Update the booking
    $booking->update([
        'title'           => $validated['title'],
        'name'            => $validated['name'],
        'contact_number'  => $validated['contact_number'],
        'email'           => $validated['email'],
        'address'         => $validated['address'],
        'post_code'       => $validated['post_code'],
        'services'        => $validated['services'],
        'no_of_guest'     => $validated['no_of_guest'],
        'booking_date'    => $slotDate,
        'start_time'      => $finalSlotStart,
        'end_time'        => $finalSlotEnd,
        'deposit_amount'  => $validated['deposit_amount'],
        'pay_on_day'      => $validated['pay_on_day'] ?? 0,
        'payment_method'  => $validated['payment_method'] ?? null,
        'promotions'      => $validated['promotions'] ?? null,
        'sales_agents'    => $validated['sales_agents'],
        'booking_agent'   => $validated['booking_agent'],
        'status'          => $validated['status'],
    ]);

    session()->flash('toast', [
        'type' => 'success',
        'message' => 'Booking updated successfully',
        'timer' => 3000,
        'bar' => true,
    ]);

    return redirect()->route('bookings.index');
}


    public function destroy(Booking $booking)
    {
        $booking->delete();
        session()->flash('toast', [
            'type'    => 'warning', //        
            'message' => 'Booking deleted successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->back();
    }

    private function getStatusColor($status)
    {
        switch ($status) {
            case 'confirmed': return '#28a745';
            case 'cancelled': return '#dc3545';
            case 'completed': return '#17a2b8';
            default: return '#ffc107'; // pending
        }
    }



public function updateStatus(Booking $booking, Request $request)
{
    try {
        $validated = $request->validate([
            // “status” must match one of the existing rows in statuses.name
            'status' => 'required|string|exists:statuses,id'
        ]);

        // Now $validated['status'] is something like "confirmed" or "cancelled"
        $booking->update(['status' => $validated['status']]);

        // Reload the relation so you can return color & name
        $booking->load('statusRelation');

        return response()->json([
            'message' => 'Status updated successfully',
            'color'   => $booking->statusRelation->color,
            'name'    => $booking->statusRelation->name,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error updating status: ' . $e->getMessage()
        ], 500);
    }
}







//  public function calendar()
//     {
//         return view('dashboard');
//     }

//    public function calendarEvents(Request $request)
// {
//     try {
//         $request->validate([
//             'start' => 'required|date',
//             'end' => 'required|date',
//         ]);

//         $start = Carbon::parse($request->start)->startOfDay();
//         $end = Carbon::parse($request->end)->endOfDay();

//         $events = Booking::query()
//             ->whereBetween('booking_date', [$start, $end])
//             ->orderBy('booking_date')
//             ->orderBy('start_time')
//             ->get()
//             ->map(function ($booking) {
//                 return [
//                     'id' => $booking->id,
//                     'title' => $booking->title ?: "Booking #{$booking->booking_number}",
//                     'start' => $booking->booking_date->format('Y-m-d') . 'T' . $booking->start_time->format('H:i:s'),
//                     'extendedProps' => [
//                         'booking_number' => $booking->booking_number,
//                         'name' => $booking->name,
//                         'contact' => $booking->contact_number,
//                         'email' => $booking->email,
//                         'service' => optional($booking->service)->name ?? 'N/A',
//                         'guests' => $booking->no_of_guest,
//                         'status' => $booking->status,
//                         'deposit' => $booking->deposit_amount,
//                         'sales_agent' => optional($booking->salesAgent)->name ?? 'N/A',
//                         'booking_agent' => optional($booking->bookingAgent)->name ?? 'N/A',
//                     ],
//                     'color' => $this->getStatusColor($booking->status),
//                 ];
//             });

//         return response()->json($events);

//     } catch (\Exception $e) {
//         \Log::error('Calendar events error: ' . $e->getMessage());
//         return response()->json([], 500);
//     }
// }

 

   
}