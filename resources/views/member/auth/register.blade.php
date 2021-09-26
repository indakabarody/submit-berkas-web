@extends('member.layouts.auth')
@section('title')
Registrasi Member
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
<p class="text-muted mb-4">Silakan isi form di bawah ini untuk melakukan registrasi.</p>
{{-- form --}}
<form method="POST">
    @csrf

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

	<div class="mb-3">
        <label for="inputName3" class="form-label">Nama Lengkap *</label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="inputName3" placeholder="Masukkan Nama Lengkap">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
	</div>
    <div class="mb-3">
        <label for="inputEmail3" class="form-label">Email *</label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail3" placeholder="Masukkan Email">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="inputPhone3" class="form-label">Telp *</label>
        <input name="phone" type="number" min="0" class="form-control @error('phone') is-invalid @enderror" id="inputPhone3" placeholder="Masukkan No Telp">
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="inputProvince3" class="form-label">Asal Provinsi *</label>
        <select class="form-select @error('province_id') is-invalid @enderror" name="province_id">
            <option value="">- Pilih Provinsi -</option>
            @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->province }}</option>
            @endforeach
        </select>
        @error('province_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="inputInstitution3" class="form-label">Institusi *</label>
        <input name="institution" type="text" class="form-control @error('institution') is-invalid @enderror" id="inputInstitution3" placeholder="Masukkan Nama Institusi/Organisasi/PT/Sekolah/Tempat Bekerja">
        @error('institution') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="inputAddress3" class="form-label">Alamat *</label>
        <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress3" placeholder="Masukkan Alamat Sesuai Identitas">
        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
	<div class="mb-3">
		<label for="password" class="form-label">Password *</label>
		<div class="input-group input-group-merge">
			<input name="password" type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password baru">
			<div class="input-group-text" data-password="false">
				<span class="password-eye"></span>
			</div>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
		</div>
	</div>
    <div class="mb-3">
		<label for="password" class="form-label">Ulangi Password *</label>
		<div class="input-group input-group-merge">
			<input name="password_confirmation" type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Ulangi password">
			<div class="input-group-text" data-password="false">
				<span class="password-eye"></span>
			</div>
            @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
		</div>
	</div>
    <div class="mb-3">
        <label for="inputPassword5" class="form-label">Daftar Sebagai (Silahkan pilih sesuai kebutuhan)</label>
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
	<div class="text-center d-grid">
		<button class="btn btn-primary" type="submit">Daftarkan </button>
	</div>
	{{-- social--}}
	{{-- <div class="text-center mt-4">
		<p class="text-muted font-16">Daftar dengan</p>
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
	<p class="text-muted">Sudah punya akun? <a href="{{ route('member.login') }}" class="text-muted ms-1"><b>Login</b></a></p>
</footer>
@endsection
