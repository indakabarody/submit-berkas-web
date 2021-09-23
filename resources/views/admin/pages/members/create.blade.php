@extends('admin.layouts.app')

@section('title')
    Tambah Member
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

                        <form class="form-horizontal" action="{{ route('admin.members.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="inputName3" class="col-4 col-xl-3 col-form-label">Nama *</label>
                                <div class="col-8 col-xl-9">
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="inputName3"
                                        placeholder="Masukkan Nama">
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputProvince3" class="col-4 col-xl-3 col-form-label">Asal Provinsi *</label>
                                <div class="col-8 col-xl-9">
                                    <select class="form-control @error('province_id') is-invalid @enderror" data-toggle="select2" data-width="100%" name="province_id">
                                        <option value="">- Pilih Provinsi -</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->province }}</option>
                                        @endforeach
                                    </select>
                                    @error('province_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputInstitution3" class="col-4 col-xl-3 col-form-label">Institusi *</label>
                                <div class="col-8 col-xl-9">
                                    <input name="institution" type="text" class="form-control @error('institution') is-invalid @enderror" id="inputInstitution3"
                                        placeholder="Masukkan Nama Institusi/Organisasi/PT/Sekolah/Tempat Bekerja">
                                    @error('institution') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputAddress3" class="col-4 col-xl-3 col-form-label">Alamat *</label>
                                <div class="col-8 col-xl-9">
                                    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress3"
                                        placeholder="Masukkan Alamat Sesuai Identitas">
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Email *</label>
                                <div class="col-8 col-xl-9">
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail3"
                                        placeholder="Masukkan Email">
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPhone3" class="col-4 col-xl-3 col-form-label">No Telp *</label>
                                <div class="col-8 col-xl-9">
                                    <input name="phone" type="number" min="0" class="form-control @error('phone') is-invalid @enderror" id="inputPhone3"
                                        placeholder="Masukkan Nomor Telepon Aktif">
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword3"
                                    class="col-4 col-xl-3 col-form-label">Password *</label>
                                <div class="col-8 col-xl-9">
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword3"
                                        placeholder="Masukkan Password">
                                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword5" class="col-4 col-xl-3 col-form-label">Ulangi Password *</label>
                                <div class="col-8 col-xl-9">
                                    <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPassword5"
                                        placeholder="Ulangi Password">
                                    @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword5" class="col-4 col-xl-3 col-form-label">Daftar Sebagai</label>
                                <div class="col-8 col-xl-9">
                                    <div class="form-check">
                                        <input name="is_writer" type="checkbox" class="form-check-input" id="customCheck1" value="1">
                                        <label class="form-check-label" for="customCheck1">Penulis</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="is_training_member" type="checkbox" class="form-check-input" id="customCheck2" value="1">
                                        <label class="form-check-label" for="customCheck2">Member Diklat</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="is_reader" type="checkbox" class="form-check-input" id="customCheck3" value="1">
                                        <label class="form-check-label" for="customCheck2">Pembaca</label>
                                    </div>
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

<script src="{{asset('themes/user/js/pages/form-advanced.init.js')}}"></script>
@endsection
