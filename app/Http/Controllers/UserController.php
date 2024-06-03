<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('user.userlist',compact('users'));
    }  
  
    public function create()
    {
      return view('user.adduser');
    }

    public function store(Request $request)
    {
      $user = new User;
      $user->name = $request['name'];
      $user->email = strtolower($request['email']);
      $user->mobile = $request['mobile'];          
      $user->password = Hash::make($request['password']);
      $user->address = $request['address'];
      $user->role_id = $request['role_id'];
      $user->save();

      return redirect('/user/create');

    }

    public function edit(User $user)
    {
        return view('user.adduser', compact('user'));
    }

    public function update(Request $request , $id)
    {
      $user = User::findorFail($id);
      $user->name = $request['name'];
      $user->email = strtolower($request['email']);
      $user->mobile = $request['mobile'];          
      $user->address = $request['address'];
      $user->role_id = $request['role_id'];
      $user->save();

      return redirect('/user');

    }

    public function destroy($id)
    {
        $result = User::destroy($id);
    }
}
