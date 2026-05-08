<?php

namespace App\Http\Controllers;

use App\Models\HakAkses;
// models
use App\Models\Pengaturan;
use App\Models\User;
use App\Models\UserHasToko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }
        $id_toko = session()->get('id_toko');
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();

        return view('page.pengaturan.index', compact('pengaturan'));
    }

    public function connect($id_toko)
    {
        session()->put('id_toko', $id_toko);
        $this->connectToTokoDatabase($id_toko);

        return redirect()->route('home.index');
    }

    /**
     * Connect to the dynamic database based on the provided toko ID.
     *
     * @param  int  $id_toko
     *
     * @throws \Exception
     */
    private function connectToTokoDatabase($id_toko)
    {
        $toko = DB::table('toko')->where('id_toko', $id_toko)->first();
    $username = env('DB_USERNAME');
    $password = env('DB_PASSWORD');
        if (! $toko) {
            throw new \Exception("Toko not found for id_toko: $id_toko");
        }
        config([
            'database.connections.dynamic' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                'database' => env('DYNAMIC_DB').$id_toko, // Dynamic database name
                'username' => $username,
                'password' => $password,
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'strict' => true,
                'engine' => null,
            ],
        ]);
        DB::purge('dynamic');
        DB::setDefaultConnection('dynamic');
        try {
            DB::connection('dynamic')->getPdo();
        } catch (\Exception $e) {
            throw new \Exception("Failed to connect to the database for toko: $id_toko. ".$e->getMessage());
        }
    }

    // disconnect
    public function disconnect()
    {
        session()->forget('id_toko');
        session()->forget('nama_toko');
        $this->resetDatabaseConnection();

        return redirect()->route('home.index');
    }

    private function resetDatabaseConnection()
    {
        DB::purge('dynamic');
        DB::setDefaultConnection(config('database.default'));
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
        $id_toko = session()->get('id_toko');

        $fields = [
            'nama_toko',
            'alamat_toko',
            'email_toko',
            'tlp',
            'nama_pemilik',
            'ppn',
            'jam_buka',
            'jam_tutup',
            'toleransi_terlambat',
            'lebar_kertas_struk',
            'denda_keterlambatan',
            'logo_toko',
            'min_purchase_poin',
            'poin_interval',
            'poin_to_rupiah',
            'format_struk',
            'gunakan_logo_struk',
            'footer_struk',
            'baudRate',
            'dataBits',
            'parity',
            'stopBits',
            'flowControl',
            'port',
            'format_timbangan',
            'urutan_timbang',

        ];

        $validatedData = $request->only($fields);

        // Sanitize numeric fields
        if (isset($validatedData['denda_keterlambatan'])) {
            $validatedData['denda_keterlambatan'] = preg_replace('/[^0-9]/', '', $validatedData['denda_keterlambatan']);
        }
        if (isset($validatedData['min_purchase_poin'])) {
            $validatedData['min_purchase_poin'] = preg_replace('/[^0-9]/', '', $validatedData['min_purchase_poin']);
        }
        if (isset($validatedData['poin_interval'])) {
            $validatedData['poin_interval'] = preg_replace('/[^0-9]/', '', $validatedData['poin_interval']);
        }
        if (isset($validatedData['poin_to_rupiah'])) {
            $validatedData['poin_to_rupiah'] = preg_replace('/[^0-9]/', '', $validatedData['poin_to_rupiah']);
        }

        // Check if there's an existing pengaturan
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();

        // Handle file upload if a logo is provided
        if ($request->hasFile('logo_toko')) {

            // hapus logo lama secara aman
            if ($pengaturan && $pengaturan->logo_toko) {
                Storage::disk('public')->delete($pengaturan->logo_toko);
            }

            $filePath = "toko/{$id_toko}";
            $fileName = uniqid('logo_').'.'.$request->file('logo_toko')->extension();

            // Save directly to public/toko/{$id_toko}/ with public visibility
            $validatedData['logo_toko'] = $request
                ->file('logo_toko')
                ->storeAs($filePath, $fileName, 'public');
        } elseif ($pengaturan) {
            $validatedData['logo_toko'] = $pengaturan->logo_toko;
        }

        $validatedData['id_toko'] = $id_toko;

        // Check if the store settings already exist
        if ($pengaturan) {
            $pengaturan->update($validatedData);
        } else {
            Pengaturan::create($validatedData);
        }

        // Redirect to the nota preview if printing
        if ($request->has('print_nota')) {

            $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();
            $format_struk = $pengaturan->format_struk;
            if ($format_struk == 1) {
                return view('page.struk.preview.Struk1', compact('pengaturan'))
                    ->with('success', 'Toko updated successfully. Previewing Nota.');
            }
            if ($format_struk == 2) {
                return view('page.struk.preview.Struk2', compact('pengaturan'))
                    ->with('success', 'Toko updated successfully. Previewing Nota.');
            }
            if ($format_struk == 3) {
                return view('page.struk.preview.Struk3', compact('pengaturan'))
                    ->with('success', 'Toko updated successfully. Previewing Nota.');
            }
            if ($format_struk == 4) {
                return view('page.struk.preview.StrukEpson1', compact('pengaturan'))
                    ->with('success', 'Toko updated successfully. Previewing Nota.');
            }

            return view('page.struk.preview.1Ori', compact('pengaturan'))
                ->with('success', 'Toko updated successfully. Previewing Nota.');
        }

        return back()->with('success', 'Toko updated successfully');
    }

    // simpanTokoBaru
    public function simpanTokoBaru(Request $request)
    {
        $data = $request->all();
        $toko = Pengaturan::create([
            'nama_toko' => $data['nama_toko'] ?? '',
            'alamat_toko' => $data['alamat_toko'] ?? '',
            'email_toko' => $data['email_toko'] ?? '',
            'tlp' => $data['tlp'] ?? '',
            'nama_pemilik' => $data['nama_pemilik'] ?? '',
            'ppn' => $data['ppn'] ?? 0,
            'jam_buka' => $data['jam_buka'] ?? '00:00:00',
            'jam_tutup' => $data['jam_tutup'] ?? '00:00:00',
            'toleransi_terlambat' => $data['toleransi_terlambat'] ?? 0,
            'denda_keterlambatan' => $data['denda_keterlambatan'] ?? 0,
            'lebar_kertas_struk' => $data['lebar_kertas_struk'] ?? 0,
            'format_struk' => $data['format_struk'] ?? 1,
            'logo_toko' => '',
        ]);

        // Handle logo upload
        if (request()->hasFile('logo_toko')) {
            $file = request()->file('logo_toko');
            $fileName = uniqid().'.'.$file->getClientOriginalExtension(); // Use unique file name
            $filePath = 'toko/'.$toko->id_toko;

            $file->storeAs($filePath, $fileName, 'public');

            $toko->update(['logo_toko' => $filePath.'/'.$fileName]);
        }

        // Insert into hak akses user
        $hakAksesUser = HakAkses::create([
            'id_toko' => $toko->id_toko,
            'nama_hak_akses' => 'Manager',
        ]);

        $id_toko = $toko->id_toko;
        $id_hak_akses = $hakAksesUser->id_hak_akses;

        $username = session()->get('username');
        $user = User::where('user.username', $username)->first();

        UserHasToko::create([
            'id_user' => $user->id_user,
            'id_toko' => $id_toko,
        ]);

        // Create the database for the new toko
        $this->createDatabaseFortoko($toko);

        return back()->with('success', 'Toko telah dibuat');
    }

    protected function createDatabaseFortoko($toko)
    {
        $databaseName = env('DYNAMIC_DB').$toko->id_toko;

        // Construct the SQL to create the new database
        $sql = "CREATE DATABASE IF NOT EXISTS `$databaseName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

        // Execute the raw SQL query in the default connection
        DB::statement($sql);

        // Now switch to the newly created database and import the SQL file
        $path = base_path().'/database/migrations/tokoUser.sql';
        $sql = file_get_contents($path);
        $sql = str_replace('tokoUser', $databaseName, $sql);

        // Use a connection to the newly created database
        DB::connection('mysql')->getPdo()->exec("USE $databaseName");

        // Execute the SQL import (this will now run in the new database)
        DB::unprepared($sql);

        return true;
    }

    // verifikasiUlang
    public function verifikasiUlang(Request $request)
    {
        $id_toko = session()->get('id_toko');
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();
        // update status_pengajuan_toko to proses
        $pengaturan->status_pengajuan_toko = 'proses';
        $pengaturan->save();

        return back()->with('success', 'Verifikasi Ulang Berhasil');
    }

    public function getInfoToko()
    {
        $id_toko = session()->get('id_toko');
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();
        // if (response.data.status == "error") {
        //     // Show SweetAlert2 notification
        //     Swal.fire({
        //         title: "Error!",
        //         text: "Toko Belum Diatur",
        //         icon: "error",
        //         confirmButtonColor: '#3085d6',
        //         confirmButtonText: 'OK'
        //     }).then(() => {
        //         // Redirect to dashboard if access is denied
        //         window.location.href = "/";
        //     });

        // return
        return response()->json([
            'status' => 'success',
            'data' => $pengaturan,
        ]);
    }

    // pengaturanToko
    public function pengaturanToko(Request $request)
    {
        $id_toko = session()->get('id_toko');
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();

        return view('page.pengaturan.pengaturanToko', compact('pengaturan'));
    }

    // pengaturanAbsensi
    public function pengaturanAbsensi(Request $request)
    {
        $id_toko = session()->get('id_toko');
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();

        return view('page.pengaturan.pengaturanAbsensi', compact('pengaturan'));
    }

    // pengaturanStruk
    public function pengaturanStruk(Request $request)
    {
        $id_toko = session()->get('id_toko');
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();

        return view('page.pengaturan.pengaturanStruk', compact('pengaturan'));
    }

    public function pengaturanPoinMember(Request $request)
    {
        $id_toko = session()->get('id_toko');
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();

        return view('page.pengaturan.pengaturanPoinMember', compact('pengaturan'));
    }

    public function pengaturanTimbangan(Request $request)
    {
        $id_toko = session()->get('id_toko');
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();

        return view('page.pengaturan.pengaturanTimbangan', compact('pengaturan'));
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
