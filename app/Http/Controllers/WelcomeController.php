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
            return view('welcome',['rol'=>$user->rol_id]);
        }
        else{
            return view('welcome');
        }
    }
}
