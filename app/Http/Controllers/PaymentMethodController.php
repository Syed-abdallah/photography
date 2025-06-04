<?php

namespace App\Http\Controllers;

use App\Models\Paymethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create paymethods')->only('create');
        $this->middleware('permission:view paymethods')->only('index');
        $this->middleware('permission:edit paymethods')->only('edit');
        $this->middleware('permission:update paymethods')->only('update');
        $this->middleware('permission:delete paymethods')->only('destroy');
    }

    public function index()
    {
        $methods = Paymethod::latest()->get();
        return view('methods.index', compact('methods'));
    }

    public function create()
    {
        return view('methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:paymethods,name',
        ]);

        Paymethod::create($request->only('name'));

        session()->flash('toast', [
            'type'    => 'success',
            'message' => 'Payment Method created successfully',
            'timer'   => 3000,
            'bar'     => true,
        ]);

        return redirect()->route('methods.index');
    }

    public function edit(Paymethod $method)
    {
        return view('methods.edit', compact('method'));
    }

    public function update(Request $request, Paymethod $method)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:paymethods,name,'.$method->id,
        ]);

        $method->update($request->only('name'));
        
        session()->flash('toast', [
            'type'    => 'success',
            'message' => 'Payment Method updated successfully',
            'timer'   => 3000,
            'bar'     => true,
        ]);

        return redirect()->route('methods.index');
    }

    public function destroy(Paymethod $method)
    {
        $method->delete();

        session()->flash('toast', [
            'type'    => 'warning',
            'message' => 'Payment method deleted successfully',
            'timer'   => 3000,
            'bar'     => true,
        ]);

        return redirect()->route('methods.index');
    }
}