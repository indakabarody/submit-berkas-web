@extends('admin.layouts.app')
@section('title')
Detail Pesan
@endsection
@section('content')
<div class="content">
	{{-- Start Content--}}
	<div class="container-fluid">
        @include('includes.page-title')
		<div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @include('member.pages.chats.sidebar')

                        <div class="inbox-rightbar">

                            <div class="mt-4">
                                <h5 class="font-18">{{ $chat->subject }}</h5>

                                <hr/>

                                <div class="d-flex align-items-start mb-3 mt-1">
                                    <img class="d-flex me-2 rounded-circle" src="@if ($chat->is_from_admin == 1) {{ asset('storage/admin/images/'.$chat->admin->id.'/'.$chat->admin->image) }} @else {{ asset('storage/member/images/'.$chat->member->id.'/'.$chat->member->image) }} @endif" alt="placeholder image" height="32">
                                    <div class="w-100">
                                        <small class="float-end">{{ date('d-m-Y H:i', strtotime($chat->created_at)) }}</small>
                                        <h6 class="m-0 font-14">@if ($chat->is_from_admin == 1) {{ $chat->admin->name }} @else {{ $chat->member->name }} @endif</h6>
                                        <small class="text-muted">@if ($chat->is_from_admin == 1) {{ $chat->admin->email }} @else {{ $chat->member->email }} @endif</small>
                                    </div>
                                </div>

                                {!! $chat->message !!}

                                <div class="mt-5">
                                    <a href="{{ route('member.chats.reply', ['chat' => $chat->id, 'admin' => $chat->admin_id]) }}" class="btn btn-secondary me-2"><i class="mdi mdi-reply me-1"></i> Balas</a>
                                </div>

                            </div>
                            {{-- end .mt-4 --}}

                        </div>
                        {{-- end inbox-rightbar--}}

                    <div class="clearfix"></div>
                    </div>
                </div> {{-- end card --}}

            </div> {{-- end Col --}}
			{{-- end col--}}
		</div>
		{{-- end row--}}
	</div>
	{{-- container --}}
</div>
{{-- content --}}

@endsection

@section('page_styles')
@endsection

@section('page_scripts')
@endsection
