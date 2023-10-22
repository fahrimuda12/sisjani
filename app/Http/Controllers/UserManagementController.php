<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.pages.user-management.index', [
            'title' => 'User Management',
            'user' => $user,
        ]);
    }

    public function add()
    {
        return view('admin.pages.user-management.tambah', [
            'title' => 'Tambah User',
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required|unique:users',
            'role' => 'required',
            'password' => 'required',
            'password_konfirmasi' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->input('nama');
        $user->role = $request->input('role');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->to('/admin/user-management')->withSuccess('Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.pages.user-management.edit', [
            'title' => 'Edit User',
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'role' => 'required',
        ]);

        $havePassword = strlen($request->input('password')) > 0 ? true : false;
        if ($havePassword) {
            $this->validate($request, [
                'password' => 'required|min:8',
                'password_konfirmasi' => 'required|same:password',
            ]);
        }

        $user = User::find($id);
        $user->name = $request->input('nama');
        $user->role = $request->input('role');
        if ($havePassword) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return redirect()->to('/admin/user-management')->withSuccess('Data berhasil diubah');
    }

    public function destroy($id)
    {
        $user = User::destroy($id);
        return redirect()->to('/admin/user-management')->withSuccess('Data berhasil dihapus');
    }

}
