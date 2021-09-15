<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Intervention\Image\Facades\Image;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('name', 'ASC')->get();
        return view('admin.pages.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::all();
        return view('admin.pages.members.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
            'is_book_publisher' => 'nullable',
            'is_training_organizer' => 'nullable',
            'is_active_participant' => 'nullable',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Member::create([
            'province_id' => $request->province_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'address' => $request->address,
            'is_book_publisher' => $request->is_book_publisher ?? 0,
            'is_training_organizer' => $request->is_training_organizer ?? 0,
            'is_active_participant' => $request->is_active_participant ?? 0,
            'password' => Hash::make($request->password),
            'is_activated' => 1,
        ]);

        return redirect()->route('admin.members.index')->with('toast_success', 'Berhasil menambahkan member');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.pages.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $provinces = Province::all();
        return view('admin.pages.members.edit', compact('member', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'province_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,' . $member->id . ',id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:3000',
            'image_remove' => 'nullable',
            'phone' => 'required|numeric',
            'institution' => 'required|string|max:255',
            'address' => 'required|string|max:65535',
            'is_book_publisher' => 'nullable',
            'is_training_organizer' => 'nullable',
            'is_active_participant' => 'nullable',
            'is_activated' => 'nullable|numeric'
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

            Member::where('id', $member->id)->update([
                'image' => $fileName
            ]);
        }

        if ($request->image_remove != NULL) {
            if ($member->image != NULL) {
                File::delete('storage/member/images/'.$member->id.'/'.$member->image);
            }

            Member::where('id', $member->id)->update([
                'image' => NULL,
            ]);
        }

        Member::where('id', $member->id)->update([
            'province_id' => $request->province_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'address' => $request->address,
            'is_book_publisher' => $request->is_book_publisher ?? 0,
            'is_training_organizer' => $request->is_training_organizer ?? 0,
            'is_active_participant' => $request->is_active_participant ?? 0,
            'is_activated' => $request->is_activated ?? 0,
        ]);

        return redirect()->route('admin.members.index')->with('toast_success', 'Berhasil menyimpan member');
    }

    /**
     * Show the form for editing the password.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.pages.members.edit-password', compact('member'));
    }

    /**
     * Update the member password in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Member::where('id', $member->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.members.index')->with('toast_success', 'Berhasil menyimpan password');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrfail($id);

        $member->delete();

        return back()->with('toast_success', 'Berhasil menghapus member');
    }
}
