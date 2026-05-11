<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class BukuStokController extends Controller
{
    /**
     * Smart Cache Key berdasarkan last update transaksi
     */
    private function getLastUpdatedKey(): string
    {
        $lastUpdated = Transaksi::max('updated_at') ?? now();
        return Carbon::parse($lastUpdated)->format('YmdHis'); // Example: 20260511143322
    }

    public function index()
    {
        $cacheKey = 'buku_stok_index_' . $this->getLastUpdatedKey();

        return Cache::remember($cacheKey, now()->addHours(12), function () {
            $barangList = Barang::where('STATUS_BARANG', '!=', '2')
                ->orderBy('nama_barang')
                ->get();

            $transaksis = Transaksi::leftJoin('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
                ->select(
                    'transaksi.*',
                    'barang.kode_barang',
                    'barang.nama_barang',
                    'barang.seri',
                    'barang.stok_awal'
                )
                ->orderBy('transaksi.tanggal_transaksi', 'desc')
                ->cursor();

            $grouped = $transaksis->groupBy(fn($item) => 
                Carbon::parse($item->tanggal_transaksi)->format('Y-m')
            );

            $firstMonthKey = now()->format('Y-m');
            $futureAdjustments = $this->getFutureAdjustments($firstMonthKey);

            $barangSummary = $this->calculateBarangSummary(
                $barangList, 
                $grouped->get($firstMonthKey, collect()), 
                $futureAdjustments
            );

            // Summary per bulan
            $lastMonth = $transaksis->isNotEmpty() 
                ? Carbon::parse($transaksis->last()->tanggal_transaksi)->startOfMonth()
                : now()->startOfMonth();

            $months = collect();
            $summaries = collect();

            for ($date = now()->startOfMonth(); $date->gte($lastMonth); $date->subMonth()) {
                $key = $date->format('Y-m');
                $items = $grouped->get($key, collect());

                $masuk  = (int)$items->where('tipe_transaksi', 'masuk')->sum('jumlah_barang');
                $keluar = (int)$items->where('tipe_transaksi', 'keluar')->sum('jumlah_barang');

                $months[$key] = $items;
                $summaries[$key] = [
                    'masuk'  => $masuk,
                    'keluar' => $keluar,
                    'netto'  => $masuk - $keluar,
                ];
            }
         

            return view('page.bukuStok.index', compact(
                'months', 'summaries', 'barangList', 'barangSummary'
            ))->render(); // render agar bisa di-cache
        });
    }

    public function flipbookMonth($bulan)
    {
        $lastUpdated = $this->getLastUpdatedKey();
        $cacheKey = "buku_stok_flipbook_{$bulan}_{$lastUpdated}";

        return Cache::remember($cacheKey, now()->addHours(12), function () use ($bulan) {
            $targetMonth = Carbon::createFromFormat('Y-m', $bulan);
            $start = $targetMonth->copy()->startOfMonth();
            $end   = $targetMonth->copy()->endOfMonth();

            $transaksis = Transaksi::leftJoin('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
                ->whereBetween('tanggal_transaksi', [$start, $end])
                ->select('transaksi.*', 'barang.kode_barang', 'barang.nama_barang', 'barang.seri', 'barang.stok_awal')
                ->orderBy('tanggal_transaksi')
                ->get();

            $barangList = Barang::where('STATUS_BARANG', '!=', '2')
                            ->orderBy('nama_barang')
                            ->get();

            $futureAdjustments = $this->getFutureAdjustments($bulan);
            $barangSummary = $this->calculateBarangSummary($barangList, $transaksis, $futureAdjustments);

            $masukItems  = $transaksis->where('tipe_transaksi', 'masuk');
            $keluarItems = $transaksis->where('tipe_transaksi', 'keluar');

            $summary = [
                'masuk'  => $masukItems->sum('jumlah_barang'),
                'keluar' => $keluarItems->sum('jumlah_barang'),
                'netto'  => $masukItems->sum('jumlah_barang') - $keluarItems->sum('jumlah_barang'),
            ];

            return view('page.bukuStok.flipbook_month', compact(
                'bulan', 'masukItems', 'keluarItems', 'summary', 'barangSummary'
            ))->render();
        });
    }

    public function rekapMonth($bulan)
    {
        $lastUpdated = $this->getLastUpdatedKey();
        $cacheKey = "buku_stok_rekap_{$bulan}_{$lastUpdated}";

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($bulan) {
            $targetMonth = Carbon::createFromFormat('Y-m', $bulan);
            $start = $targetMonth->copy()->startOfMonth();
            $end   = $targetMonth->copy()->endOfMonth();

            $transaksis = Transaksi::leftJoin('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
                ->whereBetween('tanggal_transaksi', [$start, $end])
                ->select('transaksi.*', 'barang.kode_barang', 'barang.nama_barang', 'barang.seri', 'barang.stok_awal')
                ->orderBy('tanggal_transaksi')
                ->get();

            $barangList = Barang::where('STATUS_BARANG', '!=', '2')
                            ->orderBy('nama_barang')
                            ->get();

            $futureAdjustments = $this->getFutureAdjustments($bulan);
            $barangSummary = $this->calculateBarangSummary($barangList, $transaksis, $futureAdjustments);

            return response()->json($barangSummary);
        });
    }

    // ==================== HELPER ====================

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