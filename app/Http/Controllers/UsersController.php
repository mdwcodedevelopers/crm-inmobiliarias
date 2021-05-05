<?php

namespace App\Http\Controllers;

use App\Roles;
use App\User;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
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
        if ($request->role_id == 2) {
            $contact = Contact::firstOrNew(['email' =>  request('email')]);
            $contact->name = $request->name; 
            $contact->phone_1 = $request->phone_1; 
            $contact->phone_2 = $request->phone_2; 
            $contact->direction = $request->direction; 
            $contact->province = $request->province;
            $contact->user_id =  auth()->id(); 
            $contact->save(); 
        }
        // $data['confirmation_code'] = 123456789;
        $data['confirmation_code'] = rand(100000,999999);
        $data['name']=$request['name'];
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone_1;
        $user->province = $request->province;
        $user->direction = $request->direction;
        $user->contact_id = $request->contact_id == true ? $contact->id : NULL ;
        $user->password = Hash::make( $data['confirmation_code']);
        $user->role_id = $request->role_id;
        $user->save();
        $data['id']=$user->id;

        Mail::send('emails.confirmation', $data, function($message) use ($request) {
            $message->to($request['email'])->subject('Contraseña');
        });
        
    }
    public function update(Request $request, $id)
    {
        // $data['confirmation_code'] = rand(100000,999999);
        // $data['name']=$request['name'];
        $user = User::find($id);
        // $data['id']=$user->id;
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'province' => $request->province,
            'direction' => $request->direction,
            // 'password' => Hash::make( $data['confirmation_code']),
            'role_id'=>$request->role_id,
            ]);
            
            // Mail::send('emails.password', $data, function($message) use ($request) {
            //     $message->to($request['email'])->subject('Contraseña');
            // });
            return compact('user');
        }
        public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json("success", 200);
    }

    public function updatepassword(Request $request, $id)
    {
        $user = User::find($id);
        if (Hash::check($request->passold, $user->password))
        {
            $data['confirmation_code'] = $request->password;
            $data['name']=$user->name;
            $data['id']=$user->id;
            
            $user->update([
                'password' => Hash::make( $request->password),
                ]);
                
                Mail::send('emails.password', $data, function($message) use ($user) {
                    $message->to($user->email)->subject('Contraseña');
                });
                return compact('user');
        }else{
                return response()->json("error", 401);
        }
    }
            
      
    public function view()
    {
        if($user=User::find(auth()->id())){
            return view('users',['rol'=>$user->role_id]);
        }
        else{
            return view('welcome');
        }
    }
}
