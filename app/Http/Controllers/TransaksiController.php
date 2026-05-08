<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }

        $barang = Barang::orderBy('nama_barang', 'asc')->get();

        return view('page.transaksi.index', compact('barang'));
    }

    public function getDataTable(Request $request)
    {
        $transaksi = Transaksi::leftJoin('barang', 'transaksi.id_barang', '=', 'barang.id_barang')
            ->select([
                'transaksi.id_transaksi',
                'transaksi.id_barang',
                'transaksi.tanggal_transaksi',
                'transaksi.tipe_transaksi',
                'transaksi.jumlah_barang',
                'transaksi.keterangan_transaksi',
                'transaksi.diberikan_oleh',
                'transaksi.keperluan_transaksi',
                'barang.nama_barang',
            ]);

        return DataTables::of($transaksi)

            ->addIndexColumn()

            ->addColumn('barang', function ($row) {
                return $row->nama_barang ?? '-';
            })

            ->addColumn('pengeluaran', function ($row) {
                if ($row->tipe_transaksi == 'keluar') {
                    return $row->jumlah_barang;
                }

                return '-';
            })

            ->addColumn('pemasukan', function ($row) {
                if ($row->tipe_transaksi == 'masuk') {
                    return $row->jumlah_barang;
                }

                return '-';
            })

            ->addColumn('action', function ($row) {

                return '
                    <button class="btn btn-warning btn-sm"
                        onclick="editTransaksi(' . $row->id_transaksi . ')">
                        Edit
                    </button>

                    <button class="btn btn-danger btn-sm"
                        onclick="deleteTransaksi(' . $row->id_transaksi . ')">
                        Hapus
                    </button>
                ';
            })

            ->rawColumns(['action'])

            ->make(true);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'tanggal_transaksi' => 'required|date',
                'id_barang' => 'required',
                'tipe_transaksi' => 'required|in:masuk,keluar',
                'jumlah_barang' => 'required|numeric|min:1',
                'keterangan_transaksi' => 'nullable',
            ]);

            $barang = Barang::where('id_barang', $request->id_barang)->first();

            if (!$barang) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Barang tidak ditemukan'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | VALIDASI STOK
            |--------------------------------------------------------------------------
            */

            if (
                $request->tipe_transaksi == 'keluar' &&
                $barang->stok_akhir < $request->jumlah_barang
            ) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Stok tidak mencukupi'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | SIMPAN TRANSAKSI
            |--------------------------------------------------------------------------
            */

            $transaksi = Transaksi::create([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'id_barang' => $request->id_barang,
                'tipe_transaksi' => $request->tipe_transaksi,
                'jumlah_barang' => $request->jumlah_barang,
                'keterangan_transaksi' => $request->keterangan_transaksi,
                'diberikan_oleh' => $request->diberikan_oleh,
                'keperluan_transaksi' => $request->keperluan_transaksi,
            ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE STOK
            |--------------------------------------------------------------------------
            */

            if ($request->tipe_transaksi == 'masuk') {

                $barang->stok_akhir += $request->jumlah_barang;
            } else {

                $barang->stok_akhir -= $request->jumlah_barang;
            }

            $barang->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil disimpan'
            ]);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function show(string $id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {

            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return response()->json($transaksi);
    }

    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'tanggal_transaksi' => 'required|date',
                'id_barang' => 'required',
                'tipe_transaksi' => 'required|in:masuk,keluar',
                'jumlah_barang' => 'required|numeric|min:1',
            ]);

            $transaksi = Transaksi::find($id);

            if (!$transaksi) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaksi tidak ditemukan'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | ROLLBACK STOK LAMA
            |--------------------------------------------------------------------------
            */

            $barangLama = Barang::where('id_barang', $transaksi->id_barang)->first();

            if ($transaksi->tipe_transaksi == 'masuk') {

                $barangLama->stok_akhir -= $transaksi->jumlah_barang;
            } else {

                $barangLama->stok_akhir += $transaksi->jumlah_barang;
            }

            $barangLama->save();

            /*
            |--------------------------------------------------------------------------
            | APPLY STOK BARU
            |--------------------------------------------------------------------------
            */

            $barangBaru = Barang::where('id_barang', $request->id_barang)->first();

            if (
                $request->tipe_transaksi == 'keluar' &&
                $barangBaru->stok_akhir < $request->jumlah_barang
            ) {

                DB::rollBack();

                return response()->json([
                    'status' => 'error',
                    'message' => 'Stok tidak mencukupi'
                ]);
            }

            if ($request->tipe_transaksi == 'masuk') {

                $barangBaru->stok_akhir += $request->jumlah_barang;
            } else {

                $barangBaru->stok_akhir -= $request->jumlah_barang;
            }

            $barangBaru->save();

            /*
            |--------------------------------------------------------------------------
            | UPDATE TRANSAKSI
            |--------------------------------------------------------------------------
            */

            $transaksi->update([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'id_barang' => $request->id_barang,
                'tipe_transaksi' => $request->tipe_transaksi,
                'jumlah_barang' => $request->jumlah_barang,
                'keterangan_transaksi' => $request->keterangan_transaksi,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil diupdate'
            ]);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {

            $transaksi = Transaksi::find($id);

            if (!$transaksi) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan'
                ]);
            }

            $barang = Barang::where('id_barang', $transaksi->id_barang)->first();

            /*
            |--------------------------------------------------------------------------
            | ROLLBACK STOK
            |--------------------------------------------------------------------------
            */

            if ($transaksi->tipe_transaksi == 'masuk') {

                $barang->stok_akhir -= $transaksi->jumlah_barang;
            } else {

                $barang->stok_akhir += $transaksi->jumlah_barang;
            }

            $barang->save();

            $transaksi->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}