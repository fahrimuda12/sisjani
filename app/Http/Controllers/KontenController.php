<?php

namespace App\Http\Controllers;

use App\Models\KontenModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    public function index()
    {
        $konten = KontenModel::all();
        return view('admin.pages.konten.index', [
            'title' => 'Konten',
            'konten' => $konten,
        ]);
    }

    public function add()
    {
        return view('admin.pages.konten.tambah', [
            'title' => 'Input Konten',
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'foto' => 'required|mimes:png,jpg,jpeg,img|max:5120',
        ], [
            'foto.mimes' => 'Ekstensi file harus png, jpg, jpeg, img',
            'foto.max' => 'Ukuran file maksimum adalah 5 MB',
        ]);

        if (!empty($request->file('foto'))) {
            $file = $request->file('foto');
            $filename = date('H.i.s-d_m_Y') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/slider/', $filename);
        } else {
            return redirect('/admin/konten')->withErro('Foto kosong');
        }

        KontenModel::create([
            'foto' => $filename,
        ]);

        return redirect('/admin/konten')->withSuccess('Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $konten = KontenModel::find($id);
        return view('admin.pages.konten.edit', [
            'title' => 'Jadwal',
            'konten' => $konten,
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
            $file->move(public_path() . '/slider/', $konten->foto);
        } else {
            return redirect()->to('/admin/konten')->withErro('Foto kosong');
        }

        $konten->updated_at = Carbon::now();
        $konten->save();

        return redirect()->to('/admin/konten')->withSuccess('Data berhasil diubah');
    }

    public function destroy($id)
    {
        // delete file foto
        $konten = KontenModel::find($id);
        if (file_exists(public_path() . '/slider/' . $konten->foto)) {
            unlink(public_path() . '/slider/' . $konten->foto);
        }

        $konten = KontenModel::destroy($id);
        return redirect()->to('/admin/konten')->withSuccess('Data berhasil dihapus');
    }

}
