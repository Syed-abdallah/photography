<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Promotion;
use App\Models\SalesAgent;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['service', 'promotion', 'salesAgent'])->get();
        return view('booking.index', compact('bookings'));
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
        ]);
        // dd($request->all());

        Booking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    public function edit(Booking $booking)
    {
        $services = Service::all();
        $promotions = Promotion::all();
        $salesAgents = SalesAgent::all();
        return view('booking.edit', compact('booking', 'services', 'promotions', 'salesAgents'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'service_id' => 'required|exists:services,id',
            'no_of_guest' => 'required|integer|min:1',
            'promotion_id' => 'nullable|exists:promotions,id',
            'sales_agent_id' => 'required|exists:sales_agents,id',
            'booking_agent' => 'required|string|max:255',
            'deposit_amount' => 'required|numeric|min:0',
            'sales_amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,confirmed,cancelled,completed',
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully!');
    }
}