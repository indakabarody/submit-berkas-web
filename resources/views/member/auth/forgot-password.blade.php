@extends('member.layouts.auth')
@section('title')
Lupa Password Member
@endsection
@section('content')
<!-- Logo -->
<div class="auth-brand text-center text-lg-start">
    <div class="auth-logo">
        <a href="{{ route('home') }}" class="logo logo-dark text-center">
            <span class="logo-lg">
                <img src="{{ asset('logos/logo-dark.png') }}" alt="" height="22">
            </span>
        </a>
    </div>
</div>
{{-- title--}}
<h4 class="mt-0">@yield('title')</h4>
<p class="text-muted mb-4">Masukkan email Anda untuk mereset password.</p>
{{-- form --}}
<form action="{{ route('member.password.email') }}" method="POST">
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
{{-- end form--}}
{{-- Footer--}}
<footer class="footer footer-alt">
	<p class="text-muted">Kembali ke <a href="{{ route('member.login') }}" class="text-muted ms-1"><b>Login</b></a></p>
    <p class="text-muted"><a href="{{ route('admin.login') }}" class="text-muted ms-1"><b>Login Admin</b></a></p>
</footer>
@endsection
