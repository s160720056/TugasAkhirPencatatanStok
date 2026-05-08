@extends('layouts.app', ['menu' => 'home'])

@section('content')
    @if (session()->has('id_toko'))
        {{-- <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="alert alert-primary" role="alert">

        </div>
        <div class="alert alert-secondary" role="alert">
            This is a secondary alert—check it out!
        </div>
        <div class="alert alert-success" role="alert">
            This is a success alert—check it out!
        </div>
        <div class="alert alert-danger" role="alert">
            This is a danger alert—check it out!
        </div>
        <div class="alert alert-warning" role="alert">
            This is a warning alert—check it out!
        </div>
        <div class="alert alert-info" role="alert">
            This is a info alert—check it out!
        </div>
        <div class="alert alert-light" role="alert">
            This is a light alert—check it out!
        </div>
        <div class="alert alert-dark" role="alert">
            This is a dark alert—check it out!
        </div> --}}

        @if ($toko->status_pengajuan_toko == 'proses')
            <div class="alert alert-warning" role="alert">
                Toko anda sedang dalam proses verifikasi, mohon menunggu.
            </div>
        @elseif($toko->status_pengajuan_toko == 'ditolak')
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="alert alert-danger" role="alert">
                    Pengajuan toko anda ditolak, silakan periksa kembali data yang anda kirimkan. <br>
                    Alasan: {{ $toko->alasan_ditolak }}
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title">Verifikasi Ulang</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Silakan klik tombol di bawah untuk mengajukan verifikasi ulang toko Anda.</p>

                        <div class="btn btn-primary" id="btnVerifikasi">Verifikasi Ulang</div>


                        <form action="{{ route('toko.verifikasiUlang') }}" method="POST" id="formVerifikasiUlang">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="display: none;">Submit</button>
                        </form>
                    </div>
                </div>


                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title">Pengaturan Toko</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="nama_pemilik">Nama Pemilik</label>
                                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik"
                                    placeholder="Enter Nama Pemilik" value="{{ $pengaturan->nama_pemilik ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_toko">Nama Toko</label>
                                <input type="text" class="form-control" id="nama_toko" name="nama_toko"
                                    placeholder="Enter Nama Toko" value="{{ $pengaturan->nama_toko ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat_toko">Alamat Toko</label>
                                <input type="text" class="form-control" id="alamat_toko" name="alamat_toko"
                                    placeholder="Enter Alamat Toko" value="{{ $pengaturan->alamat_toko ?? '' }}" required>
                            </div>
                            {{-- Email toko- --}}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email_toko" name="email_toko"
                                    placeholder="Enter Email" value="{{ $pengaturan->email_toko ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tlp">Telepon</label>
                                <input type="text" class="form-control" id="tlp" name="tlp"
                                    placeholder="Enter Telepon" value="{{ $pengaturan->tlp ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="ppn">PPN</label>
                                <input type="number" class="form-control" id="ppn" name="ppn"
                                    placeholder="Enter PPN" value="{{ $pengaturan->ppn ?? '' }}" required>
                            </div>

                            {{-- jam buka, jam tutup --}}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="jam_buka">Jam Buka</label>
                                        <input type="time" class="form-control" id="jam_buka" name="jam_buka"
                                            placeholder="Enter Jam Buka" value="{{ $pengaturan->jam_buka ?? '' }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jam_tutup">Jam Tutup</label>
                                        <input type="time" class="form-control" id="jam_tutup" name="jam_tutup"
                                            placeholder="Enter Jam Tutup" value="{{ $pengaturan->jam_tutup ?? '' }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            {{-- Add preview logo toko and upload logo toko --}}
                            <div class="form-group">
                                <label for="logo_toko">Logo Toko</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Image preview --}}
                                        <img src="{{ asset('storage/' . $pengaturan->logo_toko) }}" class="img-thumbnail"
                                            alt="Logo Toko" id="logo_toko_preview"
                                            style="max-width: 200px; max-height: 200px;">
                                    </div>
                                    <div class="col-md-6">
                                        {{-- File input --}}
                                        <input type="file" class="form-control" id="logo_toko" name="logo_toko"
                                            placeholder="Upload Logo Toko" accept="image/*"
                                            onchange="previewLogo(event)">
                                    </div>
                                </div>
                            </div>




                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
            <script>
                //onclick btnVerifikkasi
                document.getElementById('btnVerifikasi').addEventListener('click', function() {
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda akan mengajukan verifikasi ulang toko anda!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, ajukan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Berhasil!',
                                'Pengajuan verifikasi ulang toko anda berhasil diajukan.',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('formVerifikasiUlang').submit();
                                }
                            });


                        }
                    });
                });




                function previewLogo(event) {
                    const input = event.target;
                    const preview = document.getElementById('logo_toko_preview');

                    // Check if a file was selected
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();

                        // Load the image file into the preview element
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                        };

                        // Read the image file
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                @if (session('success'))
                    Swal.fire({
                        icon: "success",
                        title: 'Success',
                        text: '{{ session('success') }}',
                    });
                @endif
            </script>
        @else
            {{-- DASHBOARD TIMBANGAN - Advanced Analytics Style --}}
            


        @endif
    @else
        @if (isset($listToko))
            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahToko" style="width: 250px;">Tambah
                Toko</button> --}}
            <div class="row">
                @foreach ($listToko as $item)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('storage/' . $item->logo_toko) }}" alt="Logo"
                                        class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div class="ml-3 flex-grow-1">
                                        <h6 class="card-title mb-0">{{ $item->nama_toko }}</h6>
                                        <small class="text-muted">{{ $item->alamat_toko }}</small>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="small text-muted">Jam Operasional</span>
                                        <span class="small font-weight-bold">{{ $item->jam_buka }} -
                                            {{ $item->jam_tutup }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-muted">Status</span>
                                        <div>
                                            @if ($item->status_pengajuan_toko == 'proses')
                                                <span class="badge badge-warning">Proses</span>
                                            @elseif($item->status_pengajuan_toko == 'ditolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-success">Diterima</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('toko.connect', $item->id_toko) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block btn-sm">Masuk</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width: 5%;"></th>
                        <th scope="col">Toko</th>
                        <th scope="col" style="width: 20%;">Logo</th>
                        <th scope="col" class="text-center" style="width: 25%;">Jam Buka - Jam Tutup</th>
                        <th scope="col" class="text-center" style="width: 15%;">Status Pengajuan</th>
                        <th scope="col" style="width: 15%;" class="text-right">Hubungkan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listToko as $item)
                        <tr>
                            <td></td>
                            <td>
                                <strong>{{ $item->nama_toko }}</strong>
                                <br>
                                <small class="text-muted">{{ $item->alamat_toko }}</small>
                            </td>
                            <td>
                                <img src="{{ asset('storage/' . $item->logo_toko) }}" alt="Logo" class="img-fluid"
                                    style="max-width: 100px;">
                            </td>
                            <td class="text-center">{{ $item->jam_buka }} - {{ $item->jam_tutup }}</td>
                            <td class="text-center">
                                @if ($item->status_pengajuan_toko == 'proses')
                                    <span class="badge badge-warning">Proses</span>
                                @elseif($item->status_pengajuan_toko == 'ditolak')
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-success">Diterima</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <form action="{{ route('toko.connect', $item->id_toko) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Masuk</button>
                                </form>
                            </td>
                    @endforeach

                </tbody>
            </table> --}}



            <div class="modal fade" id="modalTambahToko" tabindex="-1" role="dialog"
                aria-labelledby="modalTambahTokoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('toko.simpanTokoBaru') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTambahTokoLabel">Tambah Toko</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 class="mb-3">Informasi Toko</h5>

                                {{-- Logo Toko --}}
                                <div class="form-group row mb-3">
                                    <label for="logo_toko"
                                        class="col-md-4 col-form-label">{{ __('Logo Bisnis') }}</label>
                                    <div class="col-md-8 text-center">
                                        <img id="logo-preview" src="{{ asset('assets/contohLogo/contohLogo.png') }}"
                                            alt="Logo Preview" class="img-thumbnail border-0 rounded-circle m-auto"
                                            style="width: 150px; height: 150px;">
                                        <input id="logo_toko" type="file"
                                            class="form-control @error('logo_toko') is-invalid @enderror mt-2"
                                            name="logo_toko">
                                        @error('logo_toko')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Nama Toko --}}
                                <div class="form-group row mb-3">
                                    <label for="nama_toko"
                                        class="col-md-4 col-form-label">{{ __('Nama Bisnis') }}</label>
                                    <div class="col-md-8">
                                        <input id="nama_toko" type="text"
                                            class="form-control @error('nama_toko') is-invalid @enderror" name="nama_toko"
                                            value="{{ old('nama_toko') }}" placeholder="Nama Bisnis" required>
                                        @error('nama_toko')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Nama Pemilik --}}
                                <div class="form-group row mb-3">
                                    <label for="nama_pemilik"
                                        class="col-md-4 col-form-label">{{ __('Nama Pemilik') }}</label>
                                    <div class="col-md-8">
                                        <input id="nama_pemilik" type="text"
                                            class="form-control @error('nama_pemilik') is-invalid @enderror"
                                            name="nama_pemilik" value="{{ old('nama_pemilik') }}"
                                            placeholder="Nama Pemilik" required>
                                        @error('nama_pemilik')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Alamat Toko --}}
                                <div class="form-group row mb-3">
                                    <label for="alamat_toko"
                                        class="col-md-4 col-form-label">{{ __('Alamat Bisnis') }}</label>
                                    <div class="col-md-8">
                                        <input id="alamat_toko" type="text"
                                            class="form-control @error('alamat_toko') is-invalid @enderror"
                                            name="alamat_toko" value="{{ old('alamat_toko') }}"
                                            placeholder="Alamat Bisnis" required>
                                        @error('alamat_toko')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- No Telepon --}}
                                <div class="form-group row mb-3">
                                    <label for="tlp" class="col-md-4 col-form-label">{{ __('No Telepon') }}</label>
                                    <div class="col-md-8">
                                        <input id="tlp" type="text"
                                            class="form-control @error('tlp') is-invalid @enderror" name="tlp"
                                            value="{{ old('tlp') }}" placeholder="No Telepon" required>
                                        @error('tlp')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- PPN --}}
                                <div class="form-group row mb-3">
                                    <label for="ppn" class="col-md-4 col-form-label">{{ __('PPN') }}</label>
                                    <div class="col-md-8">
                                        <input id="ppn" type="text"
                                            class="form-control @error('ppn') is-invalid @enderror" name="ppn"
                                            value="{{ old('ppn') }}" placeholder="PPN" required>
                                        @error('ppn')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email Toko --}}
                                <div class="form-group row mb-3">
                                    <label for="email_toko"
                                        class="col-md-4 col-form-label">{{ __('Email Toko') }}</label>
                                    <div class="col-md-8">
                                        <input id="email_toko" type="email"
                                            class="form-control @error('email_toko') is-invalid @enderror"
                                            name="email_toko" value="{{ old('email_toko') }}" placeholder="Email Bisnis"
                                            required>
                                        @error('email_toko')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submitTokoBaru">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                //when submit button clicked, disable the button to prevent double submission
                // document.getElementById('submitTokoBaru').addEventListener('click', function() {
                //     this.setAttribute('disabled', 'disabled');
                //     this.innerHTML = 'Loading...';
                // });



                // Preview Logo
                document.getElementById('logo_toko').addEventListener('change', function() {
                    const file = this.files[0];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        document.getElementById('logo-preview').src = e.target.result;
                    }

                    reader.readAsDataURL(file);
                });
            </script>
        @else
            <div class="alert alert-danger" role="alert">
                Anda belum memiliki toko. Silakan buat toko terlebih dahulu.
            </div>
        @endif

        {{-- <div class="alert alert-danger" role="alert">
            Anda belum memiliki toko. Silakan buat toko terlebih dahulu.
        </div> --}}
    @endif



@endsection
