<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class CalendarController extends Controller
{
   // In your CalendarController.php
// public function index(Request $request)
// {

//     $services = \App\Models\Service::all(); // Fetch all services
    
//     if($request->ajax()) {
//         $data = Booking::whereDate('booking_date', '>=', $request->start)
//                  ->whereDate('booking_date', '<=', $request->end)
//                  ->get()
//                  ->map(function ($booking) {
//                      return [
//                          'id' => $booking->id,
//                          'title' => $booking->name . ' - ' . $booking->services,
//                          'start' => $booking->booking_date->format('Y-m-d') . 'T' . $booking->start_time,
//                          'end' => $booking->booking_date->format('Y-m-d') . 'T' . $booking->end_time,
                  

//                      ];
//                  });

//         return response()->json($data);
//     }

//     return view('dashboard', compact('services'));
// }


public function index(Request $request)
{
    $services = \App\Models\Service::all(); // Fetch all services

    if ($request->ajax()) {
        // 1) Eager‐load statusRelation so we can read $booking->statusRelation->color without extra queries
        $data = Booking::with('statusRelation')
            ->whereDate('booking_date', '>=', $request->start)
            ->whereDate('booking_date', '<=', $request->end)
            ->get()
            ->map(function ($booking) {
                return [
                    'id'     => $booking->id,
                    'title'  => $booking->name . ' - ' . $booking->services,
                    'start'  => $booking->booking_date->format('Y-m-d') . 'T' . $booking->start_time,
                    'end'    => $booking->booking_date->format('Y-m-d') . 'T' . $booking->end_time,

                    // 2) Pull status name (if you want to display a badge or label in month view)
                    'status' => optional($booking->statusRelation)->name,

                    // 3) Pull the hex color from statuses.color (make sure it's stored as "#RRGGBB")
                    //    If there is no related status, fall back to a default (e.g. '#3788d8').
                    'color'  => optional($booking->statusRelation)->color ?? '#3788d8',
                ];
            });

        return response()->json($data);
    }

    return view('dashboard', compact('services'));
}

    // public function show($id)
    // {
    //     $booking = Booking::findOrFail($id);
    //     return response()->json($booking);
    // }
public function show($id)
{
    // 1) Eager‐load statusRelation so we can grab name/color in one query
    $booking = Booking::with('statusRelation')->findOrFail($id);

    // 2) Return exactly the fields your modal needs, including status & status_color
    return response()->json([
        'id'             => $booking->id,
        'booking_number' => $booking->booking_number,
        'status'         => optional($booking->statusRelation)->name,   // e.g. “pending”
        'status_color'   => optional($booking->statusRelation)->color,  // e.g. “#CCCCCC”
        'title'          => $booking->title,
        'name'           => $booking->name,
        'address'        => $booking->address,
        'post_code'      => $booking->post_code,
        'contact_number' => $booking->contact_number,
        'email'          => $booking->email,
        'deposit_amount' => $booking->deposit_amount,
        'pay_on_day'     => $booking->pay_on_day,
        'booking_date'   => $booking->booking_date->format('Y-m-d'),
        'start_time'     => $booking->start_time,
        'end_time'       => $booking->end_time,
        // …any other fields your modal uses…
    ]);
}

    public function ajax(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:50',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            // 'services' => 'required|exists:services,id',
        ]);

        switch ($request->type) {
            case 'add':
                $booking = Booking::create([
                    'name' => $validated['name'],
                    'title' => $validated['title'],
                    'email' => $validated['email'],
                    'contact_number' => $validated['contact_number'],
                    'booking_date' => $validated['booking_date'],
                    'start_time' => $validated['start_time'],
                    // 'services' => $validated['services'],
                    'status' => 1,
                    'payment_method' => 1,
                ]);

                return response()->json($booking);
                break;

            case 'update':
                $booking = Booking::find($request->id)->update([
                    'name' => $validated['name'],
                    'title' => $validated['title'],
                    'email' => $validated['email'],
                    'contact_number' => $validated['contact_number'],
                    'booking_date' => $validated['booking_date'],
                    'start_time' => $validated['start_time'],
                    // 'services' => $validated['services'],
                ]);

                return response()->json($booking);
                break;

            case 'delete':
                $booking = Booking::find($request->id)->delete();
                return response()->json($booking);
                break;

            default:
                break;
        }
    }

    // Add this to your CalendarController
public function search(Request $request)
{
    $query = $request->input('query');
    
    $bookings = Booking::where('name', 'like', "%$query%")
                ->orWhere('post_code', 'like', "%$query%")
                ->orWhere('booking_number', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->orWhere('contact_number', 'like', "%$query%")
                ->get(['id', 'name', 'email', 'contact_number', 'post_code', 'booking_date', 'start_time', 'booking_number']);
    
    return response()->json($bookings);
}


// public function destroy(Booking $booking)
// {
//     try {
//         $booking->delete();
//         return response()->json([
//             'success' => true,
//             'message' => 'Booking deleted successfully'
//         ]);
//     } catch (\Exception $e) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Error deleting booking: ' . $e->getMessage()
//         ], 500);
//     }
// }

public function destroy(Booking $booking)
{
    try {
        // 1) Find the ID of the status whose name is "cancelled" or "cancel"
        $cancelledId = \App\Models\Status::whereIn('name', ['cancelled', 'cancel'])
                          ->value('id');

        if (! $cancelledId) {
            return response()->json([
                'success' => false,
                'message' => 'No "cancelled" status found in the database.'
            ], 404);
        }

        // 2) Update the booking’s status to that ID
        $booking->update(['status' => $cancelledId]);

        return response()->json([
            'success' => true,
            'message' => 'Booking status updated to cancelled'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error updating status: ' . $e->getMessage()
        ], 500);
    }
}


}