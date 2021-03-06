@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    @if (isset($error_response))
                        <p>Mohon maaf, sedang terjadi kesalahan pada sistem.</p>
                        <a href="{{ env('APP_LANDING_PAGE').env('FRONT_END_PORT') }}">Kembali ke Halaman Awal</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if (isset($token) && !isset($error_response))
<script>
    let data = {
        token: "{{ $token }}",
        Nama_Konsumen: "{{ $Nama_Konsumen }}",
        Email_Konsumen: "{{ $email }}",
        is_verified: {{ $is_verified }} == 1 ? true : false,
        socialized_account: {{ $socialized_account }} == 1 ? true : false,
    };
    localStorage.setItem('AuthToken', JSON.stringify(data));
    if (localStorage.getItem('AuthToken') != null) {
        window.location = "{{ env('APP_LANDING_PAGE').env('FRONT_END_PORT') }}";
    }
</script>
@endif
@endsection
