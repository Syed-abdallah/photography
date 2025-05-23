<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create permission')->only('create');
        $this->middleware('permission:view permission')->only('index');
        $this->middleware('permission:edit permission')->only('edit');
        $this->middleware('permission:update permission')->only('update');
        $this->middleware('permission:delete permission')->only('destroy');
    }

    public function index()
    {
        $permissions = Permission::latest()->get();
        return view('permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create($request->only('name'));
        session()->flash('toast', [
            'type'    => 'success', //        
            'message' => 'Permission created successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);

        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,'.$permission->id,
        ]);

        $permission->update($request->only('name'));
        session()->flash('toast', [
            'type'    => 'success', //        
            'message' => 'Permission Updated successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('toast', [
            'type'    => 'warning', //        
            'message' => 'Permission deleted successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}