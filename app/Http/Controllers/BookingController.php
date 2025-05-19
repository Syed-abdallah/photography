<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Promotion;
use App\Models\SalesAgent;
use Illuminate\Http\Request;
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
        $bookings = Booking::with(['service', 'promotion', 'salesAgent'])->get();
        return view('booking.index', compact('bookings'));
    }

    // public function calendar()
    // {
    //     return view('booking.calendar');
    // }

public function dashboard(Request $request)
{

   

$query = Booking::query();

// Apply date filters if they exist
if ($request->filled(['start_date', 'end_date'])) {
    $query->whereBetween('booking_date', [
        Carbon::parse($request->start_date)->startOfDay(), // Include entire start day
        Carbon::parse($request->end_date)->endOfDay()     // Include entire end day
    ]);
}

$bookings = $query->get();

// Calculate date range for display - use filtered dates if available
$startDate = $request->start_date 
    ? Carbon::parse($request->start_date)
    : ($bookings->isEmpty() ? now() : $bookings->min('booking_date'));

$endDate = $request->end_date
    ? Carbon::parse($request->end_date)
    : ($bookings->isEmpty() ? now() : $bookings->max('booking_date'));

// Calculate totals
$totalDeposit = $bookings->sum('deposit_amount');
$totalSales = $bookings->sum('sales_amount');

 if ($request->ajax()) {
            $events = Booking::all()
                ->map(function ($booking) {
                    return [
                        'id' => $booking->id,
                        'title' => $booking->services,
                        'name' => $booking->name,
                        'contact_number' => $booking->contact_number,
                        'email' => $booking->email,
                        'services' => $booking->services,
                        'no_of_guest' => $booking->no_of_guest,
                        'sales_amount' => $booking->sales_amount,
                        'status' => $booking->status,
                        'start' => $booking->booking_date . 'T' . $booking->start_time,
                        'end' => $booking->booking_date . 'T' . $booking->end_time,
                        'start_time' => $booking->start_time,
                        'end_time' => $booking->end_time,
                        'booking_date' => $booking->booking_date,
                        'deposit_amount' => $booking->deposit_amount,
                        'sales_agents' => $booking->sales_agents,
                        'booking_agent' => $booking->booking_agent
                    ];
                });

            return response()->json($events);
        }


    return view('dashboard' , compact('bookings', 'startDate', 'endDate', 'totalDeposit', 'totalSales'));
}

    public function create()
    {
        $services = Service::all();
        $promotions = Promotion::all();
        $salesAgents = SalesAgent::all();
        return view('booking.create', compact('services', 'promotions', 'salesAgents'));
    }



