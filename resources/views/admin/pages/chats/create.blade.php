@extends('admin.layouts.app')
@section('title')
Pesan Baru ke {{ $member->name }}
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

                        @include('admin.pages.chats.sidebar')

                        <div class="inbox-rightbar">

                            <div class="mt-4">
                                <form action="{{ route('admin.chats.store', $member->id) }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <input name="subject" type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="Subjek">
                                        @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="mb-3 card border-0">
                                        <div id="snow-editor" style="height: 230px;"></div>
                                        <input type="hidden" name="message" id="message">
                                        @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"> <span>Kirim</span> <i class="mdi mdi-send ms-2"></i> </button>
                                        </div>
                                    </div>

                                </form>
                            </div> {{-- end card--}}

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
        document.getElementById('message').value = event.target.innerHTML;
    });
</script>
@endsection
