<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BukuStokController extends Controller
{
public function index()
{
    // Ambil semua transaksi dengan LEFT JOIN ke barang (sekali query)
    $transaksis = Transaksi::leftJoin('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
        ->select(
            'transaksi.*',
            'barang.kode_barang',
            'barang.nama_barang',
            'barang.seri',
            'barang.stok_awal'        // tambahkan jika perlu
        )
        ->orderBy('transaksi.tanggal_transaksi', 'desc')
        ->cursor();

    // Ambil daftar barang aktif (untuk barangSummary)
    $barangList = Barang::where('STATUS_BARANG', '!=', '2')
        ->orderBy('nama_barang')
        ->get();

    // Grouping berdasarkan bulan
    $grouped = $transaksis->groupBy(function ($item) {
        return Carbon::parse($item->tanggal_transaksi)->format('Y-m');
    });

    $firstMonthKey = now()->format('Y-m');
    $futureAdjustments = $this->getFutureAdjustments($firstMonthKey);

    // === Barang Summary untuk Bulan Ini ===
    $barangSummary = [];
    foreach ($barangList as $b) {
        $trxThisMonth = $grouped->get($firstMonthKey, collect())
                                ->where('id_barang', $b->id_barang);

        $masuk  = (int) $trxThisMonth->where('tipe_transaksi', 'masuk')->sum('jumlah_barang');
        $keluar = (int) $trxThisMonth->where('tipe_transaksi', 'keluar')->sum('jumlah_barang');

        $adjustment   = $futureAdjustments[$b->id_barang] ?? 0;
        $currentStock = (int) $b->stok_awal + $adjustment;

        $barangSummary[] = [
            'kode_barang' => $b->kode_barang,
            'nama_barang' => $b->nama_barang,
            'seri'        => $b->seri ?? '-',
            'stok_awal'   => $currentStock - $masuk + $keluar,
            'masuk'       => $masuk,
            'keluar'      => $keluar,
            'stok_akhir'  => $currentStock,
        ];
    }

    // === Summary per Bulan (mundur) ===
    $lastMonth = $transaksis->isNotEmpty() 
        ? Carbon::parse($transaksis->last()->tanggal_transaksi)->startOfMonth()
        : now()->startOfMonth();

    $months = collect();
    $summaries = collect();

    for ($date = now()->startOfMonth(); $date->gte($lastMonth); $date->subMonth()) {
        $key = $date->format('Y-m');
        $items = $grouped->get($key, collect());

        $masuk  = (int) $items->where('tipe_transaksi', 'masuk')->sum('jumlah_barang');
        $keluar = (int) $items->where('tipe_transaksi', 'keluar')->sum('jumlah_barang');

        $months[$key] = $items;
        $summaries[$key] = [
            'masuk'  => $masuk,
            'keluar' => $keluar,
            'netto'  => $masuk - $keluar,
        ];
    }

    return view('page.bukuStok.index', compact(
        'months', 
        'summaries', 
        'barangList', 
        'barangSummary'
    ));
}
public function rekapMonth($bulan)
{
    $targetMonth = Carbon::createFromFormat('Y-m', $bulan);
    $start = $targetMonth->copy()->startOfMonth();
    $end   = $targetMonth->copy()->endOfMonth();

    // Ambil transaksi bulan tersebut
    $transaksis = Transaksi::leftJoin('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
        ->whereBetween('tanggal_transaksi', [$start, $end])
        ->select('transaksi.*', 'barang.kode_barang', 'barang.nama_barang', 'barang.seri')
        ->get();

    $barangList = Barang::where('STATUS_BARANG', '!=', '2')
                    ->orderBy('nama_barang')
                    ->get();

    $futureAdjustments = $this->getFutureAdjustments($bulan);

    $barangSummary = $this->calculateBarangSummary($barangList, $transaksis, $futureAdjustments);

    return response()->json($barangSummary);
}

    private function getFutureAdjustments(string $targetMonth)
    {
        $endOfMonth = Carbon::createFromFormat('Y-m', $targetMonth)->endOfMonth();

        return Transaksi::select('id_barang')
            ->selectRaw("
                SUM(CASE WHEN tipe_transaksi = 'keluar' THEN jumlah_barang ELSE 0 END) -
                SUM(CASE WHEN tipe_transaksi = 'masuk'  THEN jumlah_barang ELSE 0 END) as adjustment
            ")
            ->whereDate('tanggal_transaksi', '>', $endOfMonth)
            ->groupBy('id_barang')
            ->pluck('adjustment', 'id_barang')
            ->toArray();
    }

    public function flipbookMonth($bulan)
    {
        $cacheKey = "buku_stok_{$bulan}";

        return Cache::remember($cacheKey, now()->addMinutes(1), function () use ($bulan) {
            $targetMonth = Carbon::createFromFormat('Y-m', $bulan);
            $start = $targetMonth->copy()->startOfMonth();
            $end   = $targetMonth->copy()->endOfMonth();

            $transaksis = Transaksi::leftJoin('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
                ->whereBetween('tanggal_transaksi', [$start, $end])
                ->select('transaksi.*', 'barang.kode_barang', 'barang.nama_barang', 'barang.seri')
                ->orderBy('tanggal_transaksi')
                ->get();

            $futureAdjustments = $this->getFutureAdjustments($bulan);
            $barangList = Barang::orderBy('nama_barang')->get();

            $barangSummary = $this->calculateBarangSummary($barangList, $transaksis, $futureAdjustments);

            // ... (summary & return view sama seperti sebelumnya)
            $masukItems  = $transaksis->where('tipe_transaksi', 'masuk');
            $keluarItems = $transaksis->where('tipe_transaksi', 'keluar');

            $summary = [
                'masuk'  => $masukItems->sum('jumlah_barang'),
                'keluar' => $keluarItems->sum('jumlah_barang'),
                'netto'  => $masukItems->sum('jumlah_barang') - $keluarItems->sum('jumlah_barang'),
            ];

            // dd($summary,$masukItems,$keluarItems);


            return view('page.bukuStok.flipbook_month', compact(
                'bulan', 'masukItems', 'keluarItems', 'summary', 'barangSummary'
            ))->render();
        });
    }

    // Helper baru untuk menghindari duplikasi kode
    private function calculateBarangSummary($barangList, $transaksis, $futureAdjustments)
    {
        $result = [];
        foreach ($barangList as $b) {
            $trx = $transaksis->where('id_barang', $b->id_barang);

            $masuk  = (int)$trx->where('tipe_transaksi', 'masuk')->sum('jumlah_barang');
            $keluar = (int)$trx->where('tipe_transaksi', 'keluar')->sum('jumlah_barang');

            $adjustment   = $futureAdjustments[$b->id_barang] ?? 0;
            $currentStock = (int)$b->stok_awal + $adjustment;

            $result[] = [
                'kode_barang' => $b->kode_barang,
                'nama_barang' => $b->nama_barang,
                'seri'        => $b->seri ?? '-',
                'stok_awal'   => $currentStock - $masuk + $keluar,
                'masuk'       => $masuk,
                'keluar'      => $keluar,
                'stok_akhir'  => $currentStock,
            ];
        }
        return $result;
    }
}