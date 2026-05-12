@extends('layouts.app', ['menu' => 'rekapStokBarang'])

@section('content')
@php use Carbon\Carbon; Carbon::setLocale('id'); @endphp

<div class="container mt-4">
    <h3 class="text-center mb-4">Rekap Stok Harian</h3>

    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form id="filterForm" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Awal</label>
                    <input type="date" id="tgl_awal" class="form-control" value="{{ $start->format('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" id="tgl_akhir" class="form-control" value="{{ $end->format('Y-m-d') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100" id="btnTampilRekap">Tampilkan Rekap</button>
                </div>
            </form>
        </div>
    </div>

     <div class="row">
        <!-- Barang Masuk -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">📥 Rincian Barang Masuk</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-sm table-bordered" id="tableMasuk" style="font-size: 13px;">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Seri</th>
                                    <th class="text-end">Jumlah</th>
                                    <th>Diberikan Oleh</th>
                                </tr>
                            </thead>
                            <tbody id="bodyMasuk"></tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <strong>Total Masuk:</strong> <span id="totalMasukDetail" class="text-success fw-bold">0</span> Unit
                </div>
            </div>
        </div>

        <!-- Barang Keluar -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">📤 Rincian Barang Keluar</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-sm table-bordered" id="tableKeluar" style="font-size: 13px;">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Seri</th>
                                    <th class="text-end">Jumlah</th>
                                    <th>Keperluan</th>
                                    <th>Diberikan Oleh</th>
                                </tr>
                            </thead>
                            <tbody id="bodyKeluar"></tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <strong>Total Keluar:</strong> <span id="totalKeluarDetail" class="text-danger fw-bold">0</span> Unit
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Table -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5>Periode: <strong id="periode">{{ $start->translatedFormat('d F Y') }} s/d {{ $end->translatedFormat('d F Y') }}</strong></h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" style="font-size: 13px;">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Seri</th>
                            <th class="text-end">Stok Awal</th>
                            <th class="text-end text-success">Masuk</th>
                            <th class="text-end text-danger">Keluar</th>
                            <th class="text-end">Stok Akhir</th>
                        </tr>
                    </thead>
                    <tbody id="rekapBody"></tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <strong>Total Masuk:</strong> <span id="totalMasuk" class="text-success">0</span> |
            <strong>Total Keluar:</strong> <span id="totalKeluar" class="text-danger">0</span>
        </div>
    </div>

    <!-- ==================== RINCIAN TRANSAKSI ==================== -->

</div>
<script>
async function loadRekap() {
    const awal = document.getElementById('tgl_awal').value;
    const akhir = document.getElementById('tgl_akhir').value;

    if (!awal || !akhir) {
        console.warn('Tanggal awal/akhir belum terisi');
        return;
    }

    try {
        console.log('Fetching data for:', awal, 'to', akhir); // DEBUG

        const res = await fetch(`/rekapStokBarang/rekap-harian?tanggal_awal=${awal}&tanggal_akhir=${akhir}`);
        const data = await res.json();

        if (!data.success) {
            throw new Error(data.message || 'Gagal mengambil data');
        }

        // Update Summary
        document.getElementById('periode').textContent = data.periode || 'Periode tidak tersedia';
        document.getElementById('totalMasuk').textContent = Number(data.totalMasuk || 0).toLocaleString('id-ID');
        document.getElementById('totalKeluar').textContent = Number(data.totalKeluar || 0).toLocaleString('id-ID');

        // Render Rekap Summary
        let html = '';
        if (Array.isArray(data.barangSummary) && data.barangSummary.length > 0) {
            data.barangSummary.forEach(b => {
                const highlight = (Number(b.masuk) > 0 || Number(b.keluar) > 0) ? 'table-warning fw-bold' : '';
                html += `
                    <tr class="${highlight}">
                        <td>${b.kode_barang || '-'}</td>
                        <td>${b.nama_barang || '-'}</td>
                        <td>${b.seri || '-'}</td>
                        <td class="text-end">${Number(b.stok_awal || 0).toLocaleString('id-ID')}</td>
                        <td class="text-end text-success fw-bold">+${Number(b.masuk || 0).toLocaleString('id-ID')}</td>
                        <td class="text-end text-danger fw-bold">-${Number(b.keluar || 0).toLocaleString('id-ID')}</td>
                        <td class="text-end fw-bold">${Number(b.stok_akhir || 0).toLocaleString('id-ID')}</td>
                    </tr>`;
            });
        } else {
            html = '<tr><td colspan="7" class="text-center py-3 text-muted">Tidak ada data rekap pada periode ini</td></tr>';
        }
        document.getElementById('rekapBody').innerHTML = html;

        // Render Rincian
        renderMasuk(Array.isArray(data.masukItems) ? data.masukItems : [], data.totalMasuk || 0);
        renderKeluar(Array.isArray(data.keluarItems) ? data.keluarItems : [], data.totalKeluar || 0);

    } catch (e) {
        console.error(e);
        // alert('Terjadi kesalahan: ' + e.message);
    }
}

