<?php

namespace App\Http\Controllers;

use App\Roles;
use App\User;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request){
        $admin = User::where('role_id','=',1)->get();
        $agents = User::where('role_id','=',3)->get();
        $users = User::where('role_id','=',2)->get();
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
            'province' => $request['province'],
            'direction' => $request['direction'],
            'password' => Hash::make( $data['confirmation_code']),
            'role_id'=>$request['role_id'],
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
            'province' => $request['province'],
            'direction' => $request['direction'],
            'password' => Hash::make( $data['confirmation_code']),
            'role_id'=>$request['role_id'],
        ]);

        return $user;
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
        //         return view('currency',['rol'=>$user->role_id]);

        //     }
        //     else{
        //         return view('welcome');
        //     }
        // }
        // else{
        //     return view('welcome');
        // }
        if($user=User::find(auth()->id())){
            return view('users',['rol'=>$user->role_id]);
        }
        else{
            return view('welcome');
        }
    }
    public function profile(){
        $user = User::find(auth()->id());
        if($user->role_id == 2){
            $contact = Contact::find($user->contact_id);
            $user->phone_1 =  $contact->phone_1;
            $user->phone_2 = $contact->phone_2;
        }
        // dd($user->password);
        return view('profile', compact('user'));
    }

}
