<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class CalendarController extends Controller
{
   // In your CalendarController.php
public function index(Request $request)
{
    $services = \App\Models\Service::all(); // Fetch all services
    
    if($request->ajax()) {
        $data = Booking::whereDate('booking_date', '>=', $request->start)
                 ->whereDate('booking_date', '<=', $request->end)
                 ->get()
                 ->map(function ($booking) {
                     return [
                         'id' => $booking->id,
                         'title' => $booking->name . ' - ' . $booking->services,
                         'start' => $booking->booking_date->format('Y-m-d') . 'T' . $booking->start_time,
                         'end' => $booking->booking_date->format('Y-m-d') . 'T' . $booking->end_time,
                     ];
                 });

        return response()->json($data);
    }

    return view('dashboard', compact('services'));
}

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return response()->json($booking);
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


public function destroy(Booking $booking)
{
    try {
        $booking->delete();
        return response()->json([
            'success' => true,
            'message' => 'Booking deleted successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error deleting booking: ' . $e->getMessage()
        ], 500);
    }
}
}