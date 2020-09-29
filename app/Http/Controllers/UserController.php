<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.edit', ['title' => 'Update'])->with('user', auth()->user());
        } else {
            $id = $request->id;
            if (empty($id)) {
                $user = Auth::user();
                $id = $user->id;
            }
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required'
            ]);
            if ($request->isMethod('post')) {
                if (!empty($user)) {
                    $user = User::find($id);
                } else {
                    $user = new User;
                }
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                if (!empty($request->role)) {
                    $user->role = $request->role;
                }
                if (!empty($request->photo)) {
                    $slug = Str::of($request->email)->slug('-');
                    if ($request->hasFile('photo')) {
                        if ($request->file('photo')->isValid()) {
                            $photo_title = $slug . '.' . $request->photo->extension();
                            $request->photo->storeAs('public/images/user', $photo_title);
                            $user->photo = $photo_title;
                        }
                    }
                }
                if ($user->save()) {
                    return redirect(url()->current())->with('success', 'Data User Berhasil di update');
                } else {
                    return redirect(url()->current())->with('error', 'Opps| You have entered invalid credentials');
                }
            }
        }
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
            'password_confirmation' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
