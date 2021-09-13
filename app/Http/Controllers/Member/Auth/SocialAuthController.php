<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Handle an incoming social authentication.
     *
     * @param  $driver
     * @return Laravel\Socialite\Facades\Socialite
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function redirectToProvider($driver)
    {
        switch ($driver) {
            case 'facebook':
                return Socialite::driver($driver)->redirect();
                break;

            case 'google':
                return Socialite::driver($driver)->setScopes(['openid', 'email'])->redirect();
                break;

            default:
                abort(404);
                break;
        }
    }

    /**
     * Handle a social provider callback authentication.
     *
     * @param  $driver
     * @return view
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handleProviderCallback($driver)
    {
        $user = Socialite::driver($driver)->stateless()->user();

        switch ($driver) {
            case 'facebook':
                $member = Member::where('facebook_id', $user->id)->orWhere('email', $user->email)->first();
                break;

            case 'google':
                $member = Member::where('google_id', $user->id)->orWhere('email', $user->email)->first();
                break;

            default:
                abort(404);
                break;
        }

        if ($member) {
            switch ($driver) {
                case 'facebook':
                    if ($member->facebook_id != $user->id) {
                        $member->update([
                            'facebook_id' => $user->id,
                        ]);
                    }
                    break;

                case 'google':
                    if ($member->google_id != $user->id) {
                        $member->update([
                            'google_id' => $user->id,
                        ]);
                    }
                    break;

                default:
                    abort(404);
                    break;
            }

            Auth::guard('member')->login($member);
            return redirect()->intended(route('member.dashboard'));
        } else {
            switch ($driver) {
                case 'facebook':
                    return view('member.auth.facebook-register', compact('user'));
                    break;

                case 'google':
                    return view('member.auth.google-register', compact('user'));
                    break;

                default:
                    abort(404);
                    break;
            }
        }
    }

    /**
     * Handle an incoming social registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'facebook_id' => 'nullable|string|max:255',
            'google_id' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'phone' => 'required|numeric',
            'institution' => 'required|max:255',
        ]);

        $member = Member::create([
            'facebook_id' => $request->facebook_id,
            'google_id' => $request->google_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'password' => Hash::make(date('YmdHis')),
            'is_activated' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        event(new Registered($member));

        Auth::guard('member')->login($member);

        return redirect()->route('member.dashboard');
    }
}
