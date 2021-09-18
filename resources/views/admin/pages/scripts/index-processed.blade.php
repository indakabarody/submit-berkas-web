@extends('admin.layouts.app')
@section('title')
Data Naskah Proses Review
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
                        <div class="mb-4"></div>
						<table id="basic-datatable" class="table dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th>No</th>
									<th>Naskah</th>
									<th>Member</th>
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
									<td>{{ $script->member->name }}</td>
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
                                                <a class="dropdown-item" href="{{ route('admin.scripts.show', $script->id) }}">Lihat Detail</a>
												<a class="dropdown-item" href="{{ route('admin.scripts.edit', $script->id) }}">Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDelete('{{ route('admin.scripts.destroy', $script->id) }}');">Hapus</a>
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

{{--begin::Modal Delete--}}
<div class="modal fade" tabindex="-1" id="deleteModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="deleteForm" method="POST">
				@csrf
				@method('DELETE')
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi Hapus Naskah</h5>
					{{--begin::Close--}}
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
						<span class="svg-icon svg-icon-2x">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
									<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
									<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"></rect>
								</g>
							</svg>
						</span>
					</div>
					{{--end::Close--}}
				</div>
				<div class="modal-body">
					<p>Yakin ingin menghapus Naskah?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-bs-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-primary">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>
{{--end::Modal Delete--}}
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
