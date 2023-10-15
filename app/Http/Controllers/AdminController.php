<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use App\Models\RunningTextModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        //$jadwal = JadwalModel::all();
        $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
        return view('admin.pages.dashboard', [
            'title' => 'Dashboard',
            'jadwal' => $jadwal,
        ]);
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

    public function getHistory()
    {
        $jadwal = JadwalModel::where('tgl_selesai', '<', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
        return view('admin.pages.history-jadwal', [
            'title' => 'Jadwal',
            'jadwal' => $jadwal,
        ]);
    }

    public function getRunningText()
    {
        $running = RunningTextModel::all();
        return view('admin.pages.running-text', [
            'title' => 'Running Text',
            'running' => $running,
        ]);
    }

    public function addJadwal()
    {
        return view('admin.pages.input-jadwal', [
            'title' => 'Input Jadwal',
        ]);
    }

    public function saveJadwal(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'ruangan' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'snack' => 'required',
            'status' => 'required',
            // 'created_at' => 'required',

        ]);

        JadwalModel::create([
            'nama' => $request->nama,
            'ruangan' => $request->ruangan,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'snack' => $request->snack,
            'status' => $request->status,
            // 'created_at' => Carbon::now(),
        ]);

        return redirect('/admin/dashboard')->with('success', 'Data berhasil ditambahkan');
    }
}
