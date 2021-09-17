@extends('member.layouts.auth')
@section('title')
Reset Password Member
@endsection
@section('content')
{{-- title--}}
<h4 class="mt-0">@yield('title')</h4>
<p class="text-muted mb-4">Reset password Anda.</p>
{{-- form --}}
<form action="{{ route('member.password.update') }}" method="POST">
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
{{-- end form--}}
{{-- Footer--}}
<footer class="footer footer-alt">
	<p class="text-muted">Kembali ke <a href="{{ route('member.login') }}" class="text-muted ms-1"><b>Login</b></a></p>
</footer>
@endsection
