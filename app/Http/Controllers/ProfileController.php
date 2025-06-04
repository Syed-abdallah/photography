<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;



use App\Models\Logo;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
      
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }




    
















public function logo(Request $request)
{

    $request->validate([
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'name' => 'nullable|string|max:255',
    ]);


    $logoRecord = Logo::first();
    if (! $logoRecord) {
        $logoRecord = new Logo();
    }


    if ($request->hasFile('logo')) {
  
        if ($logoRecord->logo_path) {
        
            $oldPath = public_path('dashboard/assets/images/logo/' . $logoRecord->logo_path);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }


        $file     = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();

      
        $destination = public_path('dashboard/assets/images/logo');

        if (! is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        try {
            $file->move($destination, $filename);
        } catch (\Exception $e) {
            return back()->withErrors([
                'logo' => 'Could not save the logo file: ' . $e->getMessage()
            ]);
        }

        $logoRecord->logo_path = $filename;
    }

       $logoRecord->name = $request->input('name');
    $logoRecord->save();

    return back()->with('status', 'Logo updated successfully!');
}



}
