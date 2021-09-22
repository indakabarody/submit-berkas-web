<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Chat;
use App\Notifications\NewChatNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display admins.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMembers()
    {
        $admins = Admin::all();
        return view('member.pages.chats.show-admins', compact('admins'));
    }

    /**
     * Display inboxes.
     *
     * @return \Illuminate\Http\Response
     */
    public function showInboxes($adminId)
    {
        $admin = Admin::findOrFail($adminId);
        $chats = Chat::where([
            'admin_id' => $admin->id,
            'member_id' => Auth::user()->id,
            'is_from_admin' => 1,
            'is_from_member' => 0,
        ])->orderBy('created_at', 'DESC')->get();

        return view('member.pages.chats.inbox', compact('chats'));
    }

    /**
     * Display sent messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSentMessages($memberId)
    {
        $admin = Admin::findOrFail($memberId);
        $chats = Chat::where([
            'admin_id' => $admin->id,
            'member_id' => Auth::user()->id,
            'is_from_admin' => 0,
            'is_from_member' => 1,
        ])->orderBy('created_at', 'DESC')->get();

        return view('member.pages.chats.sent-messages', compact('chats'));
    }

    /**
     * Show the form for creating a new message.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($adminId)
    {
        $admin = Admin::findOrFail($adminId);
        return view('member.pages.chats.create', compact('admin'));
    }

    /**
     * Send a new message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required|max:65535',
        ]);

        Chat::create([
            'member_id' => Auth::user()->id,
            'admin_id' => $admin->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_from_member' => 1,
            'is_from_admin' => 0,
        ]);

        $admin->notify(new NewChatNotification('admin'));

        return redirect()->route('member.chats.index')->with('toast_success', 'Berhasil mengirim pesan');
    }

    /**
     * Display the chat detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($adminId, $id)
    {
        $chat = Chat::where([
            'id' => $id,
            'admin_id' => $adminId,
            'member_id' => Auth::user()->id,
        ])->firstOrFail();

        if ($chat->read_at == NULL) {
            $chat->update([
                'read_at' => date('Y-m-d H:i:s')
            ]);
        }

        return view('member.pages.chats.show', compact('chat'));
    }

    /**
     * Show the form for replying message.
     *
     * @return \Illuminate\Http\Response
     */
    public function reply($adminId, $chatId)
    {
        $admin = Admin::firstOrFail($adminId);

        $chat = Chat::where([
            'id' => $chatId,
            'admin_id' => $admin->id,
            'is_from_member' => 0,
            'is_from_admin' => 1,
        ])->firstOrFail();

        return view('member.pages.chats.reply', compact('chat'));
    }
}
