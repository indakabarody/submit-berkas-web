
@php
    $unreadCount = App\Models\Chat::where([
                    'admin_id' => $admin->id,
                    'member_id' => Auth::user()->id,
                    'is_from_member' => 0,
                    'is_from_admin' => 1,
                    'read_at' => NULL,
                ])->count();
@endphp

{{-- Left sidebar --}}
<div class="inbox-leftbar">
	<a href="{{ route('member.chats.create', $admin->id) }}" class="btn btn-danger w-100 waves-effect waves-light">Pesan Baru</a>
	<div class="mail-list mt-4">
		<a href="{{ route('member.chats.inbox', $admin->id) }}" @if ($unreadCount > 0) class="text-danger fw-bold" @endif ><i class="dripicons-inbox me-2"></i>Kotak Masuk @if ($unreadCount > 0) <span class="badge badge-soft-danger float-end ms-2">{{ $unreadCount }}</span> @endif </a>
		<a href="{{ route('member.chats.sent-messages', $admin->id) }}"><i class="dripicons-exit me-2"></i>Pesan Terkirim</a>
	</div>
</div>
{{-- End Left sidebar --}}
