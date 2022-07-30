<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function adminV()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function userV()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function adminUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
            'foto' => 'file|mimes:jpg,png,jpeg,gif,svg,jfif|max:2048',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if ($request->hasFile('foto')) {
            File::delete('images/users/'.$user->foto);
            $file = $request->file('foto');
            $filename = date('YmdHis'). '-' . $request->name . '.' . $request->foto->extension();
            $file->move('images/users/', $filename);
            $user['foto'] = $filename;
        }
        // Jika user mengganti passwornya password

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
            } else {
                Alert::toast('Password Lama Tidak Sesuai!', 'error');
                return redirect()->back();
            }
        }

        $user->save();

        Alert::toast('Data Berhasil Diubah', 'success');
        return redirect()->route('profiladmin');
    }

    public function userUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
            'foto' => 'file|mimes:jpg,png,jpeg,gif,svg,jfif|max:2048',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if ($request->hasFile('foto')) {
            File::delete('images/users/'.$user->foto);
            $file = $request->file('foto');
            $filename = date('YmdHis'). '-' . $request->name . '.' . $request->foto->extension();
            $file->move('images/users/', $filename);
            $user['foto'] = $filename;
        }
        // Jika user mengganti passwornya password

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
            } else {
                Alert::toast('Password Lama Tidak Sesuai!', 'error');
                return redirect()->back();
            }
        }

        $user->save();

        Alert::toast('Data Berhasil Diubah', 'success');
        return redirect()->route('profileuser');
    }
}
