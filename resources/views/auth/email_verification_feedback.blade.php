@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifikasi Email</div>

                <div class="card-body">
                    @if (isset($error_response))
                        <p>Mohon maaf, sedang terjadi kesalahan pada sistem.</p>
                        <a href="{{ env('APP_LANDING_PAGE').env('FRONT_END_PORT') }}">Kembali ke Halaman Awal</a>
                    @else
                        @if ($email_status == 'success')
                            <p>Verifikasi Email Sukses!</p>
                            <a href="{{ env('APP_LANDING_PAGE').env('FRONT_END_PORT') }}">Kembali ke Halaman Awal</a>
                        @endif

                        @if ($email_status == 'verified')
                            <p>Email Telah Diverifikasi!</p>
                            <a href="{{ env('APP_LANDING_PAGE').env('FRONT_END_PORT') }}">Kembali ke Halaman Awal</a>
                        @endif
                        
                        @if ($email_status == 'invalid')
                            <p>Token Verifikasi Salah!</p>
                            <a href="{{ env('APP_LANDING_PAGE').env('FRONT_END_PORT') }}">Kembali ke Halaman Awal</a>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@if (isset($email_status) && $email_status == 'success')
<script>
    let data = {
        token: "{{ $token }}",
        Nama_Konsumen: "{{ $Nama_Konsumen }}",
        email: "{{ $email }}",
        is_verified: {{ $is_verified }} == 1 ? true : false,
        socialized_account: {{ $socialized_account }} == 1 ? true : false,
    };
    localStorage.setItem('AuthToken', JSON.stringify(data));
</script>
@endif
@endsection
