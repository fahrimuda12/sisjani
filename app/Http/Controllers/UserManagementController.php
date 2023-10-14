<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        //$jadwal = JadwalModel::all();
        $user = User::all();
        return view('admin.pages.user-management.index', [
            'title' => 'Dashboard',
            'user' => $user,
        ]);
    }

    public function add()
    {
        //$jadwal = JadwalModel::all();
        return view('admin.pages.user-management.tambah', [
            'title' => 'Dashboard',
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

    // public function getJadwal()
    // {
    //     //$jadwal = JadwalModel::all();
    //     $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
    //     return view('admin.pages.dashboard', [
    //         'title' => 'Jadwal',
    //         'jadwal' => $jadwal
    //     ]);
    // }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.pages.user-management.edit', [
            'title' => 'Jadwal',
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
