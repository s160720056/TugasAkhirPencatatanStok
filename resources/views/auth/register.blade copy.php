@extends('layouts.app', ['menu' => 'register'])

@section('content')
<style>
    .col-form-label {
        font-weight: bold;
    }
</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-1 rounded-0">
                <div class="card-header h4 text-white" style="background-color: #00264d;">Registrasi Bisnis</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Logo Toko --}}
                        <div class="form-group row mb-3">
                            <label for="logo_toko" class="col-md-4 col-form-label">{{ __('Logo Bisnis') }}</label>
                            <div class="col-md-6 text-center">
                                <img id="logo-preview" src="{{asset('assets/contohLogo/contohLogo.png')}}"
                                    alt="Logo Preview" class="img-thumbnail border-0 rounded-circle m-auto"
                                    style="width: 150px; height: 150px;">
                                <input id="logo_toko" type="file"
                                    class="form-control @error('logo_toko') is-invalid @enderror mt-2" name="logo_toko"
                                    required>
                                @error('logo_toko')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Nama Toko --}}
                        <div class="form-group row mb-3">
                            <label for="nama_toko" class="col-md-4 col-form-label">{{ __('Nama Bisnis') }}</label>
                            <div class="col-md-6">
                                <input id="nama_toko" type="text"
                                    class="form-control @error('nama_toko') is-invalid @enderror" name="nama_toko"
                                    value="{{ old('nama_toko') }}" required placeholder="Nama Bisnis">
                                @error('nama_toko')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- nama pemilik --}}
                        <div class="form-group row mb-3">
                            <label for="nama_pemilik" class="col-md-4 col-form-label">{{ __('Nama Pemilik') }}</label>
                            <div class="col-md-6">
                                <input id="nama_pemilik" type="text"
                                    class="form-control @error('nama_pemilik') is-invalid @enderror" name="nama_pemilik"
                                    value="{{ old('nama_pemilik') }}" required placeholder="Nama Pemilik">
                                @error('nama_pemilik')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat Toko --}}
                        <div class="form-group row mb-3">
                            <label for="alamat_toko" class="col-md-4 col-form-label">{{ __('Alamat Bisnis') }}</label>
                            <div class="col-md-6">
                                <input id="alamat_toko" type="text"
                                    class="form-control @error('alamat_toko') is-invalid @enderror" name="alamat_toko"
                                    value="{{ old('alamat_toko') }}" required placeholder="Alamat Bisnis">
                                @error('alamat_toko')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- No telepon --}}
                        <div class="form-group row mb-3">
                            <label for="tlp" class="col-md-4 col-form-label">{{ __('No Telepon') }}</label>
                            <div class="col-md-6">
                                <input id="tlp" type="text" class="form-control @error('tlp') is-invalid @enderror"
                                    name="tlp" value="{{ old('tlp') }}" required placeholder="No Telepon">
                                @error('tlp')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- PPN --}}
                        <div class="form-group row mb-3">
                            <label for="ppn" class="col-md-4 col-form-label">{{ __('PPN') }}</label>
                            <div class="col-md-6">
                                <input id="ppn" type="text" class="form-control @error('ppn') is-invalid @enderror"
                                    name="ppn" value="{{ old('ppn') }}" required placeholder="PPN">
                                @error('ppn')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        {{-- Email Toko --}}
                        <div class="form-group row mb-3">
                            <label for="email_toko" class="col-md-4 col-form-label">{{ __('Email Toko') }}</label>
                            <div class="col-md-6">
                                <input id="email_t</div>oko" type="email"
                                    class="form-control @error('email_toko') is-invalid @enderror" name="email_toko"
                                    value="{{ old('email_toko') }}" required placeholder="Email Bisnis">
                                @error('email_toko')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-4" style="border-color:black">

                        {{-- Nama --}}
                        <div class="form-group row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus
                                    placeholder="Nama">
                                @error('nama')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Username --}}
                        <div class="form-group row mb-3">
                            <label for="username"
                                class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username"
                                    placeholder="Username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="form-group row mb-3">
                            <label for="alamat" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>
                            <div class="col-md-6">
                                <input id="alamat" type="text"
                                    class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                    value="{{ old('alamat') }}" required autocomplete="alamat" placeholder="Alamat">
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- No HP --}}
                        <div class="form-group row mb-3">
                            <label for="no_hp" class="col-md-4 col-form-label text-md-end">{{ __('No HP') }}</label>
                            <div class="col-md-6">
                                <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    name="no_hp" value="{{ old('no_hp') }}" required autocomplete="no_hp"
                                    placeholder="No HP">
                                @error('no_hp')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="form-group row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="form-group row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete=""
                                    placeholder="Confirm Password">
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark btn-block">
                                    <i class="bi bi-person-plus-fill me-2"></i>{{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Username validation with Axios
    document.getElementById('username').addEventListener('change', function () {
        const feedback = document.getElementById('username-feedback');
        axiosPost('/check-username', { username: this.value })
            .then(function (response) {
                feedback.classList.toggle('d-none', response.data === 'available');
            })
            .catch(function (error) {
                console.log(error);
            });
    });

    // Logo preview
    document.getElementById('logo_bisnis').addEventListener('change', function () {
        const preview = document.getElementById('logo-preview');
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.classList.add('d-none');
        }
    });
</script>
@endsection
