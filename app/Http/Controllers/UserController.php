<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('id', '=', auth()->id())->first();
        return response()->json([
            'user' => $user,
        ]);
    }
    public function view()
    {
        return view('profile');
    }
    public function update(Request $request, $id)
    {
        $user = User::find(auth()->id());
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request->phone,
            'pronvince' => $request['pronvince'],
            'direction' => $request['direction'],
        ]);

        return response()->json("success", 200);
    }
    public function updatepassword(Request $request)
    {
        $user = User::find(auth()->id());
        $user->update([
            'password' => Hash::make($request['password']),
        ]);
        return response()->json("success", 200);
    }
}
