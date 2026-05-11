<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BukuStokController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::leftJoin('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
            ->select('transaksi.*', 'barang.kode_barang', 'barang.nama_barang', 'barang.seri')
            ->orderBy('tanggal_transaksi', 'desc')
            // ->where('transaksi.STATUS_TRANSAKSI', '!=', '2')
            ->get();

        $grouped = $transaksis->groupBy(function ($item) {
            return Carbon::parse($item->tanggal_transaksi)->format('Y-m');
        });

        $barangList = Barang::where('STATUS_BARANG', '!=', '2')->orderBy('nama_barang')->get();
        $months = collect();
        $summaries = collect();
        $barangSummary = [];   // ← Tambahkan ini

        if ($transaksis->isEmpty()) {
            return view('page.bukuStok.index', compact('months', 'summaries', 'barangList', 'barangSummary'));
        }

        // $firstMonthKey = $transaksis->first()->tanggal_transaksi
        //     ? Carbon::parse($transaksis->first()->tanggal_transaksi)->format('Y-m')
        //     : null;
        $firstMonthKey = now()->format('Y-m');

        // Hitung barangSummary untuk bulan pertama
        if ($firstMonthKey) {
            $firstMonthTransaksi = $grouped->get($firstMonthKey, collect());

            foreach ($barangList as $b) {
                $trx = $firstMonthTransaksi->where('id_barang', $b->id_barang);

                $masuk = (int) $trx->where('tipe_transaksi', 'masuk')->sum('jumlah_barang');
                $keluar = (int) $trx->where('tipe_transaksi', 'keluar')->sum('jumlah_barang');

                /*
|--------------------------------------------------------------------------
| Reverse stok dari transaksi masa depan
|--------------------------------------------------------------------------
*/

                $targetMonth = Carbon::createFromFormat('Y-m', $firstMonthKey);

                $currentStock = (int) $b->stok_awal;

                $futureTransactions = Transaksi::where('id_barang', $b->id_barang)
                    ->whereDate(
                        'tanggal_transaksi',
                        '>',
                        $targetMonth->copy()->endOfMonth()
                    )
                    ->get();

                foreach ($futureTransactions as $ft) {
                    if ($ft->tipe_transaksi == 'masuk') {
                        $currentStock -= (int) $ft->jumlah_barang;
                    } else {
                        $currentStock += (int) $ft->jumlah_barang;
                    }
                }

                /*
|--------------------------------------------------------------------------
| Hitung stok bulan target
|--------------------------------------------------------------------------
*/

                $stokAwal = $currentStock - $masuk + $keluar;
                $stokAkhir = $currentStock;

                $barangSummary[] = [
                    'kode_barang' => $b->kode_barang,
                    'nama_barang' => $b->nama_barang,
                    'seri'        => $b->seri ?? '-',
                    'stok_awal'   => $stokAwal,
                    'masuk'       => $masuk,
                    'keluar'      => $keluar,
                    'stok_akhir'  => $stokAkhir,
                ];
            }
        }

        // Isi months dan summaries (dari bulan lama ke baru)
        // $lastMonth  = Carbon::parse($transaksis->last()->tanggal_transaksi)->startOfMonth();
        // $firstMonth = Carbon::parse($transaksis->first()->tanggal_transaksi)->startOfMonth();
        $lastMonth  = Carbon::parse($transaksis->last()->tanggal_transaksi)->startOfMonth();

        $firstMonth = now()->startOfMonth();
        for ($date = $firstMonth->copy(); $date->gte($lastMonth); $date->subMonth()) {
            $key = $date->format('Y-m');
            $items = $grouped->get($key, collect());

            $months[$key] = $items;

            $masuk = $items->where('tipe_transaksi', 'masuk')->sum('jumlah_barang');
            $keluar = $items->where('tipe_transaksi', 'keluar')->sum('jumlah_barang');

            $summaries[$key] = [
                'masuk'  => $masuk,
                'keluar' => $keluar,
                'netto'  => $masuk - $keluar,
            ];
        }

        return view('page.bukuStok.index', compact('months', 'summaries', 'barangList', 'barangSummary'));
    }

    public function flipbookMonth($bulan)
    {
        $targetMonth = Carbon::createFromFormat('Y-m', $bulan)->startOfMonth();

        $transaksis = Transaksi::leftJoin('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
            ->whereBetween('tanggal_transaksi', [$targetMonth->copy()->startOfMonth(), $targetMonth->copy()->endOfMonth()])
            ->select('transaksi.*', 'barang.kode_barang', 'barang.nama_barang', 'barang.seri')
            ->orderBy('tanggal_transaksi')
            ->get();

        $barangList = Barang::orderBy('nama_barang')->get();

        $barangSummary = [];
        foreach ($barangList as $b) {
            $trx = $transaksis->where('id_barang', $b->id_barang);

            $masuk = (int) $trx->where('tipe_transaksi', 'masuk')->sum('jumlah_barang');
            $keluar = (int) $trx->where('tipe_transaksi', 'keluar')->sum('jumlah_barang');
            $currentStock = (int) $b->stok_awal;

            /*
|--------------------------------------------------------------------------
| Reverse transaksi setelah bulan target
|--------------------------------------------------------------------------
| Jika ada transaksi setelah bulan ini:
| - transaksi masuk  -> kurangi
| - transaksi keluar -> tambahkan
|--------------------------------------------------------------------------
*/

            $futureTransactions = Transaksi::where('id_barang', $b->id_barang)
                ->whereDate('tanggal_transaksi', '>', $targetMonth->copy()->endOfMonth())
                ->get();

            foreach ($futureTransactions as $ft) {
                if ($ft->tipe_transaksi == 'masuk') {
                    $currentStock -= (int) $ft->jumlah_barang;
                } else {
                    $currentStock += (int) $ft->jumlah_barang;
                }
            }

            /*
|--------------------------------------------------------------------------
| Stok awal bulan
|--------------------------------------------------------------------------
*/
            $stokAwal = $currentStock - $masuk + $keluar;

            /*
|--------------------------------------------------------------------------
| Stok akhir bulan
|--------------------------------------------------------------------------
*/
            $stokAkhir = $currentStock;

            $barangSummary[] = [
                'nama_barang' => $b->nama_barang,
                'kode_barang' => $b->kode_barang,
                'seri'        => $b->seri ?? '-',
                'stok_awal'   => $stokAwal,
                'masuk'       => $masuk,
                'keluar'      => $keluar,
                'stok_akhir'  => $stokAkhir,
            ];
        }

        $masukItems = $transaksis->where('tipe_transaksi', 'masuk');
        $keluarItems = $transaksis->where('tipe_transaksi', 'keluar');

        $summary = [
            'masuk'  => $masukItems->sum('jumlah_barang'),
            'keluar' => $keluarItems->sum('jumlah_barang'),
            'netto'  => $masukItems->sum('jumlah_barang') - $keluarItems->sum('jumlah_barang'),
        ];

        return view('page.bukuStok.flipbook_month', compact(
            'bulan',
            'masukItems',
            'keluarItems',
            'summary',
            'barangSummary'
        ));
    }
}
