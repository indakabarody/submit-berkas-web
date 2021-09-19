@extends('admin.layouts.auth')

@section('title')
    Reset Password Admin
@endsection

@section('content')
<div class="card bg-pattern">

    <div class="card-body p-4">

        <div class="text-center w-75 m-auto">
            <p class="text-muted mb-4 mt-3">Reset Password Anda.</p>
        </div>

        <form action="{{ route('admin.password.update') }}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mb-3">
                <label for="emailaddress" class="form-label">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="emailaddress" placeholder="Masukkan email" value="{{ $request->email ?? old('email') }}" required autocomplete="email">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <div class="input-group input-group-merge">
                    <input name="password" type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password" autocomplete="current-password" required>
                    <div class="input-group-text" data-password="false">
                        <span class="password-eye"></span>
                    </div>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Konfirmasi Password Baru</label>
                <div class="input-group input-group-merge">
                    <input name="password_confirmation" type="password" id="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password" placeholder="Masukkan password" autocomplete="current-password" required>
                    <div class="input-group-text" data-password="false">
                        <span class="password-eye"></span>
                    </div>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="text-center d-grid">
                <button class="btn btn-primary" type="submit"> Reset Password </button>
            </div>

        </form>

    </div> {{-- end card-body --}}
</div>
{{-- end card --}}

<div class="row mt-3">
    <div class="col-12 text-center">
        <p class="text-white-50">Kembali ke <a href="{{ route('admin.login') }}" class="text-white ms-1"><b>Log in</b></a></p>
    </div> {{-- end col --}}
</div>
{{-- end row --}}
@endsection
