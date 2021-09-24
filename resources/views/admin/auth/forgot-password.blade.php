@extends('admin.layouts.auth')

@section('title')
    Lupa Password Admin
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
            <p class="text-muted mb-4 mt-3">Masukkan email Anda untuk mereset password.</p>
        </div>

        <form action="{{ route('admin.password.email') }}" method="POST">
            @csrf

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="emailaddress" class="form-label">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="emailaddress" required="" placeholder="Masukkan email">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
        <p> <a href="{{ route('member.login') }}" class="text-white-50 ms-1">Login Member</a></p>
    </div> {{-- end col --}}
</div>
{{-- end row --}}
@endsection
