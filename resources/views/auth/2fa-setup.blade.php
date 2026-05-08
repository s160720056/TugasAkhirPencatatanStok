@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow mt-5">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Aktifkan Two-Factor Authentication</h4>
                </div>
                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <p class="lead">Scan QR Code ini menggunakan aplikasi authenticator di HP Anda</p>
                    </div>

                    <div class="text-center mb-5">
                        {!! $qrCode !!}
                    </div>

                    <div class="alert alert-info">
                        <strong>Manual Entry:</strong><br>
                        <code>{{ $user->two_factor_secret }}</code>
                    </div>

                    <hr>

                    <form method="POST" action="{{ route('2fa.confirm') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="code" class="form-label">Masukkan kode 6 digit dari aplikasi Anda</label>
                            <input 
                                type="text" 
                                name="code" 
                                id="code"
                                class="form-control form-control-lg text-center" 
                                maxlength="6" 
                                autofocus 
                                required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                Konfirmasi & Aktifkan 2FA
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection