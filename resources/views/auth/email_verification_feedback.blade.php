@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifikasi Email</div>

                <div class="card-body">
                    @if ($email_status == 'success')
                        <p>Verifikasi Email Sukses!</p>
                        <a href="{{ env('APP_URL').env('FRONT_END_PORT') }}">Kembali ke Halaman Awal</a>
                    @endif

                    @if ($email_status == 'verified')
                        <p>Email Telah Diverifikasi!</p>
                        <a href="{{ env('APP_URL').env('FRONT_END_PORT') }}">Kembali ke Halaman Awal</a>
                    @endif
                    
                    @if ($email_status == 'invalid')
                        <p>Token Verifikasi Salah!</p>
                        <a href="{{ env('APP_URL').env('FRONT_END_PORT') }}">Kembali ke Halaman Awal</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
