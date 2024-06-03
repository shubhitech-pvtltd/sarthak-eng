<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
   public function login()
   {
     	return view('login.login');
   }

   public function SubmitLogin(Request $req)
   {
     	$user = User::where('email', strtolower($req->email))->first();
        if ($user){
            if ((Hash::check($req->password, $user->password))) {

               session([
               'email' => $user->email,
               'name'=> $user->name,
               'id'=> $user->id,
               'address'=> $user->address,
               'mobile'=> $user->mobile,
            ]);
   
            return redirect('/');
   
            }else{
               return redirect()->back()->with("error","Incorrect Password");
            }
         }else{
               return redirect()->back()->with("error","User Not Found");
        }
      
   }

}
