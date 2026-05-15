<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Exports\ExportBarang;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;



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
                $request->tanggal_akhir
            ]);
        }
        // Jika hanya tanggal_awal (fallback)
        elseif ($request->filled('tanggal_awal')) {
            $barang->whereDate('tanggal_input', '>=', $request->tanggal_awal);
        }

        return DataTables::of($barang)
            ->addIndexColumn()
            ->editColumn('stok_awal', fn($row) => $row->stok_awal ?? 0)
            ->editColumn('harga_satuan', fn($row) => $row->harga_satuan ?? 0)
            ->editColumn('tanggal_input', fn($row) => $row->tanggal_input
                ? \Carbon\Carbon::parse($row->tanggal_input)->format('d/m/Y')
                : '-')
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
                'kode_barang'    => 'required|unique:barang,kode_barang,NULL,id_barang|max:255',
                'nama_barang'    => 'required|string|max:255',
                'seri'           => 'nullable|string',
                'stok_awal'      => 'nullable|integer|min:0',
                'harga_satuan'   => 'nullable|integer|min:0',

            ]);

            $barang = Barang::create([
                'kode_barang'    => $request->kode_barang,
                'nama_barang'    => $request->nama_barang,
                'seri'           => $request->seri,
                'stok_awal'      => $request->stok_awal ?? 0,
                'tanggal_input'  => now()->toDateString(),
                'STATUS_BARANG'  => $request->STATUS_BARANG ?? '1',
                'harga_satuan'   => $request->harga_satuan ?? 0,

            ]);

            /*
        |--------------------------------------------------------------------------
        | AUTO INSERT TRANSAKSI MASUK
        |--------------------------------------------------------------------------
        */

            $transaksi = Transaksi::create([
                'id_barang'             => $barang->id_barang,
                'tipe_transaksi'        => 'masuk',
                'jumlah_barang'         => $barang->stok_awal ?? 0,
                'harga_satuan'          => $barang->harga_satuan ?? 0,
                'jumlah_satuan'         => $barang->harga_satuan * $barang->stok_awal ?? 0,
                'keterangan_transaksi'  => null,
                'diberikan_oleh'        => null,
                'keperluan_transaksi'   => null,
                'tanggal_transaksi'     => now(),
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Barang berhasil ditambahkan',
                'data'    => $barang,
                'transaksi' => $transaksi
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Gagal menyimpan barang',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function getBarangDetail($id)
    {
        $barang = Barang::find($id);
        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }
        return response()->json($barang);
    }

    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $barang = Barang::where('id_barang', $id)->first();
            if (!$barang) {
                return response()->json([
                    'message' => 'Barang tidak ditemukan'
                ], 404);
            }
            $request->validate([
                'kode_barang'   => 'required|unique:barang,kode_barang,' . $id . ',id_barang',
                'nama_barang'   => 'required|string|max:255',
                'seri'          => 'nullable|string',
                // 'stok_awal'     => 'nullable|integer|min:0',
                'harga_satuan'  => 'nullable|integer|min:0',
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
                'kode_barang'    => $request->kode_barang,
                'nama_barang'    => $request->nama_barang,
                'seri'           => $request->seri,
                // 'stok_awal'      => $request->stok_awal ?? $barang->stok_awal,
                // 'tanggal_input'  => now()->toDateString(),
                // 'STATUS_BARANG'  => $request->STATUS_BARANG ?? $barang->STATUS_BARANG,
                'harga_satuan'   => $request->harga_satuan ?? $barang->harga_satuan,
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
                    (int)$transaksiAwal->jumlah_barang === (int)$stokLama &&
                    (int)$transaksiAwal->harga_satuan === (int)$hargaLama &&
                    (int)$transaksiAwal->jumlah_satuan === (int)$hargaLama * $stokLama
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
                'message' => 'Barang berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal memperbarui barang',
                'error'   => $e->getMessage()
            ], 500);
        }
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
                    'message' => 'Barang berhasil dihapus permanen'
                ]);
            }

            if (($barang->stok_awal ?? 0) > 0) {

                return response()->json([
                    'message' => 'Barang tidak dapat dihapus karena stok masih ada'
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

            if (!$adaTransaksiLain && $transaksiMasukAwal) {

                $transaksiMasukAwal->delete();

                $barang->delete();

                DB::commit();

                return response()->json([
                    'message' => 'Barang dan transaksi awal berhasil dihapus permanen'
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | MASIH ADA HISTORI
        | SOFT DELETE
        |--------------------------------------------------------------------------
        */

            $barang->update([
                'STATUS_BARANG' => '2'
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Barang berhasil dinonaktifkan'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Gagal menghapus barang',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
