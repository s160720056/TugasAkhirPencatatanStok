<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pengaturan;
use App\Models\HakAkses;
use App\Models\HakAksesMenu;
use App\Models\Menu;
use App\Models\UserHasToko;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailActivation;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'username'=> ['required', 'string', 'max:255', 'unique:user'],
            'alamat'=> ['required', 'string', 'max:255'],
            'no_hp'=> ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (strpos($data['username'], 'admin_') !== 0) {
            $rules = array_merge($rules, [
                'nama_toko' => ['required', 'string', 'max:255'],
                'nama_pemilik' => ['required', 'string', 'max:255'],
                'alamat_toko' => ['required', 'string', 'max:255'],
                'logo_toko' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'email_toko' => ['required', 'string', 'email', 'max:255'],
                'ppn' => ['required', 'numeric'],
                'tlp' => ['required', 'string', 'max:255'],
            ]);
        }
        // dd($rules, $data);

        return Validator::make($data, $rules);
    }

    public function create(array $data)
    {


        $pin = rand(100000, 999999);
// dd("halo");
        if (strpos($data['username'], 'admin_') !== 0) {

            // Check if required data is present
            // if (is_null($data['nama_toko']) || is_null($data['alamat_toko']) || is_null($data['email_toko']) || is_null($data['tlp']) || is_null($data['nama']) || is_null($data['ppn']) || empty($data['nama_toko']) || empty($data['alamat_toko']) || empty($data['email_toko']) || empty($data['tlp']) || empty($data['nama']) || empty($data['ppn'])) { return redirect()->back()->withErrors(['error' => 'All required fields must be filled.'])->withInput(); }
            // Insert into toko (Pengaturan)
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
                'logo_toko' =>  '',
                'min_purchase_poin' => $data['min_purchase_poin'] ?? 0,
                'poin_interval' => $data['poin_interval'] ?? 0,
                'poin_to_rupiah' => $data['poin_to_rupiah'] ?? 0,
            ]);


            // Handle logo upload
            if (request()->hasFile('logo_toko')) {
                $file = request()->file('logo_toko');
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension(); // Use unique file name
                $filePath = 'toko/' . $toko->id_toko;

                $file->storeAs($filePath, $fileName, 'public');

                $toko->update(['logo_toko' => $filePath . '/' . $fileName]);
            }

            // Insert into hak akses user
            $hakAksesUser = HakAkses::create([
                'id_toko' => $toko->id_toko,
                'nama_hak_akses' => 'Manager',
            ]);

            $id_toko = $toko->id_toko;
            $id_hak_akses = $hakAksesUser->id_hak_akses;
            $superadmin = '0';
            $email=$data['email'];
            $user = User::create([
                'nama_user' => $data['nama'],
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'alamat_user' => $data['alamat'],
                'telepon' => $data['no_hp'],
                'gambar' => 'default.jpg',
                'id_hak_akses' => $id_hak_akses,
                'STATUS_USER' => '0', // Assuming default value
                'activationPin' => $pin,
                'superadmin' => $superadmin,
            ]);





            // Create user with id_toko from the created toko
            Mail::to($email)->send(new SendEmailActivation($email, $pin,$superadmin));
            UserHasToko::create([
                'id_user' => $user->id_user,
                'id_toko' => $id_toko,
            ]);


        } else {
            //get id hak akses superadmin where id_toko = 0
            $hakAksesUser = HakAkses::where('id_toko', 0)->first();
            if (!$hakAksesUser) {
                $hakAksesUser = HakAkses::create([
                    'id_toko' => 0,
                    'nama_hak_akses' => 'Superadmin',
                ]);
            }
            $id_hak_akses = $hakAksesUser->id_hak_akses;
            $id_toko = 0;
            $superadmin = '1';
            $email= env('ADMIN_EMAIL_LOCAL');
            $user = User::create([
                'nama_user' => $data['nama'],
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'alamat_user' => $data['alamat'],
                'telepon' => $data['no_hp'],
                'gambar' => 'default.jpg',
                'id_hak_akses' => $id_hak_akses,
                'STATUS_USER' => '0', // Assuming default value
                'activationPin' => $pin,
                'superadmin' => $superadmin,
                'ownership' => 1,
            ]);
            // dd('tes');
            Mail::to($email)->send(new SendEmailActivation($data['email'], $pin,$superadmin));
        }
        if (strpos($data['username'], 'admin_') !== 0) {
            $id_user = $user->id_user;

            // Retrieve all menu IDs
            $menuIds = Menu::pluck('id_menu');

            foreach ($menuIds as $menuId) {
                HakAksesMenu::create([
                    'id_hak_akses' => $id_hak_akses,
                    'id_toko' => $id_toko,
                    'id_menu' => $menuId,
                ]);
            }


            $this->createDatabaseFortoko($toko);
        }
        // dd("done");

        return $user;
    }


public function register(Request $request)
{
    $validator = $this->validator($request->all());

    // Custom validation rules
    $validator->after(function ($validator) use ($request) {
        if (User::where('username', $request->username)->exists()) {
            $validator->errors()->add('username', 'Username sudah terdaftar');
        }

        if (User::where('email', $request->email)->exists()) {
            $validator->errors()->add('email', 'Email sudah terdaftar');
        }

        // if (User::where('NIK', $request->nik)->exists()) {
        //     $validator->errors()->add('nik', 'NIK sudah terdaftar');
        // }
    });

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    else{
        $this->create($request->all());
    }


    // dd('success');
    return redirect()->route('login', [
    'success' => 'Email Telah dikirim, Silahkan Memasukkan Pin Aktivasi'
]);

}
protected function createDatabaseFortoko($toko)
{
    // dd('tes');
    $databaseName = env('DYNAMIC_DB') . $toko->id_toko;

    // Construct the SQL to create the new database
    $sql = "CREATE DATABASE IF NOT EXISTS `$databaseName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

    // Execute the raw SQL query in the default connection
    DB::statement($sql);

    // Now switch to the newly created database and import the SQL file
    $path = base_path() . '/database/migrations/tokoUser.sql';
    $sql = file_get_contents($path);
    $sql = str_replace('tokoUser', $databaseName, $sql);

    // Use a connection to the newly created database
    DB::connection('mysql')->getPdo()->exec("USE $databaseName");

    // Execute the SQL import (this will now run in the new database)
    DB::unprepared($sql);

    return true;
}


    public function showRegistrationForm()
    {
        return view('auth.login');
    }
}
