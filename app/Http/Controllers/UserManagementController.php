<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user()->username;
        $user = ($currentUser == 'admin') ? User::all()->orderBy('name', 'ASC') : User::where('username', '!=', 'admin')->orderBy('name', 'ASC')->get();
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
            'username' => 'required|alpha_dash|unique:users',
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

        if ($user->role == 'admin' && $request->input('role') != 'admin') {
            return redirect()->to('/admin/user-management')->withError('Anda tidak bisa mengubah akun ini menjadi user!');
        }

        $user->save();

        return redirect()->to('/admin/user-management')->withSuccess('Data berhasil diubah');
    }

    public function destroy($id)
    {
        $currentUser = Auth::user(); 
        $user = User::find($id);

        if ($user->id == $currentUser->id) {
            return redirect()->to('/admin/user-management')->withError('Anda tidak bisa menghapus akun Anda sendiri!');
        }
        
        if ($currentUser->username != 'admin') {
            return redirect()->to('/admin/user-management')->withError('Anda tidak bisa menghapus akun admin!');
        }

        $user->delete();
        return redirect()->to('/admin/user-management')->withSuccess('Data berhasil dihapus');
    }

}
