@extends('admin.layouts.app')

@section('title')
    Edit Admin
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
                        <img src="@isset($admin->image) {{ asset('storage/admin/images/'.$admin->id.'/'.$admin->image) }} @else {{ asset('themes/user/images/users/blank.png') }} @endisset" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                        <h4 class="mb-0">{{ $admin->name }}</h4>
                        <p class="text-muted">{{ $admin->email }}</p>
                    </div>
                </div> {{-- end card --}}

            </div> {{-- end col--}}

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane active" id="settings">
                                <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Info Pribadi</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama *</label>
                                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan Nama" value="{{ $admin->name }}">
                                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email *</label>
                                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email" value="{{ $admin->email }}">
                                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div> {{-- end col --}}
                                    </div> {{-- end row --}}

                                    <div class="mb-3">
                                        <label for="example-fileinput" class="form-label">Ubah Foto (Opsional)</label>
                                        <input name="image" type="file" id="example-fileinput" class="form-control @error('image') is-invalid @enderror">
                                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    @if ($admin->id != Auth::user()->id)
                                        <div class="form-check form-switch">
                                            <input name="is_activated" type="checkbox" class="form-check-input" id="customSwitch1" value="1" @if ($admin->is_activated == 1) checked @endif>
                                            <label class="form-check-label" for="customSwitch1">Aktivasi Akun</label>
                                        </div>
                                    @endif

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Simpan</button>
                                    </div>
                                </form>
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

@endsection

@section('page_scripts')

@endsection
