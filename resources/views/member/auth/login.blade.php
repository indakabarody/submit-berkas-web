@extends('member.layouts.auth')
@section('title')
Login Member
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
<p class="text-muted mb-4">Masukkan email dan password Anda untuk melakukan login.</p>
{{-- form --}}
<form method="POST">
    @csrf

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

	<div class="mb-3">
		<label for="emailaddress" class="form-label">Email</label>
		<input name="email" class="form-control @error('email') is-invalid @enderror" type="email" id="emailaddress" required="" placeholder="Masukkan email">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
	</div>
	<div class="mb-3">
		<a href="{{ route('member.password.request') }}" class="text-muted float-end"><small>Lupa password?</small></a>
		<label for="password" class="form-label">Password</label>
		<div class="input-group input-group-merge">
			<input name="password" type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password">
			<div class="input-group-text" data-password="false">
				<span class="password-eye"></span>
			</div>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
		</div>
	</div>
	<div class="mb-3">
		<div class="form-check">
			<input name="remember" type="checkbox" class="form-check-input" id="checkbox-signin">
			<label class="form-check-label" for="checkbox-signin">Ingat saya</label>
		</div>
	</div>
	<div class="text-center d-grid">
		<button class="btn btn-primary" type="submit">Log In </button>
	</div>
	{{-- social--}}
	{{-- <div class="text-center mt-4">
		<p class="text-muted font-16">Log in dengan</p>
		<ul class="social-list list-inline mt-3">
			<li class="list-inline-item">
				<a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
			</li>
			<li class="list-inline-item">
				<a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
			</li>
		</ul>
	</div> --}}
</form>
{{-- end form--}}
{{-- Footer--}}
<footer class="footer footer-alt">
    <p class="text-muted">Belum punya akun? <a href="{{ route('member.register') }}" class="text-muted ms-1"><b>Register</b></a></p>
	<p class="text-muted"><a href="{{ route('admin.login') }}" class="text-muted ms-1"><b>Login Admin</b></a></p>
</footer>
@endsection
