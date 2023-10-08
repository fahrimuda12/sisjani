<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $jadwal = JadwalModel::all();
        return view('admin.pages.dashboard', [
            'title' => 'Dashboard',
            'jadwal' => $jadwal
        ]);
    }

    public function getJadwal()
    {
        $jadwal = JadwalModel::all();
        return view('admin.pages.dashboard', [
            'title' => 'Jadwal',
            'jadwal' => $jadwal
        ]);
    }

    public function getHistory()
    {
        $jadwal = JadwalModel::where('tgl_selesai', '<', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
        return view('admin.pages.history-jadwal', [
            'title' => 'Jadwal',
            'jadwal' => $jadwal
        ]);
    }

    public function addJadwal()
    {
        return view('admin.pages.tambah-jadwal', [
            'title' => 'Tambah Jadwal',
        ]);
    }

    public function saveJadwal(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'ruangan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        JadwalModel::create([
            'nama' => $request->nama,
            'ruangan' => $request->ruangan,
            'tgl_mulai' => $request->tanggal_mulai,
            'tgl_selesai' => $request->tanggal_selesai,
        ]);

        return redirect('/admin/jadwal')->with('success', 'Data berhasil ditambahkan');
    }
}
