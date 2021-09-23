<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Member;
use App\Notifications\NewChatNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display members.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMembers()
    {
        $members = Member::all();
        return view('admin.pages.chats.show-members', compact('members'));
    }

    /**
     * Display inboxes.
     *
     * @return \Illuminate\Http\Response
     */
    public function showInboxes($memberId)
    {
        $member = Member::findOrFail($memberId);
        $chats = Chat::where([
            'admin_id' => Auth::user()->id,
            'member_id' => $member->id,
            'is_from_admin' => 0,
            'is_from_member' => 1,
        ])->orderBy('created_at', 'DESC')->get();

        return view('admin.pages.chats.inbox', compact('member', 'chats'));
    }

    /**
     * Display sent messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSentMessages($memberId)
    {
        $member = Member::findOrFail($memberId);
        $chats = Chat::where([
            'admin_id' => Auth::user()->id,
            'member_id' => $member->id,
            'is_from_admin' => 1,
            'is_from_member' => 0,
        ])->orderBy('created_at', 'DESC')->get();

        return view('admin.pages.chats.sent-messages', compact('member', 'chats'));
    }

    /**
     * Show the form for creating a new message.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($memberId)
    {
        $member = Member::findOrFail($memberId);
        return view('admin.pages.chats.create', compact('member'));
    }

    /**
     * Send a new message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required|max:65535',
        ]);

        Chat::create([
            'member_id' => $member->id,
            'admin_id' => Auth::user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_from_member' => 0,
            'is_from_admin' => 1,
        ]);

        $member->notify(new NewChatNotification('member'));

        return redirect()->route('admin.chats.inbox', $member->id)->with('toast_success', 'Berhasil mengirim pesan');
    }

    /**
     * Display the chat detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($memberId, $id)
    {
        $member = Member::findOrFail($memberId);

        $chat = Chat::where([
            'id' => $id,
            'admin_id' => Auth::user()->id,
            'member_id' => $member->id,
        ])->firstOrFail();

        if ($chat->read_at == NULL && $chat->is_from_member == 1) {
            $chat->update([
                'read_at' => date('Y-m-d H:i:s')
            ]);
        }

        return view('admin.pages.chats.show', compact('member', 'chat'));
    }

    /**
     * Show the form for replying message.
     *
     * @return \Illuminate\Http\Response
     */
    public function reply($memberId, $chatId)
    {
        $member = Member::findOrFail($memberId);

        $chat = Chat::where([
            'id' => $chatId,
            'member_id' => $member->id,
        ])->firstOrFail();

        return view('admin.pages.chats.reply', compact('member', 'chat'));
    }
}
