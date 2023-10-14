<?php

namespace App\Http\Controllers;

use App\Models\KontenModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    public function index()
    {
        //$jadwal = JadwalModel::all();
        $konten = KontenModel::all();
        return view('admin.pages.konten.index', [
            'title' => 'Dashboard',
            'konten' => $konten,
        ]);
    }

    public function add()
    {
        //$jadwal = JadwalModel::all();
        return view('admin.pages.konten.tambah', [
            'title' => 'Dashboard',
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'foto' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        if (!empty($request->file('foto'))) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('/uploads', $filename);
        } else {
            return redirect()->to('/admin/konten')->withErro('Foto kosong');
        }

        KontenModel::create([
            'foto' => $filename,
        ]);

        return redirect()->to('/admin/konten')->withSuccess('Data berhasil ditambahkan');
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
        return view('admin.pages.konten.edit', [
            'title' => 'Jadwal',
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'foto' => 'required',
        ]);

        $konten = KontenModel::find($id);

        // delete or replace file
        if (!empty($request->file('foto'))) {
            $file = $request->file('foto');
            $file->move('/uploads', $konten->foto);
        } else {
            return redirect()->to('/admin/konten')->withErro('Foto kosong');
        }

        $konten->updated_at = Carbon::now();
        $konten->save();

        return redirect()->to('/admin/konten')->withSuccess('Data berhasil diubah');
    }

    public function destroy($id)
    {
        $user = User::destroy($id);
        return redirect()->to('/admin/konten')->withSuccess('Data berhasil dihapus');
    }

}
