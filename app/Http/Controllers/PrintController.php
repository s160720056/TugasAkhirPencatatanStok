<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\GajiPegawaiDetail;
use App\Models\HistoryJual;
use App\Models\Nota;
use App\Models\NotaSales;
use App\Models\Pengaturan;
use App\Models\Timbangan;
use App\Models\User;
use Illuminate\Http\Request;
// db
use Illuminate\Support\Facades\DB;

class PrintController extends Controller
{


    // printTimbangan
    public function printTimbangan(Request $request)
    {
        // dd($request->all());
        $id_timbangan=$request->id_timbangan;
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }
        $id_toko = session()->get('id_toko');
        $timbangan = Timbangan::where('id_timbangan', $id_timbangan)
            ->join('relasi', 'timbangan.kode_supplier', '=', 'relasi.id_relasi')
            ->select('timbangan.*',  'relasi.nama_relasi')
            ->first();
            // dd($timbangan);
        if (! $timbangan) {
            return redirect()->back()->with('error', 'Data timbangan tidak ditemukan');
        }
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();
        $username = session()->get('username');
        $user = User::where('user.username', $username)->join('user_has_toko', 'user.id_user', '=', 'user_has_toko.id_user')->join('toko', 'user_has_toko.id_toko', '=', 'toko.id_toko')->where('toko.id_toko', $id_toko)->first();
        $namaUser = $user->nama_user;
        if ($pengaturan->format_struk == 1) {
            return view('page.print.strukTimbangan1', compact('timbangan', 'namaUser', 'pengaturan'));
        }
        // if ($pengaturan->format_struk == 2) {
        //     return view('page.print.strukTimbangan2', compact('timbangan', 'namaUser', 'pengaturan'));
        // }
        // if ($pengaturan->format_struk == 3) {
        //     return view('page.print.strukTimbangan3', compact('timbangan', 'namaUser', 'pengaturan'));
        // }
        // if ($pengaturan->format_struk == 4) {
        //     return view('page.print.strukTimbanganEpson', compact('timbangan', 'namaUser', 'pengaturan'));
        // }

        return view('page.print.strukTimbangan1', compact('timbangan', 'namaUser', 'pengaturan'));
    }



    public function index()
    {
        //
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
