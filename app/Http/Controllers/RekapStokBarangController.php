<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class RekapStokBarangController extends Controller
{
    /**
     * Smart Cache Key
     */
    private function getLastUpdatedKey(): string
    {
        $lastUpdated = Transaksi::max('updated_at') ?? now();
        return Carbon::parse($lastUpdated)->format('YmdHis');
    }

    public function index()
    {
        $start = now()->subDays(7)->startOfDay();
        $end   = now()->endOfDay();

        return view('page.rekapStokBarang.index', compact('start', 'end'));
    }

   public function rekapHarian(Request $request)
{
    $request->validate([
        'tanggal_awal'  => 'required|date',
        'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
    ]);

    $start = Carbon::parse($request->tanggal_awal)->startOfDay();
    $end   = Carbon::parse($request->tanggal_akhir)->endOfDay();

    $lastUpdated = $this->getLastUpdatedKey();
    $cacheKey = "rekap_stok_harian_{$start->format('Ymd')}_{$end->format('Ymd')}_{$lastUpdated}";

    return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($start, $end) {
        $transaksis = Transaksi::leftJoin('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
            ->whereBetween('tanggal_transaksi', [$start, $end])
            ->select(
                'transaksi.*',
                'barang.kode_barang',
                'barang.nama_barang',
                'barang.seri'
            )
            ->orderBy('tanggal_transaksi')
            ->get();

        $barangList = Barang::where('STATUS_BARANG', '!=', '2')
            ->orderBy('nama_barang')
            ->get();

        $futureAdjustments = $this->getFutureAdjustmentsAfterDate($end);

        $barangSummary = $this->calculateBarangSummary($barangList, $transaksis, $futureAdjustments);

        // Sorting summary
        $barangSummary = collect($barangSummary)
            ->sort(function ($a, $b) {
                $aMasuk = (float)$a['masuk'];
                $bMasuk = (float)$b['masuk'];
                $aKeluar = (float)$a['keluar'];
                $bKeluar = (float)$b['keluar'];

                if ($aMasuk !== $bMasuk) return $bMasuk <=> $aMasuk;
                if ($aKeluar !== $bKeluar) return $bKeluar <=> $aKeluar;
                return strcmp($a['nama_barang'], $b['nama_barang']);
            })
            ->values()
            ->toArray();

        $masukItems  = $transaksis->where('tipe_transaksi', 'masuk');
        $keluarItems = $transaksis->where('tipe_transaksi', 'keluar');

        $totalMasuk  = $masukItems->sum('jumlah_barang');
        $totalKeluar = $keluarItems->sum('jumlah_barang');

        return response()->json([
            'success'       => true,
            'barangSummary' => $barangSummary,
            'masukItems'    => $masukItems->values(),   // tambahan
            'keluarItems'   => $keluarItems->values(),  // tambahan
            'totalMasuk'    => $totalMasuk,
            'totalKeluar'   => $totalKeluar,
            'start'         => $start->toDateString(),
            'end'           => $end->toDateString(),
            'periode'       => $start->translatedFormat('d F Y') . ' s/d ' . $end->translatedFormat('d F Y')
        ]);
    });
}

    private function getFutureAdjustmentsAfterDate(Carbon $date)
    {
        return Transaksi::select('id_barang')
            ->selectRaw("
                SUM(CASE WHEN tipe_transaksi = 'keluar' THEN jumlah_barang ELSE 0 END) -
                SUM(CASE WHEN tipe_transaksi = 'masuk'  THEN jumlah_barang ELSE 0 END) as adjustment
            ")
            ->whereDate('tanggal_transaksi', '>', $date)
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
                'stok_awal'   => $currentStock - $masuk + $keluar,   // stok sebelum periode
                'masuk'       => $masuk,
                'keluar'      => $keluar,
                'stok_akhir'  => $currentStock,
            ];
        }
        return $result;
    }
}
