<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  
use Spatie\Permission\Models\Role;  
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create user')->only('create');
        $this->middleware('permission:view user')->only('index');
        $this->middleware('permission:edit user')->only('edit');
        $this->middleware('permission:update user')->only('update');
        $this->middleware('permission:delete user')->only('destroy');
    }

    public function index()
    {
        $users = User::with('roles')->get();
        return view('user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,name',
        ]);
        
        $user->syncRoles($validated['roles'] ?? []);
        session()->flash('toast', [
            'type'    => 'warning', //        
            'message' => 'User Updated successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('toast', [
            'type'    => 'warning', //        
            'message' => 'User Deleted successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);
        return redirect()->route('user.index');
    }

   
}