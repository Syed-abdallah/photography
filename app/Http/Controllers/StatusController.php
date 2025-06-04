<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create status')->only('create', 'store');
        $this->middleware('permission:view status')->only('index', 'show');
        $this->middleware('permission:edit status')->only('edit', 'update');
        $this->middleware('permission:delete status')->only('destroy');
    }

    public function index()
    {
        $statuses = Status::latest()->get();
        return view('status.index', compact('statuses')); // Fixed view path
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:statuses,name',
            'color' => 'required|string|max:7|regex:/^#[0-9A-F]{6}$/i',
        ]);

        Status::create([
            'name' => $request->name,
            'color' => $request->color,
        ]);

        return redirect()->route('status.index')
            ->with('success', 'Status created successfully');
    }

    public function update(Request $request, Status $status)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:statuses,name,'.$status->id,
            'color' => 'required|string|max:7|regex:/^#[0-9A-F]{6}$/i',
        ]);

        $status->update([
            'name' => $request->name,
            'color' => $request->color,
        ]);

        return redirect()->route('status.index')
            ->with('success', 'Status updated successfully');
    }

    public function destroy(Status $status)
    {
        $status->delete();

        return redirect()->route('status.index')
            ->with('warning', 'Status deleted successfully');
    }
}