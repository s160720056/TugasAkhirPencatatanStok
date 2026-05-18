<div class="page" data-month="{{ $bulan }}" style="font-size: 13px; max-height: 90vh; overflow-y: auto; padding: 10px;">
    <h3 style="text-align:center; position: sticky; top: 0; background: white; padding: 10px 0; z-index: 10;">
        {{ \Carbon\Carbon::parse($bulan . '-01')->translatedFormat('F Y') }}
        <br> Barang Masuk
    </h3>

    @if ($masukItems->isEmpty())
        <p style="text-align:center; margin-top: 50px; font-size: 13px;">Tidak ada transaksi barang masuk pada bulan ini.</p>
    @else
        <div style="max-height: 90%; overflow-y: auto; border: 1px solid #ccc;">
            <table border="1" width="100%" style="font-size: 13px; border-collapse: collapse;">
                <thead style="position: sticky; top: 0; background: #f8f9fa; z-index: 5;">
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Seri</th>
                        <th>Jumlah</th>
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
                            <td>{{ $trx->diberikan_oleh ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Total -->
    <table border="1" width="100%" style="margin-top: 10px; font-size: 13px;">
        <tr>
            <td colspan="5" style="text-align: right; font-weight: bold;">Total Barang Masuk</td>
            <td style="text-align: right; font-weight: bold; color: green;">
                {{ number_format($summary['masuk'] ?? 0, 0, ',', '.') }} Unit
            </td>
        </tr>
    </table>
</div>

<!-- Halaman 2 -->
<div class="page" data-month="{{ $bulan }}" style="font-size: 13px; max-height: 90vh; overflow-y: auto; padding: 10px; margin-top: 20px;">
    <h3 style="text-align:center; position: sticky; top: 0; background: white; padding: 10px 0; z-index: 10;">
        {{ \Carbon\Carbon::parse($bulan . '-01')->translatedFormat('F Y') }}
        <br> Barang Keluar & Rekap Stok
    </h3>

    @if ($keluarItems->isEmpty())
        <p style="text-align:center; margin-top: 50px; font-size: 13px;">Tidak ada transaksi barang keluar pada bulan ini.</p>
    @else
        <div style="max-height: 90%; overflow-y: auto; border: 1px solid #ccc;">
            <table border="1" width="100%" style="font-size: 13px; border-collapse: collapse;">
                <thead style="position: sticky; top: 0; background: #f8f9fa; z-index: 5;">
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
        </div>
    @endif

    <!-- Total Keluar -->
    <table border="1" width="100%" style="margin-top: 10px; font-size: 13px;">
        <tr>
            <td colspan="6" style="text-align: right; font-weight: bold;">Total Barang Keluar</td>
            <td style="text-align: right; font-weight: bold; color: red;">
                {{ number_format($summary['keluar'] ?? 0, 0, ',', '.') }} Unit
            </td>
        </tr>
    </table>
</div>
