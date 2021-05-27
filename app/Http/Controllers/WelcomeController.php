<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use function Symfony\Component\VarDumper\Dumper\esc;

class WelcomeController extends Controller
{
    public function index()
    {

        if($user=User::find(auth()->id())){

            return view('welcome',['rol'=>$user->role_id]);
        }
        else{
            return view('welcome');
        }
    }
    public function privacy()
    {

        if($user=User::find(auth()->id())){

            return view('privacy',['rol'=>$user->role_id]);
        }
        else{
            return view('privacy');
        }
    }
    public function conditions()
    {

        if($user=User::find(auth()->id())){

            return view('conditions',['rol'=>$user->role_id]);
        }
        else{
            return view('conditions');
        }
    }
}
