<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create promotion')->only('create');
        $this->middleware('permission:view promotion')->only('index');
        $this->middleware('permission:edit promotion')->only('edit');
        $this->middleware('permission:update promotion')->only('update');
        $this->middleware('permission:delete promotion')->only('destroy');
    }

    public function index()
    {
        $promotions = Promotion::latest()->get();
        return view('promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('dashboard.promotions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:promotions,name',
        ]);

        Promotion::create($request->only('name'));

        return redirect()->route('promotions.index')
            ->with('success', 'Promotion created successfully.');
    }

    public function show(Promotion $promotion)
    {
        return view('dashboard.promotions.show', compact('promotion'));
    }

    public function edit(Promotion $promotion)
    {
        return view('dashboard.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:promotions,name,'.$promotion->id,
        ]);

        $promotion->update($request->only('name'));

        return redirect()->route('promotions.index')
            ->with('success', 'Promotion updated successfully.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('promotions.index')
            ->with('success', 'Promotion deleted successfully.');
    }
}