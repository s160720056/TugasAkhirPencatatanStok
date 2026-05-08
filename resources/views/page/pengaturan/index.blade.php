@extends('layouts.app', ['menu' => 'pengaturan'])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11 col-md-12">

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0 fw-bold text-center">Pengaturan Toko</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Informasi Toko --}}
                        <h5 class="mb-3 fw-semibold">Informasi Toko</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Pemilik</label>
                                <input type="text" class="form-control"
                                       name="nama_pemilik"
                                       value="{{ $pengaturan->nama_pemilik ?? '' }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Toko</label>
                                <input type="text" class="form-control"
                                       name="nama_toko"
                                       value="{{ $pengaturan->nama_toko ?? '' }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Toko</label>
                            <input type="text" class="form-control"
                                   name="alamat_toko"
                                   value="{{ $pengaturan->alamat_toko ?? '' }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control"
                                       name="email_toko"
                                       value="{{ $pengaturan->email_toko ?? '' }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Telepon</label>
                                <input type="text" class="form-control"
                                       name="tlp"
                                       value="{{ $pengaturan->tlp ?? '' }}">
                            </div>
                        </div>

                        {{-- Operasional --}}
                        <h5 class="mt-4 mb-3 fw-semibold">Jam Operasional</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jam Buka</label>
                                <input type="time" class="form-control"
                                       name="jam_buka"
                                       value="{{ $pengaturan->jam_buka ?? '' }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jam Tutup</label>
                                <input type="time" class="form-control"
                                       name="jam_tutup"
                                       value="{{ $pengaturan->jam_tutup ?? '' }}">
                            </div>
                        </div>

                        {{-- Pajak --}}
                        <h5 class="mt-4 mb-3 fw-semibold">Pajak</h5>
                        <div class="col-md-4 mb-3 p-0">
                            <label class="form-label">PPN (%)</label>
                            <input type="number" class="form-control"
                                   name="ppn"
                                   value="{{ $pengaturan->ppn ?? '' }}">
                        </div>

                        {{-- Logo --}}
                        <h5 class="mt-4 mb-3 fw-semibold">Logo Toko</h5>
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-3">
                                <img
                                    src="{{ asset('storage/' . $pengaturan->logo_toko) }}"
                                    class="img-thumbnail"
                                    id="logo_toko_preview"
                                    style="max-height:180px"
                                >
                            </div>

                            <div class="col-md-8">
                                <input type="file"
                                       class="form-control"
                                       name="logo_toko"
                                       accept="image/*"
                                       onchange="previewLogo(event)">
                                <small class="text-muted">Format JPG / PNG</small>
                            </div>
                        </div>

                        {{-- Presensi --}}
                        <h5 class="mt-4 mb-3 fw-semibold">Pengaturan Presensi</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Toleransi Terlambat</label>
                                <div class="input-group">
                                    <input type="number" class="form-control"
                                           name="toleransi_terlambat"
                                           value="{{ $pengaturan->toleransi_terlambat ?? '' }}">
                                    <span class="input-group-text">menit</span>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Denda Keterlambatan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control"
                                           name="denda_keterlambatan"
                                           value="{{ $pengaturan->denda_keterlambatan ?? '' }}">
                                </div>
                            </div>
                        </div>

                        {{-- Printer --}}
                        <h5 class="mt-4 mb-3 fw-semibold">Pengaturan Printer Nota</h5>
                        <div class="col-md-4 mb-4 p-0">
                            <label class="form-label">Lebar Kertas Struk</label>
                            <div class="input-group">
                                <input type="number"
                                       class="form-control"
                                       name="lebar_kertas_struk"
                                       value="{{ $pengaturan->lebar_kertas_struk ?? '' }}"
                                       data-toggle="tooltip"
                                       title="Lebar kertas struk dalam milimeter (mm)">
                                <span class="input-group-text">mm</span>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                Simpan
                            </button>
                            <button type="submit" name="print_nota" value="1" class="btn btn-outline-secondary px-4">
                                Test Print Nota
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
function previewLogo(event) {
    const reader = new FileReader();
    reader.onload = e => document.getElementById('logo_toko_preview').src = e.target.result;
    reader.readAsDataURL(event.target.files[0]);
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection
