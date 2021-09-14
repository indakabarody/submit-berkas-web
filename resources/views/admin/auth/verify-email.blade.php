@extends('admin.layouts.auth')

@section('title')
    Verifikasi Email Admin
@endsection

@section('content')
    {{--begin::Content--}}
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        {{--begin::Logo--}}
        <a href="{{ url('') }}" class="mb-12">
        <h1 class="text-dark">{{ config('app.name') }}</h1>
        </a>
        {{--end::Logo--}}
        {{--begin::Wrapper--}}
        <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
            {{--begin::Form--}}
            <form class="form w-100" action="{{ route('admin.verification.send') }}" method="POST">
                @csrf
                {{--begin::Heading--}}
                <div class="text-center mb-10">
                    {{--begin::Title--}}
                    <h1 class="text-dark mb-3">@yield('title')</h1>
                    {{--end::Title--}}
                    {{--begin::Link--}}
                    <div class="text-gray-400 fw-bold fs-4">Kami telah mengirim email berisi link ke
						<a href="#" class="link-primary fw-bolder">{{ Auth::user()->email }}</a>
						<br />silakan klik link tersebut untuk verifikasi email.</div>
                    {{--end::Link--}}
                </div>
                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success" role="alert">
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat surel yang Anda daftarkan.') }}
                    </div>
                @endif
                {{--begin::Heading--}}
                {{--begin::Actions--}}
                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                    <button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">
                        <span class="indicator-label">Kirim Ulang</span>
                    </button>
                </div>
                {{--end::Actions--}}
            </form>
            {{--end::Form--}}
        </div>
        {{--end::Wrapper--}}
    </div>
    {{--end::Content--}}
@endsection
