@extends('layouts.app', ['menu' => 'pengaturanToko'])

@section('content')
    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Pengaturan Perusahaan</h3>
        </div>

        <div class="row">
            <div class="col-xl-12">

                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <form action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Informasi Perusahaan --}}
                            <h5 class="mb-3 text-primary">Informasi Perusahaan</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Pemilik</label>
                                    <input type="text" class="form-control" name="nama_pemilik"
                                        value="{{ $pengaturan->nama_pemilik ?? '' }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control" name="nama_toko"
                                        value="{{ $pengaturan->nama_toko ?? '' }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Perusahaan</label>
                                <input type="text" class="form-control" name="alamat_toko"
                                    value="{{ $pengaturan->alamat_toko ?? '' }}" required>
                            </div>

                            {{-- Kontak --}}
                            <h5 class="mt-4 mb-3 text-primary">Kontak</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email_toko"
                                        value="{{ $pengaturan->email_toko ?? '' }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" class="form-control" name="tlp"
                                        value="{{ $pengaturan->tlp ?? '' }}" required>
                                </div>
                            </div>

                            {{-- Operasional --}}
                            <h5 class="mt-4 mb-3 text-primary">Operasional</h5>
                            <div class="row">
                                {{-- <div class="col-md-4 mb-3">
                                <label class="form-label">PPN (%)</label>
                                <input type="number" class="form-control"
                                    name="ppn"
                                    value="{{ $pengaturan->ppn ?? '' }}"
                                    required>
                            </div> --}}

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jam Buka</label>
                                    <input type="time" class="form-control" name="jam_buka"
                                        value="{{ $pengaturan->jam_buka ?? '' }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jam Tutup</label>
                                    <input type="time" class="form-control" name="jam_tutup"
                                        value="{{ $pengaturan->jam_tutup ?? '' }}" required>
                                </div>
                            </div>

                            {{-- urutan timbang, select --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Urutan Timbang</label>
                                <select class="form-select" name="urutan_timbang" required>
                                    <option value="urut"
                                        {{ old('urutan_timbang', $pengaturan->urutan_timbang ?? '') == 'urut' ? 'selected' : '' }}>
                                        Urut (Bruto → Tara)
                                    </option>
                                    <option value="terbalik"
                                        {{ old('urutan_timbang', $pengaturan->urutan_timbang ?? '') == 'terbalik' ? 'selected' : '' }}>
                                        Terbalik (Tara → Bruto)
                                    </option>
                                </select>
                            </div>



                            {{-- Logo --}}
                            <h5 class="mt-4 mb-3 text-primary">Logo Perusahaan</h5>
                            <div class="row align-items-center">
                                <div class="col-md-4 mb-3 text-center">
                                    <img src="{{ $pengaturan->logo_toko ? asset('storage/' . $pengaturan->logo_toko) : asset('images/no-image.png') }}"
                                        class="img-thumbnail mb-2" id="logo_toko_preview" style="max-width:180px">
                                    <div class="text-muted small">Preview Logo</div>
                                </div>

                                <div class="col-md-8 mb-3">
                                    <div class="border-2 border-dashed rounded p-4 text-center" id="dropZone"
                                        style="cursor: pointer; border-color: #dee2e6;">
                                        <input type="file" class="form-control d-none" id="logo_toko_input"
                                            name="logo_toko" accept="image/*" onchange="previewLogo(event)">
                                        <p class="mb-2">Drag and drop your logo here</p>
                                        <p class="text-muted small mb-0">or click to select</p>
                                        <small class="text-muted d-block mt-2">
                                            Format JPG / PNG, max 2MB
                                        </small>
                                    </div>
                                </div>
                            </div>

                            {{-- Action --}}
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('logo_toko_input');

        // Click to select file
        dropZone.addEventListener('click', () => fileInput.click());

        // Drag and drop events
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.style.borderColor = '#0d6efd';
            dropZone.style.backgroundColor = '#f8f9ff';
        });

        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.style.borderColor = '#dee2e6';
            dropZone.style.backgroundColor = 'transparent';
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.style.borderColor = '#dee2e6';
            dropZone.style.backgroundColor = 'transparent';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                previewLogo({
                    target: {
                        files: files
                    }
                });
            }
        });

        function previewLogo(event) {
            const preview = document.getElementById('logo_toko_preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(file);
            }
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}'
            });
        @endif
    </script>
@endsection
