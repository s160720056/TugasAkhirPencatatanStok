<?php

namespace App\Http\Controllers;

use App\Models\UserHasToko;
use App\Models\User;
use App\Models\HakAkses;
use App\Mail\SendEmailActivation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Helper: Mendapatkan user yang sedang login
     */
    private function getCurrentUser()
    {
        $username = session()->get('username');
        return User::where('username', $username)->first();
    }

    /**
     * Helper: Cek apakah user adalah owner
     */
    private function isOwner(): bool
    {
        $user = $this->getCurrentUser();
        return $user && $user->ownership == 1;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }
        $id_toko = session()->get('id_toko');
        $hakAkses = HakAkses::where('id_toko', $id_toko)->get();
        return view('page.user.index', compact('hakAkses'));
    }

    /**
     * Get DataTable for User
     */
    public function getDataTable(Request $request)
    {
        $currentUser = $this->getCurrentUser();
        $id_toko = session()->get('id_toko');

        if (!$id_toko || !$currentUser) {
            return Datatables::of(collect([]))->make(true);
        }

        $users = User::where('user_has_toko.id_toko', $id_toko)
            ->join('user_has_toko', 'user.id_user', '=', 'user_has_toko.id_user')
            ->join('toko', 'user_has_toko.id_toko', '=', 'toko.id_toko')
            ->select('user.*', 'toko.nama_toko');

        // Non-owner hanya boleh melihat dirinya sendiri
        if (!$this->isOwner()) {
            $users->where('user.id_user', $currentUser->id_user);
        }

        return Datatables::of($users)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        if (!$this->isOwner()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hanya owner yang dapat menambahkan user baru'
            ], 403);
        }

        $id_toko = session()->get('id_toko');

        $request->validate([
            'nama_user'  => 'required|string|max:255',
            'username'   => 'required|string|max:255|unique:user,username',
            'password'   => 'required|string|min:6',
            'alamat_user'=> 'required|string|max:255',
            'telepon'    => 'required|string|max:20',
            'email'      => 'required|email|max:255|unique:user,email',
            'hak_akses'  => 'required|exists:hak_akses,id_hak_akses',
        ]);

        // Rate limiting (anti-spam)
        $throttleKey = 'create-user.' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) { // max 5 user baru per 15 menit
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak permintaan. Tunggu {$seconds} detik.",
            ]);
        }

        $pin = random_int(100000, 999999);

        $user = User::create([
            'nama_user'             => $request->nama_user,
            'username'              => $request->username,
            'password'              => bcrypt($request->password),
            'alamat_user'           => $request->alamat_user,
            'telepon'               => $request->telepon,
            'email'                 => $request->email,
            'gambar'                => 'default.jpg',
            'id_hak_akses'          => $request->hak_akses,
            'STATUS_USER'           => '0',
            'activationPin'         => Hash::make($pin),
            'activationPin_expires' => now()->addMinutes(60),
            'superadmin'            => '0',
            'ownership'             => 0,
        ]);

        UserHasToko::create([
            'id_user' => $user->id_user,
            'id_toko' => $id_toko
        ]);

        Mail::to($request->email)->send(new SendEmailActivation($request->email, $pin, '0'));

        RateLimiter::hit($throttleKey, 900); // 15 menit

        Log::info('New user created', [
            'username' => $user->username,
            'email'    => $user->email,
            'by'       => session('username'),
            'ip'       => $request->ip()
        ]);

        return response()->json(['status' => 'success', 'message' => 'User telah ditambahkan. PIN aktivasi telah dikirim ke email.']);
    }

    /**
     * Get User Detail for Edit
     */
    public function getUserDetail(string $id)
    {
        $currentUser = $this->getCurrentUser();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan'], 404);
        }

        if (!$this->isOwner() && $user->id_user != $currentUser?->id_user) {
            return response()->json(['status' => 'error', 'message' => 'Anda tidak memiliki izin'], 403);
        }

        $id_toko = session()->get('id_toko');
        $hakAkses = HakAkses::where('id_toko', $id_toko)->get();

        return response()->json([
            'status'    => 'success',
            'data'      => $user,
            'hak_akses' => $hakAkses
        ]);
    }

    /**
     * Update user
     */
    public function update(Request $request, string $id)
    {
        $currentUser = $this->getCurrentUser();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan'], 404);
        }

        if (!$this->isOwner() && $user->id_user != $currentUser?->id_user) {
            return response()->json(['status' => 'error', 'message' => 'Anda hanya dapat mengedit data diri sendiri'], 403);
        }

        $request->validate([
            'nama_user'  => 'required|string|max:255',
            'username'   => 'required|string|max:255|unique:user,username,' . $id . ',id_user',
            'alamat_user'=> 'required|string|max:255',
            'telepon'    => 'required|string|max:20',
            'email'      => 'required|email|max:255',
            'hak_akses'  => 'required|exists:hak_akses,id_hak_akses',
        ]);

        // Rate limiting untuk perubahan email (anti-spam)
        if ($user->email !== $request->email) {
            $throttleKey = 'update-email.' . $request->ip();
            if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
                $seconds = RateLimiter::availableIn($throttleKey);
                throw ValidationException::withMessages(['email' => "Terlalu banyak permintaan. Tunggu {$seconds} detik."]);
            }
        }

        $user->nama_user   = $request->nama_user;
        $user->username    = $request->username;
        $user->alamat_user = $request->alamat_user;
        $user->telepon     = $request->telepon;
        $user->id_hak_akses = $request->hak_akses;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Jika email berubah → kirim PIN aktivasi baru
        if ($user->email !== $request->email) {
            $pin = random_int(100000, 999999);

            $user->email                 = $request->email;
            $user->activationPin         = Hash::make($pin);
            $user->activationPin_expires = Carbon::now()->addMinutes(60);
            $user->STATUS_USER           = '0';   // harus aktifkan ulang

            Mail::to($request->email)->send(new SendEmailActivation($request->email, $pin, '0'));

            RateLimiter::hit('update-email.' . $request->ip(), 900);

            Log::info('User email changed - new activation PIN sent', [
                'user_id' => $user->id_user,
                'new_email' => $request->email,
                'by' => session('username')
            ]);
        }

        $user->save();

        return response()->json(['status' => 'success', 'message' => 'User telah diupdate']);
    }

    /**
     * Soft delete user
     */
    public function destroy(string $id)
    {
        $currentUser = $this->getCurrentUser();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan'], 404);
        }

        if (!$this->isOwner()) {
            return response()->json(['status' => 'error', 'message' => 'Hanya owner yang dapat menghapus user'], 403);
        }

        if ($currentUser->id_user == $user->id_user) {
            return response()->json(['status' => 'error', 'message' => 'Anda tidak dapat menghapus akun sendiri'], 403);
        }

        if ($user->ownership == 1) {
            return response()->json(['status' => 'error', 'message' => 'Tidak dapat menghapus user dengan ownership 1'], 403);
        }

        $user->STATUS_USER = '2'; // soft delete
        $user->save();

        Log::info('User soft deleted', ['user_id' => $id, 'by' => session('username')]);

        return response()->json(['status' => 'success', 'message' => 'User telah dihapus']);
    }

    /**
     * Permanent delete user
     */

}