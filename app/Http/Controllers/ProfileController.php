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
    // 1) Validate the upload
    $request->validate([
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // 2) Fetch (or create) the single Logo record
    //    Since there's no user_id, just take the first row (or make a new one)
    $logoRecord = Logo::first();
    if (! $logoRecord) {
        $logoRecord = new Logo();
    }

    // 3) Handle file upload if present
    if ($request->hasFile('logo')) {
        // a) Delete old file if it exists
        if ($logoRecord->logo_path) {
            // Note the slash before the filename!
            $oldPath = public_path('dashboard/assets/images/logo/' . $logoRecord->logo_path);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        // b) Build new filename
        $file     = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();

        // c) Destination directory under public/
        //    e.g. C:\xampp\htdocs\photography\public\dashboard\assets\images\logo
        $destination = public_path('dashboard/assets/images/logo');

        // d) Create directory if it doesn’t exist
        if (! is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        // e) Move uploaded file into that folder
        try {
            $file->move($destination, $filename);
        } catch (\Exception $e) {
            return back()->withErrors([
                'logo' => 'Could not save the logo file: ' . $e->getMessage()
            ]);
        }

        // f) Save only the filename (we know it lives in /dashboard/assets/images/logo/)
        $logoRecord->logo_path = $filename;
    }

    // 4) Persist the Logo record
    $logoRecord->save();

    return back()->with('status', 'Logo updated successfully!');
}



}
