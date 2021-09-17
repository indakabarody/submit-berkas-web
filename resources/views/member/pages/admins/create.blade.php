@extends('admin.layouts.app')

@section('title')
    Tambah Admin
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

                        <form class="form-horizontal" action="{{ route('admin.admins.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="inputName3" class="col-4 col-xl-3 col-form-label">Nama</label>
                                <div class="col-8 col-xl-9">
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="inputName3"
                                        placeholder="Masukkan Nama">
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Email</label>
                                <div class="col-8 col-xl-9">
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail3"
                                        placeholder="Masukkan Email">
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3"
                                    class="col-4 col-xl-3 col-form-label">Password</label>
                                <div class="col-8 col-xl-9">
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword3"
                                        placeholder="Masukkan Password">
                                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword5" class="col-4 col-xl-3 col-form-label">Ulangi Password</label>
                                <div class="col-8 col-xl-9">
                                    <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPassword5"
                                        placeholder="Ulangi Password">
                                    @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
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

@endsection

@section('page_scripts')

@endsection
