<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class SessionController extends Controller
{

    public function lock(Request $request)
    {

        session(['locked' => true]);

        return response()->json(['message' => 'Session locked successfully']);
    }
    public function checkPassword(Request $request)
    {
        // dd($request->password);


        $user = User::find(auth()->user()->id);
        if (Hash::check($request->password, $user->password)) {
            // return response()->json(['message' => 'Password is correct']);
        }
        // dd($request->password);
        // return response()->json(['message' => 'Password is incorrect'], 422);
    }
    public function checkSession(Request $request)
    {
        if (session('locked')) {
            return response()->json(['locked' => '1']);
        }
        return response()->json(['locked' => '0']);
    }
    public function verifyPassword(Request $request)
    {


        $password = $request->password;
        $user = User::find(auth()->user()->id);
        dd($user);
        if (Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Password is correct']);
        }
        return response()->json(['message' => 'Password is incorrect'], 422);
    }
}
