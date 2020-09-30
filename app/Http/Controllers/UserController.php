<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'user.edit',
            [
                'title' => 'Tambah',
                'action' => 'user',
                'role' => ['1' => 'root', '2' => 'admin', '3' => 'member'],
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $user = new User();
        $user = $this->UserSave($request, $user);

        if ($user->save()) {
            return redirect('admin/user/create')->with('success', 'Data User Berhasil diSimpan');
        } else {
            return redirect('admin/user/create')->with('error', 'Data User Gagal diSimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);
    }
    private function UserSave(Request $request, $user)
    {
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
        return $user;
    }
    public function UpdateProfile(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $this->validation($request, $id);
        $user = $this->UserSave($request, $user);

        if ($user->save()) {
            return redirect('admin/profile/edit')->with('success', 'Data User Berhasil diSimpan');
        } else {
            return redirect('admin/profile/edit')->with('error', 'Data User Gagal diSimpan');
        }
    }
    public function EditProfile()
    {
        return view(
            'user.edit',
            [
                'title' => 'Edit',
                'action' => 'profile/update',
                'data' => Auth::user(),
                'method' => 'put'
            ]
        );
    }
}
