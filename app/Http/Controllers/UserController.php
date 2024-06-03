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
              'name' => 'required',
              'email' => 'required|email',
              'mobile' => 'required|numeric',
              'password' => 'required',
              'address' => 'required',
              'role_id' => 'required|numeric',
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
              'name' => 'required',
              'email' => 'required|email,' . $id,
              'mobile' => 'required|numeric',
              'address' => 'required',
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
          return redirect('/user')->with('success', 'User deleted successfully');
      }
  
      private function setUserAttributes(User $user, Request $request)
      {
          $user->name = $request->name;
          $user->email = strtolower($request->email);
          $user->mobile = $request->mobile;
          $user->address = $request->address;
          $user->role_id = $request->role_id;
      }
  }
  
