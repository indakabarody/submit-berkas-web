@extends('member.layouts.app')
@section('title')
Data Pengumuman
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
                        <div class="mt-3">
                            <ul class="message-list">
                                @foreach ($announcements as $announcement)
                                <li @empty ($announcement->read_at) class="unread" @endempty>
                                    <div class="col-mail col-mail-0">
                                        <a href="{{ route('member.announcements.show', $announcement->id) }}" class="title">{{ $announcement->title }}</a>
                                    </div>
                                    <div class="col-mail col-mail-2">
                                        <a href="{{ route('member.announcements.show', $announcement->id) }}" class="subject">{!! Str::limit($announcement->content, '50', '...') !!}</a>
                                        <div class="date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($announcement->created_at))->diffForHumans() }}</div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- end .mt-4 --}}
					</div>
					{{-- end card body--}}
				</div>
				{{-- end card --}}
			</div>
			{{-- end col--}}
		</div>
		{{-- end row--}}
	</div>
	{{-- container --}}
</div>
{{-- content --}}

@endsection
@section('page_styles')
    <link href="{{asset('themes/user/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/user/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/user/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/user/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('page_scripts')
    <script src="{{asset('themes/user/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('themes/user/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('themes/user/js/pages/datatables.init.js')}}"></script>

@endsection
