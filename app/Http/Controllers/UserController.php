<?php

namespace App\Http\Controllers;

use App\Roles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function index(Request $request){
        $admin = User::where('rol_id','=',1)->get();
        $agents = User::where('rol_id','=',3)->get();
        $users = User::where('rol_id','=',2)->get();
        $roles=Roles::get();
        return response()->json([
            'admins' => $admin,
            'agents' => $agents,
            'users' => $users,
            'roles'=>$roles
    ]);
    }
    public function store(Request $request)
    {
        $data['confirmation_code'] = rand(100000,999999);
        $data['name']=$request['name'];
        // Mail::send('emails.password', $data, function($message) use ($request) {
        //     $message->to($request['email'])->subject('Contraseña');
        // });
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request->phone,
            'pronvince' => $request['pronvince'],
            'direction' => $request['direction'],
            'password' => Hash::make( $data['confirmation_code']),
            'rol_id'=>$request['rol_id'],
        ]);

    }
    public function update(Request $request, $id)
    {
        $data['confirmation_code'] = rand(100000,999999);
        $data['name']=$request['name'];
        // Mail::send('emails.password', $data, function($message) use ($request) {
        //     $message->to($request['email'])->subject('Contraseña');
        // });
        $user = User::find($id);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request->phone,
            'pronvince' => $request['pronvince'],
            'direction' => $request['direction'],
            'password' => Hash::make( $data['confirmation_code']),
            'rol_id'=>$request['rol_id'],
        ]);

        return response()->json("success", 200);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json("success", 200);
    }
    public function view()
    {

        // if(User::find(auth()->id())){
        //     $user=User::find(auth()->id());
        //     if($user==1){
        //         return view('currency',['rol'=>$user->rol_id]);

        //     }
        //     else{
        //         return view('welcome');
        //     }
        // }
        // else{
        //     return view('welcome');
        // }
        if($user=User::find(auth()->id())){
            return view('users',['rol'=>$user->rol_id]);
        }
        else{
            return view('welcome');
        }
    }
}
