<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password != '' && $request->password == $request->password_confirmation) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
