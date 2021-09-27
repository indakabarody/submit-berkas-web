<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Province;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $provinces = Province::all();
        return view('member.auth.register', compact('provinces'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'province_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'phone' => 'required|numeric',
            'institution' => 'required|string|max:255',
            'address' => 'required|string|max:65535',
            'is_writer' => 'nullable',
            'is_training' => 'nullable',
            'is_internship' => 'nullable',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $member = Member::create([
            'province_id' => $request->province_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'address' => $request->address,
            'is_writer' => $request->is_writer ?? 0,
            'is_training' => $request->is_training ?? 0,
            'is_internship' => $request->is_internship ?? 0,
            'password' => Hash::make($request->password),
            'is_activated' => 1,
        ]);

        event(new Registered($member));

        Auth::guard('member')->login($member);

        return redirect()->route('member.dashboard');
    }
}