function renderMasuk(items, total) {
    let html = '';
    if (items.length === 0) {
        document.getElementById('bodyMasuk').innerHTML =
            '<tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada transaksi masuk pada periode ini</td></tr>';
    } else {
        items.forEach(trx => {
            html += `
                <tr>
                    <td>${formatTanggal(trx.tanggal_transaksi)}</td>
                    <td>${trx.kode_barang ?? '-'}</td>
                    <td>${trx.nama_barang ?? '-'}</td>
                    <td>${trx.seri ?? '-'}</td>
                    <td class="text-end fw-bold">${Number(trx.jumlah_barang || 0).toLocaleString('id-ID')}</td>
                    <td>${trx.diberikan_oleh ?? '-'}</td>
                </tr>`;
        });
        document.getElementById('bodyMasuk').innerHTML = html;
    }
    document.getElementById('totalMasukDetail').textContent = Number(total || 0).toLocaleString('id-ID');
}

function renderKeluar(items, total) {
    let html = '';
    if (items.length === 0) {
        document.getElementById('bodyKeluar').innerHTML =
            '<tr><td colspan="7" class="text-center py-4 text-muted">Tidak ada transaksi keluar pada periode ini</td></tr>';
    } else {
        items.forEach(trx => {
            html += `
                <tr>
                    <td>${formatTanggal(trx.tanggal_transaksi)}</td>
                    <td>${trx.kode_barang ?? '-'}</td>
                    <td>${trx.nama_barang ?? '-'}</td>
                    <td>${trx.seri ?? '-'}</td>
                    <td class="text-end fw-bold">${Number(trx.jumlah_barang || 0).toLocaleString('id-ID')}</td>
                    <td>${trx.keperluan_transaksi ?? '-'}</td>
                    <td>${trx.diberikan_oleh ?? '-'}</td>
                </tr>`;
        });
        document.getElementById('bodyKeluar').innerHTML = html;
    }
    document.getElementById('totalKeluarDetail').textContent = Number(total || 0).toLocaleString('id-ID');
}

function formatTanggal(dateStr) {
    if (!dateStr) return '-';
    const date = new Date(dateStr);
    return isNaN(date.getTime()) ? '-' : date.toLocaleDateString('id-ID', {
        day: '2-digit', month: '2-digit', year: 'numeric'
    });
}

// ==================== EVENT LISTENER ====================
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    loadRekap();
});

// Load pertama kali dengan sedikit delay agar input date terisi
document.addEventListener('DOMContentLoaded', function() {
    // Beri sedikit waktu agar value dari Blade masuk
    setTimeout(() => {
        loadRekap();
    }, 300); // 300ms biasanya cukup
});
</script>
@endsection
