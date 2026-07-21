<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Helpers\AuditHelper;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }

        $barang = Barang::where('STATUS_BARANG', '!=', '2')->orderBy('nama_barang', 'asc')->get();



        return view('page.transaksi.index', compact('barang'));
    }

public function getDataTable(Request $request)
    {
        $transaksi = Transaksi::query()
            ->leftJoin('barang', 'transaksi.id_barang', '=', 'barang.id_barang')
            ->select([
                'transaksi.id_transaksi',
                'transaksi.id_barang',
                'transaksi.tanggal_transaksi',
                'transaksi.tipe_transaksi',
                'transaksi.jumlah_barang',
                'transaksi.keterangan_transaksi',
                'transaksi.harga_satuan',
                'transaksi.jumlah_satuan',
                'transaksi.diberikan_oleh',
                'transaksi.keperluan_transaksi',
                'barang.nama_barang',
                'barang.kode_barang',
                'barang.seri',
            ])
            ->orderByDesc('transaksi.id_transaksi');

        // ==================== FILTER RANGE TANGGAL ====================
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $transaksi->whereBetween('transaksi.tanggal_transaksi', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        } elseif ($request->filled('tanggal_awal')) {
            $transaksi->whereDate('transaksi.tanggal_transaksi', '>=', $request->tanggal_awal);
        }

        return DataTables::of($transaksi)

            ->addIndexColumn()

            ->addColumn('barang', function ($row) {
                return $row->nama_barang . ' - ' . $row->kode_barang . ' - ' . ($row->seri ?? '-');
            })

            ->addColumn('keluar', function ($row) {
                return $row->tipe_transaksi == 'keluar'
                    ? $row->jumlah_barang
                    : '-';
            })

            ->addColumn('masuk', function ($row) {
                return $row->tipe_transaksi == 'masuk'
                    ? $row->jumlah_barang
                    : '-';
            })

            /*
        |--------------------------------------------------------------------------
        | CUSTOM SEARCH (DINAMIS / BEBAS URUTAN KATA)
        |--------------------------------------------------------------------------
        */

            ->filterColumn('barang', function ($query, $keyword) {
                $keywords = explode(' ', $keyword);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        if (!empty($word)) {
                            $q->where(function ($sub) use ($word) {
                                $sub->where('barang.nama_barang', 'like', "%{$word}%")
                                    ->orWhere('barang.kode_barang', 'like', "%{$word}%")
                                    ->orWhere('barang.seri', 'like', "%{$word}%");
                            });
                        }
                    }
                });
            })

            ->filterColumn('keterangan_transaksi', function ($query, $keyword) {
                $keywords = explode(' ', $keyword);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        if (!empty($word)) {
                            $q->where('transaksi.keterangan_transaksi', 'like', "%{$word}%");
                        }
                    }
                });
            })

            ->filterColumn('diberikan_oleh', function ($query, $keyword) {
                $keywords = explode(' ', $keyword);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        if (!empty($word)) {
                            $q->where('transaksi.diberikan_oleh', 'like', "%{$word}%");
                        }
                    }
                });
            })

            ->filterColumn('keperluan_transaksi', function ($query, $keyword) {
                $keywords = explode(' ', $keyword);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        if (!empty($word)) {
                            $q->where('transaksi.keperluan_transaksi', 'like', "%{$word}%");
                        }
                    }
                });
            })

            ->filterColumn('tanggal_transaksi', function ($query, $keyword) {
                $query->whereDate('transaksi.tanggal_transaksi', $keyword);
            })

            ->orderColumn('barang', function ($query, $order) {
                $query->orderBy('barang.nama_barang', $order);
            })

            /*
        |--------------------------------------------------------------------------
        | ACTION
        |--------------------------------------------------------------------------
        */
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
                'diberikan_oleh' => 'nullable',
                'keperluan_transaksi' => 'nullable',
                'harga_satuan' => 'nullable',
                'jumlah_satuan' => 'nullable',
            ]);

            //cek apakah harga_satuan * jumlah == jumlah_satuan
            // if ($request->harga_satuan * $request->jumlah_satuan != $request->jumlah_satuan) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Harga satuan * jumlah != jumlah satuan'
            //     ]);
            // }

            $barang = Barang::where('id_barang', $request->id_barang)->first();

            if (!$barang) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Barang tidak ditemukan'
                ]);
            }

            $tanggalTransaksi = Carbon::parse($request->tanggal_transaksi)->startOfDay();
            $tanggalBarangDibuat = Carbon::parse($barang->tanggal_input)->startOfDay();

            if ($tanggalTransaksi == $tanggalBarangDibuat) {
                // allow same-day transaction
            } elseif ($tanggalTransaksi < $tanggalBarangDibuat) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Tanggal transaksi tidak boleh sebelum tanggal barang dibuat (' .
                        $tanggalBarangDibuat->format('d-m-Y') . ')'
                ]);
            }

            if (
                $request->tipe_transaksi == 'keluar' &&
                $barang->stok_awal < $request->jumlah_barang
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
                'harga_satuan' => $request->harga_satuan,
                'jumlah_satuan' => $request->jumlah_satuan,

            ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE STOK
            |--------------------------------------------------------------------------
            */

            if ($request->tipe_transaksi == 'masuk') {

                $barang->stok_awal += $request->jumlah_barang;
            } else {

                $barang->stok_awal -= $request->jumlah_barang;
            }

            $barang->save();

            AuditHelper::log(
                'create',
                'transaksi',
                $transaksi->id_transaksi,
                null,
                $transaksi->fresh()->toArray()
            );

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
                // 'tanggal_transaksi' => 'required|date',
                // 'id_barang' => 'required',
                // 'tipe_transaksi' => 'required|in:masuk,keluar',
                // 'jumlah_barang' => 'required|numeric|min:1',
                'keterangan_transaksi' => 'nullable',
                'diberikan_oleh' => 'nullable',
                'keperluan_transaksi' => 'nullable',
                'harga_satuan' => 'nullable',
                'jumlah_satuan' => 'nullable',
            ]);

            $transaksi = Transaksi::find($id);
            $beforeData = $transaksi->toArray();

            if (!$transaksi) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaksi tidak ditemukan'
                ]);
            }

            // Rollback stok lama
            // $barangLama = Barang::where('id_barang', $transaksi->id_barang)->first();
            // if ($transaksi->tipe_transaksi == 'masuk') {
            //     $barangLama->stok_awal -= $transaksi->jumlah_barang;
            // } else {
            //     $barangLama->stok_awal += $transaksi->jumlah_barang;
            // }
            // $barangLama->save();

            /*
            |--------------------------------------------------------------------------
            | APPLY STOK BARU
            |--------------------------------------------------------------------------
            */

            // $barangBaru = Barang::where('id_barang', $request->id_barang)->first();

            // if (
            //     $request->tipe_transaksi == 'keluar' &&
            //     $barangBaru->stok_awal < $request->jumlah_barang
            // ) {
            //  DB::rollBack();
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Stok tidak mencukupi'
            //     ]);
            // }
            // if ($request->tipe_transaksi == 'masuk') {
            //     $barangBaru->stok_awal += $request->jumlah_barang;
            // } else {
            //     $barangBaru->stok_awal -= $request->jumlah_barang;
            // }
            // $barangBaru->save();

            /*
            |--------------------------------------------------------------------------
            | UPDATE TRANSAKSI
            |--------------------------------------------------------------------------
            */

            $transaksi->update([
                // 'tanggal_transaksi' => $request->tanggal_transaksi,
                // 'id_barang' => $request->id_barang,
                // 'tipe_transaksi' => $request->tipe_transaksi,
                // 'jumlah_barang' => $request->jumlah_barang,
                'keterangan_transaksi' => $request->keterangan_transaksi,
                'diberikan_oleh' => $request->diberikan_oleh,
                'keperluan_transaksi' => $request->keperluan_transaksi,
                // 'harga_satuan' => $request->harga_satuan,
                // 'jumlah_satuan' => $request->jumlah_satuan,
            ]);

            $afterData = $transaksi->fresh()->toArray();
            AuditHelper::log(
                'update',
                'transaksi',
                $transaksi->id_transaksi,
                $beforeData,
                $afterData
            );

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
            $beforeDelete = $transaksi->toArray();

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

                $barang->stok_awal -= $transaksi->jumlah_barang;
            } else {

                $barang->stok_awal += $transaksi->jumlah_barang;
            }

            $barang->save();

            $transaksi->delete();
            AuditHelper::log(
                'delete',
                'transaksi',
                $id,
                $beforeDelete,
                null
            );

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
