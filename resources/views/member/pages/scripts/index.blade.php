@extends('member.layouts.app')
@section('title')
Semua Naskah Saya
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
                        <a href="{{ route('member.scripts.create') }}" class="btn btn-sm btn-blue waves-effect waves-light float-end">
                            <i class="mdi mdi-plus-circle"></i> Naskah Baru
                        </a>
                        <div class="mb-4"></div>
						<table id="basic-datatable" class="table w-100 nowrap">
							<thead>
								<tr>
									<th>No</th>
									<th>Naskah</th>
                                    <th>Status</th>
                                    <th>File Naskah</th>
									<th>Dibuat Pada</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($scripts as $script)
								<tr>
									<td>{{ $loop->iteration }}</td>
                                    <td>{{ $script->title }}</td>
                                    <td>
                                        @if (isset($script->reviewed_at) && isset($script->done_reviewed_at))
                                            <span class="badge bg-soft-success text-success">Selesai</span>
                                        @elseif (isset($script->reviewed_at) && empty($script->done_reviewed_at))
                                            <span class="badge bg-soft-primary text-primary">Proses</span>
                                        @else
                                            <span class="badge bg-soft-warning text-warning">Pending</span>
                                        @endif
                                    </td>
                                    <th><a href="{{ asset('storage/member/scripts/'.$script->member_id.'/'.$script->file) }}" target="_blank">Klik untuk melihat</a></th>
                                    <td>{{ date('d-m-Y', strtotime($script->created_at)) }}</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-sm btn-light dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
											<i class="mdi mdi-dots-horizontal font-18"></i>
											</button>
											<div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('member.scripts.show', $script->id) }}">Lihat Detail</a>
												<a class="dropdown-item" href="{{ route('member.scripts.edit', $script->id) }}">Edit</a>
											</div>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
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

    <script>
        function setDelete(action) {
            document.getElementById('deleteForm').action = action;
        }
    </script>
@endsection
