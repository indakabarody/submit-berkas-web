@extends('admin.layouts.app')

@section('title')
    Edit Naskah
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

                        <form class="form-horizontal" action="{{ route('admin.scripts.update', $script->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="inputTitle3" class="col-4 col-xl-3 col-form-label">Judul *</label>
                                <div class="col-8 col-xl-9">
                                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="inputTitle3"
                                        placeholder="Masukkan Judul Naskah" value="{{ $script->title }}">
                                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputforeword3"
                                    class="col-4 col-xl-3 col-form-label">Kata Pengantar</label>
                                <div class="col-8 col-xl-9">
                                    <div id="snow-editor" style="height: 300px;">{!! $script->foreword !!}</div>
                                    <input type="hidden" name="foreword" id="foreword" value="{!! $script->foreword !!}">
                                    @error('foreword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputReferences3" class="col-4 col-xl-3 col-form-label">Sumber Referensi *</label>
                                <div class="col-8 col-xl-9">
                                    <input name="references" type="text" class="form-control @error('references') is-invalid @enderror" id="inputReferences3"
                                        placeholder="Masukkan Sumber Referensi" value="{{ $script->references }}">
                                    @error('references') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputStatus3" class="col-4 col-xl-3 col-form-label">Status Review *</label>
                                <div class="col-8 col-xl-9">
                                    <select class="form-control @error('status') is-invalid @enderror" data-toggle="select2" data-width="100%" name="status">
                                        <option value="">- Pilih Status -</option>
                                        <option value="Pending" @if ($script->reviewed_at == NULL && $script->done_reviewed_at == NULL) selected @endif>Pending</option>
                                        <option value="Proses" @if ($script->reviewed_at != NULL && $script->done_reviewed_at == NULL) selected @endif>Proses</option>
                                        <option value="Selesai" @if ($script->reviewed_at != NULL && $script->done_reviewed_at != NULL) selected @endif>Selesai</option>
                                    </select>
                                    @error('province_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="justify-content-end row">
                                <div class="col-8 col-xl-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                </div>
                            </div>
                        </form>

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
