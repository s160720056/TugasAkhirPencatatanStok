<!DOCTYPE html>
<html>
<head>
    @php
\Carbon\Carbon::setLocale('id');
@endphp
    <meta charset="UTF-8">
    <title>Buku Kas - PDF</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #222;
        }

        h1 {
            text-align: center;
            margin-bottom: 1rem;
        }

        h2 {
            margin-top: 2rem;
            margin-bottom: 0.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        table th,
        table td {
            border: 1px solid #888;
            padding: 6px;
        }

        table th {
            background: #f0f0f0;
        }

        .summary {
            margin-bottom: 2rem;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <h1>Buku Kas</h1>

    @foreach ($months as $bulan => $items)
        @php
            $pemasukanItems = $items->where('jenis_transaksi', 'pemasukan');
            $pengeluaranItems = $items->where('jenis_transaksi', 'pengeluaran');
            $summary = $summaries->get($bulan, ['pemasukan' => 0, 'pengeluaran' => 0, 'saldo' => 0]);
        @endphp

        <div class="month">
            <h2>{{ \Carbon\Carbon::parse($bulan . '-01')->translatedFormat('F Y') }} <br>
                Pemasukan</h2>

            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemasukanItems as $trx)
                        <tr>
                            <td>{{ $trx->tanggal_transaksi }}</td>
                            <td>{{ $trx->nama_kategori }}</td>
                            <td>{{ $trx->keterangan_transaksi }}</td>
                            <td style="text-align: right;">{{ number_format($trx->nominal_transaksi, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak ada transaksi pemasukan.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right; font-weight: bold;">Subtotal Pemasukan</td>
                        <td style="text-align: right; font-weight: bold;">{{ number_format($summary['pemasukan'], 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="page-break"></div>

        <div class="month">
            <h2>{{ \Carbon\Carbon::parse($bulan . '-01')->translatedFormat('F Y') }} <br>Pengeluaran</h2>

            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengeluaranItems as $trx)
                        <tr>
                            <td>{{ $trx->tanggal_transaksi }}</td>
                            <td>{{ $trx->nama_kategori }}</td>
                            <td>{{ $trx->keterangan_transaksi }}</td>
                            <td style="text-align: right;">{{ number_format($trx->nominal_transaksi, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak ada transaksi pengeluaran.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right; font-weight: bold;">Subtotal Pengeluaran</td>
                        <td style="text-align: right; font-weight: bold;">{{ number_format($summary['pengeluaran'], 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; font-weight: bold;">Saldo</td>
                        <td style="text-align: right; font-weight: bold;">{{ number_format($summary['saldo'], 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="page-break"></div>
    @endforeach
</body>
</html>
