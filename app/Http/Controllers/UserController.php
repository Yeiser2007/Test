<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        return view('users.index');
    }
    public function getUsers(Request $request)
    {
        if($request->wantsJson()){
            $users = User::all();
            return response()->json([
                'success' => true,
                'data' => $users
            ]);
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
