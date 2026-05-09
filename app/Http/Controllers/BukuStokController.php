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

    $firstMonthKey = $transaksis->first()->tanggal_transaksi 
        ? Carbon::parse($transaksis->first()->tanggal_transaksi)->format('Y-m') 
        : null;

    // Hitung barangSummary untuk bulan pertama
    if ($firstMonthKey) {
        $firstMonthTransaksi = $grouped->get($firstMonthKey, collect());

        foreach ($barangList as $b) {
            $trx = $firstMonthTransaksi->where('id_barang', $b->id_barang);

            $masuk = (int) $trx->where('tipe_transaksi', 'masuk')->sum('jumlah_barang');
            $keluar = (int) $trx->where('tipe_transaksi', 'keluar')->sum('jumlah_barang');
            $stokAwal = (int) $b->stok_awal;
            $stokAkhir = $stokAwal + $masuk - $keluar;

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
    $lastMonth  = Carbon::parse($transaksis->last()->tanggal_transaksi)->startOfMonth();
    $firstMonth = Carbon::parse($transaksis->first()->tanggal_transaksi)->startOfMonth();

    for ($date = $lastMonth->copy(); $date->lte($firstMonth); $date->addMonth()) {
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
            $stokAwal = (int) $b->stok_awal;
            $stokAkhir = $stokAwal + $masuk - $keluar;

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