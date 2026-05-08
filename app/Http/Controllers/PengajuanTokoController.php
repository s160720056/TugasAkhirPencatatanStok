<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;
use App\Models\User;
use App\Models\HakAkses;
use Yajra\DataTables\Facades\DataTables;

class PengajuanTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $daftarPengajuanToko = Pengaturan::all();
        return view('admin.page.pengajuanToko.index', compact('daftarPengajuanToko'));
    }


    public function detailPengajuanToko(string $id)
    {
        $pengajuanToko = Pengaturan::find($id);
        if (!$pengajuanToko) {
            return response()->json(['status' => 'failed', 'message' => 'Pengajuan toko not found']);
        }
        return response()->json(['status' => 'success', 'data' => $pengajuanToko]);
    }
    // axiosGet('detailAnggotaToko/' + id_toko)
    public function detailAnggotaToko(string $id)
    {
        $anggotaToko = User::where('user.id_toko', $id)->join('hak_akses', 'user.id_hak_akses', '=', 'hak_akses.id_hak_akses')->get();
        if (!$anggotaToko) {
            return response()->json(['status' => 'failed', 'message' => 'Anggota toko not found']);
        }
        return response()->json(['status' => 'success', 'data' => $anggotaToko]);
    }
    //submitStatusChange
    public function submitStatusChange(Request $request)
    {
        $id_toko = $request->id_toko;
        $status_pengajuan = $request->status_pengajuan;
        $alasan = $request->alasan ?? null;

        $pengajuanToko = Pengaturan::find($id_toko);
        if (!$pengajuanToko) {
            return response()->json(['status' => 'failed', 'message' => 'Pengajuan toko not found']);
        }
        $pengajuanToko->status_pengajuan_toko = $status_pengajuan;
        $pengajuanToko->alasan_ditolak = $alasan;
        $pengajuanToko->save();
        return response()->json(['status' => 'success', 'message' => 'Status pengajuan toko berhasil diubah']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