public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'contact_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'services' => 'required|exists:services,id',
        'no_of_guest' => 'required|integer|min:1',
        'promotions' => 'nullable|exists:promotions,id',
        'sales_agents' => 'required|exists:sales_agents,id',
        'booking_agent' => 'required|string|max:255',
        'deposit_amount' => 'required|numeric|min:0',
        'sales_amount' => 'required|numeric|min:0',
        'status' => 'required|string|in:pending,confirmed,cancelled,completed',
        'booking_date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time'
    ]);

    // Check if time is within working hours (9am-5pm)
    $start = Carbon::parse($validated['start_time']);
    $end = Carbon::parse($validated['end_time']);
    
    if ($start->lt('09:00') || $end->gt('17:00')) {
        session()->flash('toast', [
            'type' => 'error',
            'message' => 'Bookings must be between 9am and 5pm',
            'timer' => 5000,
            'bar' => true,
        ]);
        return back()
            ->withErrors(['time' => 'Bookings must be between 9am and 5pm'])
            ->withInput();
    }

    // Check for overlapping bookings (excluding cancelled ones)
    $overlappingBooking = Booking::where('booking_date', $validated['booking_date'])
        ->where('status', '!=', 'cancelled')
        ->where(function($query) use ($validated) {
            $query->where(function($q) use ($validated) {
                $q->where('start_time', '<', $validated['end_time'])
                  ->where('end_time', '>', $validated['start_time']);
            });
        })
        ->exists();

    if ($overlappingBooking) {
        session()->flash('toast', [
            'type' => 'error',
            'message' => 'This time slot is already booked. Please choose another time.',
            'timer' => 5000,
            'bar' => true,
        ]);
        return back()
            ->withErrors(['time' => 'This time slot is already booked. Please choose another time.'])
            ->withInput();
    }

    Booking::create($validated);

    session()->flash('toast', [
        'type' => 'success',
        'message' => 'Booking created successfully!',
        'timer' => 9000,
        'bar' => true,
    ]);
    
    return redirect()->back();
}
    public function edit(Booking $booking)
    {
        $services = Service::all();
        $promotions = Promotion::all();
        $salesAgents = SalesAgent::all();
        return view('booking.edit', compact('booking', 'services', 'promotions', 'salesAgents'));
    }

    // public function update(Request $request, Booking $booking)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'contact_number' => 'required|string|max:20',
    //         'email' => 'required|email|max:255',
    //         'services' => 'required|exists:services,id',
            
    //         'sales_agents' => 'required|exists:sales_agents,id',
    //         'no_of_guest' => 'required|integer|min:1',
    //         'promotions' => 'nullable|exists:promotions,id',
    //         'booking_agent' => 'required|string|max:255',
    //         'deposit_amount' => 'required|numeric|min:0',
    //         'sales_amount' => 'required|numeric|min:0',
    //         'status' => 'required|string|in:pending,confirmed,cancelled,completed',
    //         'start' => 'required|date',
    //         'end' => 'required|date|after:start'
    //     ]);
        
    //     // dd($request->all());
    //     $booking->update($validated);
    //     session()->flash('toast', [
    //         'type'    => 'success', //        
    //         'message' => 'Booking Updated successfully',
    //         'timer'   => 3000,                
    //         'bar'     => true,                 
    //     ]);
    //     return redirect()->back();
    // }

    public function update(Request $request, Booking $booking)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'contact_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'service_id' => 'required|exists:services,id',
        'sales_agent_id' => 'required|exists:sales_agents,id',
        'no_of_guest' => 'required|integer|min:1',
        'promotion_id' => 'nullable|exists:promotions,id',
        'booking_agent' => 'required|string|max:255',
        'deposit_amount' => 'required|numeric|min:0',
        'sales_amount' => 'required|numeric|min:0',
        'status' => 'required|string|in:pending,confirmed,cancelled,completed',
        'booking_date' => 'required|date|after_or_equal:today',
        'start_time' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) {
                if (strtotime($value) < strtotime('09:00') || strtotime($value) > strtotime('17:00')) {
                    $fail('The start time must be between 09:00 and 17:00.');
                }
            }
        ],
        'end_time' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) use ($request) {
                if (strtotime($value) < strtotime('09:00') || strtotime($value) > strtotime('17:00')) {
                    $fail('The end time must be between 09:00 and 17:00.');
                }
                if (strtotime($value) <= strtotime($request->start_time)) {
                    $fail('The end time must be after the start time.');
                }
            }
        ]
    ]);

    $booking->update($validated);

    session()->flash('toast', [
        'type' => 'success',
        'message' => 'Booking updated successfully',
        'timer' => 3000,
        'bar' => true,
    ]);

    return redirect()->back();
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


    public function updateStatus(Request $request, $bookingId)
{
    $booking = Booking::findOrFail($bookingId);
    
    $validStatuses = ['confirmed', 'pending', 'cancelled', 'completed'];
    
    if (!in_array($request->status, $validStatuses)) {
        return response()->json(['error' => 'Invalid status'], 400);
    }
    
    $booking->status = $request->status;
    $booking->save();
    
    return response()->json(['success' => true]);
}
}