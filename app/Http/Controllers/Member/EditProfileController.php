<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class EditProfileController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return view('member.pages.edit-profile.index', compact('provinces'));
    }

    public function update(Request $request)
    {
        $member = Member::findOrFail(Auth::user()->id);

        $request->validate([
            'province_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,' . $member->id . ',id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:3000',
            'image_remove' => 'nullable',
            'phone' => 'required|numeric',
            'institution' => 'required|string|max:255',
            'address' => 'required|string|max:65535',
            'is_writer' => 'nullable',
            'is_training_member' => 'nullable',
            'is_reader' => 'nullable',
        ]);

        if ($request->image != NULL) {
            $path = 'storage/member/images/' . $member->id;

            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true);
            }

            $file = $request->file('image');
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $img = Image::make($file)->save($path . '/' . $fileName);

            $img->fit(600);
            $img->save($path . '/' . $fileName);

            $member->update([
                'image' => $fileName
            ]);
        }

        if ($request->image_remove != NULL) {
            if ($member->image != NULL) {
                File::delete('storage/member/images/'.$member->id.'/'.$member->image);
            }

            $member->update([
                'image' => NULL,
            ]);
        }

        if ($request->email != $member->email) {
            $member->update([
                'email_verified_at' => NULL
            ]);
        }

        $member->update([
            'province_id' => $request->province_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'address' => $request->address,
            'is_writer' => $request->is_writer ?? 0,
            'is_training_member' => $request->is_training_member ?? 0,
            'is_reader' => $request->is_reader ?? 0,
        ]);

        return redirect()->back()->with('toast_success', 'Berhasil menyimpan profil');
    }
}
