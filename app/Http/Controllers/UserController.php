<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function register(Request $req){

        $user = new User();
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));
        $user->save();

        return $user;
    }

    function logIn(Request $req){
            try {
        $user = User::where('email',$req->email)->first();
        $errorMsg = "This is Error";
        if(!$user){
           return $errorMsg;
        }
        return $user;
            }catch(Exception $e){
                dd("This is Error");
            }
    }
}
