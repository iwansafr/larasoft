<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit()
    {
        return view('user.edit')->with('user', auth()->user());
    }
    public function list()
    {
        return view('user.list');
    }
    public function save(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        if (!empty($id)) {
            $user = User::find($id);
            $view = 'admin/user/edit/' . $id;
        } else {
            $user = new User;
            $view = 'admin/user/edit/';
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        if ($user->save()) {
            return redirect($view)->with('success', 'Data User Berhasil di update');
        } else {
            return redirect($view)->with('error', 'Opps| You have entered invalid credentials');
        }
    }
}
