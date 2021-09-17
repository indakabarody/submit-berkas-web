<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('member.pages.change-password.index');
    }

    public function update(Request $request)
    {
        $customer = Member::findOrFail(Auth::user()->id);

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Member::where('id', $customer->id)->update([
            'password' => Hash::make($request->password),
        ]);
    }


}
