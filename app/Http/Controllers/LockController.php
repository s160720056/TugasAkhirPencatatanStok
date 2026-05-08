<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
class LockController extends Controller
{
    public function unlock(Request $request)
    {
        // Validate the password here
        $password = $request->input('password');

        if (password_verify($password, auth()->user()->password)) {
            return response()->json(['success' => true], 200);
        }

        return response()->json(['success' => false], 401);
    }
}





?>
