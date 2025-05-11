<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create service')->only('create');
        $this->middleware('permission:view service')->only('index');
        $this->middleware('permission:edit service')->only('edit');
        $this->middleware('permission:update service')->only('update');
        $this->middleware('permission:delete service')->only('destroy');
    }

    public function index()
    {
        $services = Service::latest()->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
        ]);

        Service::create($request->only('name'));
        session()->flash('toast', [
            'type'    => 'warning', //        
            'message' => 'Service Created successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('services.index');
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:services,name,'.$service->id,
        ]);

        $service->update($request->only('name'));

        session()->flash('toast', [
            'type'    => 'warning',      
            'message' => 'Service Updated successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('services.index');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        session()->flash('toast', [
            'type'    => 'warning', //        
            'message' => 'Service deleted successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('services.index');
    }
}