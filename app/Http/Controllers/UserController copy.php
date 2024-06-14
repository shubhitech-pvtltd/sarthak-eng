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
        return view('user.userlist', compact('users'));
    }

    public function create()
    {
        return view('user.adduser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => '',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|numeric',
            'password' => 'min:6|confirmed',
            'user_address_1' => '',
            'user_address_2' => '',
            'state' => '',
            'city' => '',
            'pincode' => '',
            'gender_id' => 'required|numeric',
            'role_id' => 'required|numeric',
            'username'=>'required|unique:users',

        ]);

        $user = new User;
        $this->setUserAttributes($user, $request);
        $user->password = Hash::make($request['password']);
        $user->save();

        return redirect('/user')->with('success', 'User added successfully');
    }

    public function edit(User $user)
    {
        return view('user.adduser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|numeric',
            'user_address_1' => '',
            'user_address_2' => '',
            'state' => '',
            'city' => '',
            'pincode' => '',
            'role_id' => 'required|numeric',

        ]);

        $user = User::findOrFail($id);
        $this->setUserAttributes($user, $request);
        $user->save();

        return redirect('/user')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {

        User::destroy($id);
    }


    private function setUserAttributes(User $user, Request $request)
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = strtolower($request->email);
        $user->mobile = $request->mobile;
        $user->user_address_1 = $request->user_address_1;
        $user->user_address_2 = $request->user_address_2;
        $user->country= $request->country;
        $user->state =  $request->state;
        $user->city = $request->city;
        $user->pincode = $request->pincode;
        $user->gender_id = $request->gender_id;
        $user->role_id = $request->role_id;
        $user->username = $request->username;
    }
}


  