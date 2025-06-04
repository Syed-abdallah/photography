<?php

namespace App\Http\Controllers;

use App\Models\SalesAgent;
use Illuminate\Http\Request;

class SaleAgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create saleagent')->only('create');
        $this->middleware('permission:view saleagent')->only('index');
        $this->middleware('permission:edit saleagent')->only('edit');
        $this->middleware('permission:update saleagent')->only('update');
        $this->middleware('permission:delete saleagent')->only('destroy');
    }
    public function index()
    {
        $saleAgents = SalesAgent::latest()->get();
        return view('sale_agents.index', compact('saleAgents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:sales_agents,email'
        ]);

        SalesAgent::create($request->all());

        session()->flash('toast', [
            'type'    => 'success', //        
            'message' => 'Sale Agent created successfully.',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('sale-agents.index');
    }

    public function show(SaleAgent $saleAgent)
    {
        return view('sale_agents.show', compact('saleAgent'));
    }

    public function edit(SaleAgent $saleAgent)
    {
        return view('sale_agents.edit', compact('saleAgent'));
    }

    public function update(Request $request, SalesAgent $saleAgent)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:sales_agents,email,'.$saleAgent->id
        ]);

        $saleAgent->update($request->all());
        session()->flash('toast', [
            'type'    => 'success', //        
            'message' => 'Sale Agent Updated successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('sale-agents.index');
    }

    public function destroy(SalesAgent $saleAgent)
    {
        $saleAgent->delete();
        session()->flash('toast', [
            'type'    => 'warning', //        
            'message' => 'Sale Agent deleted successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('sale-agents.index');
    }
}