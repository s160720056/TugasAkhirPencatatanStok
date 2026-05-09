
<div class="page" data-month="{{ $bulan }}">
    <h3 style="text-align:center">
        {{ \Carbon\Carbon::parse($bulan . '-01')->translatedFormat('F Y') }} 
        <br> Barang Masuk
    </h3>

    @if ($masukItems->isEmpty())
        <p style="text-align:center; margin-top: 50px; font-size: 16px;">Tidak ada transaksi barang masuk pada bulan ini.</p>
    @else
        <table border="1" width="100%" style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Seri</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Diberikan Oleh</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($masukItems as $trx)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d-m-Y') }}</td>
                        <td>{{ $trx->kode_barang ?? '-' }}</td>
                        <td>{{ $trx->nama_barang ?? '-' }}</td>
                        <td>{{ $trx->seri ?? '-' }}</td>
                        <td style="text-align: right; font-weight: bold;">
                            {{ number_format($trx->jumlah_barang, 0, ',', '.') }}
                        </td>
                        <td>{{ $trx->keterangan_transaksi ?? '-' }}</td>
                        <td>{{ $trx->diberikan_oleh ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <table border="1" width="100%" style="margin-top: 15px;">
        <tr>
            <td colspan="6" style="text-align: right; font-weight: bold;">Total Barang Masuk</td>
            <td style="text-align: right; font-weight: bold; color: green;">
                {{ number_format($summary['masuk'] ?? 0, 0, ',', '.') }} Unit
            </td>
        </tr>
    </table>
</div>

<!-- Halaman 2: Barang Keluar & Rekap Stok -->
<div class="page" data-month="{{ $bulan }}">
    <h3 style="text-align:center">
        {{ \Carbon\Carbon::parse($bulan . '-01')->translatedFormat('F Y') }} 
        <br> Barang Keluar & Rekap Stok
    </h3>

    @if ($keluarItems->isEmpty())
        <p style="text-align:center; margin-top: 50px; font-size: 16px;">Tidak ada transaksi barang keluar pada bulan ini.</p>
    @else
        <table border="1" width="100%" style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Seri</th>
                    <th>Jumlah</th>
                    <th>Keperluan</th>
                    <th>Diberikan Oleh</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keluarItems as $trx)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d-m-Y') }}</td>
                        <td>{{ $trx->kode_barang ?? '-' }}</td>
                        <td>{{ $trx->nama_barang ?? '-' }}</td>
                        <td>{{ $trx->seri ?? '-' }}</td>
                        <td style="text-align: right; font-weight: bold;">
                            {{ number_format($trx->jumlah_barang, 0, ',', '.') }}
                        </td>
                        <td>{{ $trx->keperluan_transaksi ?? '-' }}</td>
                        <td>{{ $trx->diberikan_oleh ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
 
    <table border="1" width="100%" style="margin-top: 15px;">
        <tr>
            <td colspan="6" style="text-align: right; font-weight: bold;">Total Barang Keluar</td>
            <td style="text-align: right; font-weight: bold; color: red;">
                {{ number_format($summary['keluar'] ?? 0, 0, ',', '.') }} Unit
            </td>
        </tr>
    </table>

    <h4 style="margin-top: 30px; text-align:center;">Rekap Stok per Barang</h4>
    
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Seri</th>
                <th>Stok Awal</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangSummary as $b)
                <tr>
                    <td>{{ $b['kode_barang'] }}</td>
                    <td>{{ $b['nama_barang'] }}</td>
                    <td>{{ $b['seri'] ?? '-' }}</td>
                    <td style="text-align: right;">{{ number_format($b['stok_awal'], 0, ',', '.') }}</td>
                    <td style="text-align: right; color: green;">+{{ number_format($b['masuk'], 0, ',', '.') }}</td>
                    <td style="text-align: right; color: red;">-{{ number_format($b['keluar'], 0, ',', '.') }}</td>
                    <td style="text-align: right; font-weight: bold;">{{ number_format($b['stok_akhir'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>