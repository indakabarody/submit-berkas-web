<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Member;
use App\Notifications\NewAnnouncementNotification;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::orderBy('name', 'ASC')->get();
        return view('admin.pages.announcements.create', compact('members'));
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
            'member_id' => 'required',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:65535',
        ]);

        foreach ($request->member_id as $memberId) {
            Announcement::create([
                'member_id' => $memberId,
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        foreach ($request->member_id as $memberId) {
            $member = Member::find($memberId);

            $member->notify(new NewAnnouncementNotification($member->name));
        }

        return redirect()->route('admin.announcements.index')->with('toast_success', 'Berhasil menambahkan pengumuman');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.pages.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        $members = Member::orderBy('name', 'ASC')->get();
        return view('admin.pages.announcements.edit', compact('announcement', 'members'));
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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:65535',
        ]);

        Announcement::findOrFail($id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.announcements.index')->with('toast_success', 'Berhasil menyimpan pengumuman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Announcement::findOrFail($id)->delete();
        return redirect()->route('admin.announcements.index')->with('toast_success', 'Berhasil menghapus pengumuman');
    }
}
