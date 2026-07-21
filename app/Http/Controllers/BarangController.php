<?php

namespace App\Http\Controllers;

use App\Exports\ExportBarang;
use App\Models\Barang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }

        return view('page.barang.index');
    }

    public function indexWebView()
    {
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }
        $webView = true;

        return view('page.barang.index', compact('webView'));
    }

    // DataTable
public function getDataTable(Request $request)
    {
        $barang = Barang::select([
            'id_barang',
            'kode_barang',
            'nama_barang',
            'seri',
            'stok_awal',
            'tanggal_input',
            'STATUS_BARANG',
            'harga_satuan',
        ])
            ->where('STATUS_BARANG', '!=', '2');

        // ================= FILTER RANGE TANGGAL =================
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $barang->whereBetween('tanggal_input', [
                $request->tanggal_awal,
                $request->tanggal_akhir,
            ]);
        }
        // Jika hanya tanggal_awal (fallback)
        elseif ($request->filled('tanggal_awal')) {
            $barang->whereDate('tanggal_input', '>=', $request->tanggal_awal);
        }

        return DataTables::of($barang)
            ->addIndexColumn()

            // Format kolom-kolom tertentu
            ->editColumn('stok_awal', fn ($row) => $row->stok_awal ?? 0)
            ->editColumn('harga_satuan', fn ($row) => $row->harga_satuan ?? 0)
            ->editColumn('seri', fn ($row) => $row->seri ?? '-')
            ->editColumn('tanggal_input', fn ($row) => $row->tanggal_input
                ? Carbon::parse($row->tanggal_input)->format('d/m/Y')
                : '-')

            /*
        |--------------------------------------------------------------------------
        | CUSTOM SEARCH DINAMIS (BEBAS URUTAN KATA)
        |--------------------------------------------------------------------------
        */
            ->filterColumn('nama_barang', function ($query, $keyword) {
                $keywords = explode(' ', $keyword);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        if (!empty($word)) {
                            $q->where('nama_barang', 'like', "%{$word}%");
                        }
                    }
                });
            })

            ->filterColumn('kode_barang', function ($query, $keyword) {
                $keywords = explode(' ', $keyword);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        if (!empty($word)) {
                            $q->where('kode_barang', 'like', "%{$word}%");
                        }
                    }
                });
            })

            ->filterColumn('seri', function ($query, $keyword) {
                $keywords = explode(' ', $keyword);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        if (!empty($word)) {
                            $q->where('seri', 'like', "%{$word}%");
                        }
                    }
                });
            })

            ->make(true);
    }

    public function getData()
    {
        $barang = Barang::select('id_barang', 'kode_barang', 'nama_barang', 'seri')
            ->whereNotIn('STATUS_BARANG', ['0', '2'])
            ->get();

        return response()->json($barang);
    }

    public function export_excel()
    {
        return Excel::download(new ExportBarang, 'barang.xlsx');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'kode_barang' => 'required|max:255',
                'nama_barang' => 'required|string|max:255',
                'seri' => 'nullable|string',
                'stok_awal' => 'nullable|integer|min:0',
                'harga_satuan' => 'nullable|integer|min:0',
            ]);

            $stokMasuk = $request->stok_awal ?? 0;
            $hargaSatuan = $request->harga_satuan ?? 0;

            /*
            |--------------------------------------------------------------------------
            | CEK BARANG DUPLIKAT
            |--------------------------------------------------------------------------
            | kode_barang tidak dipakai untuk cek duplikat
            | karena kode barang boleh berbeda untuk barang yang sama
            |--------------------------------------------------------------------------
            */

            $seri = trim($request->seri ?? '');

            $barang = Barang::where('nama_barang', $request->nama_barang)
                ->where('harga_satuan', $hargaSatuan)
                ->where('STATUS_BARANG', '1')
                ->where(function ($query) use ($seri) {
                    if ($seri === '') {
                        $query->whereNull('seri')
                            ->orWhere('seri', '');
                    } else {
                        $query->where('seri', $seri);
                    }
                })
                ->orderBy('id_barang', 'asc')
                ->first();

            $isBarangBaru = false;

            if (! $barang) {
                $isBarangBaru = true;

                $barang = Barang::create([
                    'kode_barang' => $request->kode_barang,
                    'nama_barang' => $request->nama_barang,
                    'seri' => $seri !== '' ? $seri : null,
                    'stok_awal' => $stokMasuk,
                    'tanggal_input' => now()->toDateString(),
                    'STATUS_BARANG' => $request->STATUS_BARANG ?? '1',
                    'harga_satuan' => $hargaSatuan,
                ]);
            } else {
                $barang->update([
                    'stok_awal' => $barang->stok_awal + $stokMasuk,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | AUTO INSERT TRANSAKSI MASUK
            |--------------------------------------------------------------------------
            */

            $transaksi = Transaksi::create([
                'id_barang' => $barang->id_barang,
                'tipe_transaksi' => 'masuk',
                'jumlah_barang' => $stokMasuk,
                'harga_satuan' => $hargaSatuan,
                'jumlah_satuan' => $hargaSatuan * $stokMasuk,
                'keterangan_transaksi' => $isBarangBaru
                    ? 'Input barang baru'
                    : 'Tambah stok barang lama',
                'diberikan_oleh' => null,
                'keperluan_transaksi' => null,
                'tanggal_transaksi' => now(),
            ]);

            DB::commit();

            return response()->json([
                'message' => $isBarangBaru
                    ? 'Barang baru berhasil ditambahkan'
                    : 'Barang sudah ada, stok berhasil ditambahkan',
                'data' => $barang->fresh(),
                'transaksi' => $transaksi,
                'status' => $isBarangBaru ? 'barang_baru' : 'tambah_stok',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Gagal menyimpan barang',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getBarangDetail($id)
    {
        $barang = Barang::find($id);
        if (! $barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        return response()->json($barang);
    }

    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $barang = Barang::where('id_barang', $id)->first();
            if (! $barang) {
                return response()->json([
                    'message' => 'Barang tidak ditemukan',
                ], 404);
            }
            $request->validate([
                'kode_barang' => 'required|max:255',
                'nama_barang' => 'required|string|max:255',
                'seri' => 'nullable|string',
                // 'stok_awal'     => 'nullable|integer|min:0',
                'harga_satuan' => 'nullable|integer|min:0',
                // 'jumlah_satuan' => 'nullable|integer|min:0',
            ]);
            /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA LAMA
        |--------------------------------------------------------------------------
        */
            $stokLama = $barang->stok_awal ?? 0;
            $hargaLama = $barang->harga_satuan ?? 0;
            // $jumlahSatuanLama = $barang->jumlah_satuan ?? 0;
            /*
        |--------------------------------------------------------------------------
        | UPDATE BARANG
        |--------------------------------------------------------------------------
        */
            $barang->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'seri' => $request->seri,
                // 'stok_awal'      => $request->stok_awal ?? $barang->stok_awal,
                // 'tanggal_input'  => now()->toDateString(),
                // 'STATUS_BARANG'  => $request->STATUS_BARANG ?? $barang->STATUS_BARANG,
                'harga_satuan' => $request->harga_satuan ?? $barang->harga_satuan,
                // 'jumlah_satuan'  => $request->jumlah_satuan ?? $barang->jumlah_satuan,
            ]);
            /*
        |--------------------------------------------------------------------------
        | CEK TOTAL TRANSAKSI
        |--------------------------------------------------------------------------
        */
            $totalTransaksi = Transaksi::where('id_barang', $barang->id_barang)
                ->count();
            /*
        |--------------------------------------------------------------------------
        | JIKA HANYA ADA 1 TRANSAKSI
        |--------------------------------------------------------------------------
        */
            if ($totalTransaksi == 1) {
                $transaksiAwal = Transaksi::where('id_barang', $barang->id_barang)
                    ->where('tipe_transaksi', 'masuk')
                    ->first();
                /*
            |--------------------------------------------------------------------------
            | VALIDASI TRANSAKSI MASIH ORIGINAL
            |--------------------------------------------------------------------------
            */
                if (
                    $transaksiAwal &&
                    (int) $transaksiAwal->jumlah_barang === (int) $stokLama &&
                    (int) $transaksiAwal->harga_satuan === (int) $hargaLama &&
                    (int) $transaksiAwal->jumlah_satuan === (int) $hargaLama * $stokLama
                ) {
                    /*
                |--------------------------------------------------------------------------
                | UPDATE TRANSAKSI
                |--------------------------------------------------------------------------
                */
                    $transaksiAwal->update([
                        'jumlah_barang' => $request->stok_awal ?? 0,
                        'harga_satuan' => $request->harga_satuan ?? 0,
                        'jumlah_satuan' => $request->harga_satuan * $request->stok_awal ?? 0,
                        'tanggal_transaksi' => now(),
                    ]);
                }
            }
            DB::commit();

            return response()->json([
                'message' => 'Barang berhasil diperbarui',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Gagal memperbarui barang',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function checkDuplicate(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'seri' => 'nullable|string',
            'harga_satuan' => 'nullable|integer|min:0',
        ]);

        $hargaSatuan = $request->harga_satuan ?? 0;

        $seri = trim($request->seri ?? '');
        $hargaSatuan = $request->harga_satuan ?? 0;
        $barang = Barang::where('nama_barang', $request->nama_barang)
            ->where('harga_satuan', $hargaSatuan)
            ->where('STATUS_BARANG', '1')
            ->where(function ($query) use ($seri) {
                if ($seri === '') {
                    $query->whereNull('seri')
                        ->orWhere('seri', '');
                } else {
                    $query->where('seri', $seri);
                }
            })
            ->orderBy('id_barang', 'asc')
            ->first();

        if (! $barang) {
            return response()->json([
                'exists' => false,
                'message' => 'Barang belum ada, akan dibuat sebagai barang baru.',
                'data' => null,
            ]);
        }

        return response()->json([
            'exists' => true,
            'message' => 'Barang sudah ada. Input ini akan menambahkan stok barang, bukan membuat barang baru.',
            'data' => [
                'id_barang' => $barang->id_barang,
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'seri' => $barang->seri,
                'stok_awal' => $barang->stok_awal,
                'harga_satuan' => $barang->harga_satuan,
                'tanggal_input' => $barang->tanggal_input,
                'STATUS_BARANG' => $barang->STATUS_BARANG,
            ],
        ]);
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {

            $barang = Barang::findOrFail($id);

            /*
        |--------------------------------------------------------------------------
        | VALIDASI STOK HARUS 0
        |--------------------------------------------------------------------------
        */

            /*
        |--------------------------------------------------------------------------
        | CEK TOTAL TRANSAKSI
        |--------------------------------------------------------------------------
        */

            $totalTransaksi = Transaksi::where('id_barang', $barang->id_barang)
                ->count();

            /*
        |--------------------------------------------------------------------------
        | JIKA TIDAK ADA TRANSAKSI
        | HARD DELETE
        |--------------------------------------------------------------------------
        */

            if ($totalTransaksi == 0) {

                $barang->delete();

                DB::commit();

                return response()->json([
                    'message' => 'Barang berhasil dihapus permanen',
                ]);
            }

            if (($barang->stok_awal ?? 0) > 0) {
                DB::rollBack();

                return response()->json([
                    'message' => 'Barang tidak dapat dihapus karena stok masih ada',
                ], 400);
            }

            /*
        |--------------------------------------------------------------------------
        | AMBIL TRANSAKSI MASUK PERTAMA
        |--------------------------------------------------------------------------
        */

            $transaksiMasukAwal = Transaksi::where('id_barang', $barang->id_barang)
                ->where('tipe_transaksi', 'masuk')
                ->orderBy('id_transaksi', 'asc')
                ->first();

            /*
        |--------------------------------------------------------------------------
        | CEK ADA TRANSAKSI LAIN SETELAH TRANSAKSI AWAL
        |--------------------------------------------------------------------------
        */

            $adaTransaksiLain = false;

            if ($transaksiMasukAwal) {

                $adaTransaksiLain = Transaksi::where('id_barang', $barang->id_barang)
                    ->where('id_transaksi', '>', $transaksiMasukAwal->id_transaksi)
                    ->exists();
            }

            /*
        |--------------------------------------------------------------------------
        | JIKA HANYA ADA TRANSAKSI AWAL
        | HAPUS TRANSAKSI + HARD DELETE BARANG
        |--------------------------------------------------------------------------
        */

            if (! $adaTransaksiLain && $transaksiMasukAwal) {

                $transaksiMasukAwal->delete();

                $barang->delete();

                DB::commit();

                return response()->json([
                    'message' => 'Barang dan transaksi awal berhasil dihapus permanen',
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | MASIH ADA HISTORI
        | SOFT DELETE
        |--------------------------------------------------------------------------
        */

            $barang->update([
                'STATUS_BARANG' => '2',
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Barang berhasil dinonaktifkan',
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Gagal menghapus barang',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
