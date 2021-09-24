@extends('admin.layouts.auth')

@section('title')
    Login Admin
@endsection

@section('content')
<div class="card bg-pattern">

    <div class="card-body p-4">

        <div class="text-center w-75 m-auto">
            <div class="auth-logo">
                <a href="{{ route('home') }}" class="logo logo-dark text-center">
                    <span class="logo-lg">
                        <img src="{{ asset('logos/logo-dark.png') }}" alt="" height="45">
                    </span>
                </a>
            </div>
            <p class="text-muted mb-4 mt-3">Masukkan email and password Anda untuk mengakses menu di Admin.</p>
        </div>

        <form method="POST">
            @csrf

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="emailaddress" class="form-label">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="emailaddress" required="" value="{{ old('email') }}" autofocus placeholder="Masukkan email">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password" autocomplete="current-password" required>
                    <div class="input-group-text" data-password="false">
                        <span class="password-eye"></span>
                    </div>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember">
                    <label class="form-check-label" for="checkbox-signin">Ingat Saya</label>
                </div>
            </div>

            <div class="text-center d-grid">
                <button class="btn btn-primary" type="submit"> Log In </button>
            </div>

        </form>

    </div> {{-- end card-body --}}
</div>
{{-- end card --}}

<div class="row mt-3">
    <div class="col-12 text-center">
        <p> <a href="{{ route('admin.password.request') }}" class="text-white-50 ms-1">Lupa password?</a></p>
        <p> <a href="{{ route('member.login') }}" class="text-white-50 ms-1">Login Member</a></p>
    </div> {{-- end col --}}
</div>
{{-- end row --}}
@endsection
