@extends('admin.layouts.app')

@section('title')
    Detail Naskah
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

                        <div class="row mb-3">
                            <label for="inputTitle3" class="col-4 col-xl-3 col-form-label">Judul</label>
                            <div class="col-8 col-xl-9">
                                {{ $script->title }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputforeword3"
                                class="col-4 col-xl-3 col-form-label">Kata Pengantar</label>
                            <div class="col-8 col-xl-9">
                                {!! $script->foreword !!}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputReferences3" class="col-4 col-xl-3 col-form-label">Sumber Referensi</label>
                            <div class="col-8 col-xl-9">
                                {{ $script->references }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputReferences3" class="col-4 col-xl-3 col-form-label">File</label>
                            <div class="col-8 col-xl-9">
                                <a href="{{ asset('storage/member/scripts/'.$script->member_id.'/'.$script->file) }}">Klik untuk melihat</a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputforeword3"
                                class="col-4 col-xl-3 col-form-label">Status Review</label>
                            <div class="col-8 col-xl-9">
                                @if (isset($script->reviewed_at) && isset($script->done_reviewed_at))
                                    <span class="badge bg-soft-success text-success">Selesai</span>
                                @elseif (isset($script->reviewed_at) && empty($script->done_reviewed_at))
                                    <span class="badge bg-soft-primary text-primary">Proses</span>
                                @else
                                    <span class="badge bg-soft-warning text-warning">Pending</span>
                                @endif
                            </div>
                        </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
	</div>
	{{-- container --}}
</div>
{{-- content --}}

@endsection

@section('page_styles')
<link href="{{asset('themes/user/libs/mohithg-switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('themes/user/libs/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('themes/user/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('themes/user/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('themes/user/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('themes/user/libs/quill/quill.core.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('themes/user/libs/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('themes/user/libs/quill/quill.snow.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('page_scripts')
<script src="{{asset('themes/user/libs/selectize/js/standalone/selectize.min.js')}}"></script>
<script src="{{asset('themes/user/libs/mohithg-switchery/switchery.min.js')}}"></script>
<script src="{{asset('themes/user/libs/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{asset('themes/user/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('themes/user/libs/jquery-mockjax/jquery.mockjax.min.js')}}"></script>
<script src="{{asset('themes/user/libs/devbridge-autocomplete/jquery.autocomplete.min.js')}}"></script>
<script src="{{asset('themes/user/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('themes/user/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('themes/user/libs/quill/quill.min.js')}}"></script>
<script src="{{asset('themes/user/js/pages/form-quilljs.init.js')}}"></script>
<script src="{{asset('themes/user/js/pages/form-advanced.init.js')}}"></script>

<script>
    document.getElementById('snow-editor').addEventListener('keyup', function (event) {
        // alert(event.target.innerHTML);
        document.getElementById('foreword').value = event.target.innerHTML;
    });
</script>
@endsection
