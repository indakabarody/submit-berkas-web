@extends('admin.layouts.app')

@section('title')
    Detail Member
@endsection

@section('content')
<div class="content">
	{{-- Start Content--}}
	<div class="container-fluid">
        @include('includes.page-title')
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="@isset($member->image) {{ asset('storage/member/images/'.$member->id.'/'.$member->image) }} @else {{ asset('themes/user/images/users/blank.png') }} @endisset" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                        <h4 class="mb-0">{{ $member->name }}</h4>
                        <p class="text-muted">{{ $member->email }}</p>
                    </div>
                </div> {{-- end card --}}

            </div> {{-- end col--}}

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane active" id="settings">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Info Dasar</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama *</label>
                                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan Nama" value="{{ $member->name }}" disabled>
                                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div> {{-- end row --}}

                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-earth me-1"></i> Kontak</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email *</label>
                                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email" value="{{ $member->email }}" disabled>
                                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">No Telp *</label>
                                            <input name="phone" type="number" min="0" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Masukkan No Telp" value="{{ $member->phone }}" disabled>
                                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Alamat *</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Masukkan Alamat Sesuai Identitas" disabled>{{ $member->address }}</textarea>
                                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="province_id" class="form-label">Provinsi *</label>
                                            <select class="form-control @error('province_id') is-invalid @enderror" data-toggle="select2" data-width="100%" name="province_id" disabled>
                                                <option value="">- Pilih Provinsi -</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}" @if ($province->id == $member->province_id) selected @endif>{{ $province->province }}</option>
                                                @endforeach
                                            </select>
                                            @error('province_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Info Pekerjaan</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="institution" class="form-label">Institusi *</label>
                                            <input name="institution" type="text" class="form-control @error('institution') is-invalid @enderror" id="institution" placeholder="Masukkan Nama Institusi/Organisasi/PT/Sekolah/Tempat Bekerja" value="{{ $member->institution }}" disabled>
                                            @error('institution') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-information-outline me-1"></i> Info Lainnya</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Daftar Sebagai</label>
                                            <div class="form-check">
                                                <input name="is_writer" type="checkbox" class="form-check-input" id="customCheck1" value="1" @if ($member->is_writer == 1) checked @endif disabled>
                                                <label class="form-check-label" for="customCheck1">Penulis</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="is_training_member" type="checkbox" class="form-check-input" id="customCheck2" value="1" @if ($member->is_training_member == 1) checked @endif disabled>
                                                <label class="form-check-label" for="customCheck2">Member Diklat</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="is_reader" type="checkbox" class="form-check-input" id="customCheck3" value="1" @if ($member->reader == 1) checked @endif disabled>
                                                <label class="form-check-label" for="customCheck2">Pembaca</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Status Akun</label>
                                            <div class="form-check form-switch">
                                                <input name="is_activated" type="checkbox" class="form-check-input" id="customSwitch1" value="1" @if ($member->is_activated == 1) checked @endif disabled>
                                                <label class="form-check-label" for="customSwitch1">Aktivasi Akun</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end settings content--}}

                        </div> {{-- end tab-content --}}
                    </div>
                </div> {{-- end card--}}

            </div> {{-- end col --}}
        </div>
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
