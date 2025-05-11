<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Promotion;
use App\Models\SalesAgent;
use Illuminate\Http\Request;

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

    public function dashboard()
    {
        if (request()->ajax()) {
        $start = (!empty($_GET["start"])) ? $_GET['start'] : ('');
        $end = (!empty($_GET["end"])) ? ($_GET['end']) : ('');
      

        $events = Booking::whereDate('start', '>=', $start)
                     ->whereDate('end', '<=', $end)
                     ->get(['id', 'name', 'start', 'end']);

        return response()->json($events);
    }

        return view('dashboard');
       
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
            'start' => 'required|date',
            'end' => 'required|date|after:start'
        ]);

        Booking::create($validated);


        session()->flash('toast', [
            'type'    => 'success', //        
            'message' => 'Booking Created successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
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

    public function update(Request $request, Booking $booking)
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
            'start' => 'required|date',
            'end' => 'required|date|after:start'
        ]);

        $booking->update($validated);
        session()->flash('toast', [
            'type'    => 'success', //        
            'message' => 'Booking Updated successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('bookings.calendar');
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
        return redirect()->route('bookings.calendar');
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
}