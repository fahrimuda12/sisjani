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
        $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
        return view('admin.pages.dashboard', [
            'title' => 'Dashboard',
            'jadwal' => $jadwal,
        ]);
    }

    public function getJadwal()
    {
        //$jadwal = JadwalModel::all();
        $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
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
            'tgl_mulai' => 'required|after:now',
            'tgl_selesai' => 'required|after:tgl_mulai',
            'snack' => 'required',
            'status' => 'required',
        ]);

        // Validasi apakah ada jadwal yang bertabrakan dalam ruangan yang sama
        $existingMeeting = JadwalModel::where('ruangan', $request->ruangan)
            ->where(function ($query) use ($request) {
                $query->whereBetween('tgl_mulai', [$request->tgl_mulai, $request->tgl_selesai])
                    ->orWhereBetween('tgl_selesai', [$request->tgl_mulai, $request->tgl_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('tgl_mulai', '<', $request->tgl_mulai)
                            ->where('tgl_selesai', '>', $request->tgl_selesai);
                    });
            })
            ->first();

        if ($existingMeeting) {
            $conflictingMeeting = $existingMeeting->nama;
            $conflictingRoom = $existingMeeting->ruangan;
            $conflictingSchedule = "mulai " . $existingMeeting->tgl_mulai . " hingga " . $existingMeeting->tgl_selesai;

            return redirect('/admin/jadwal/input')->with('error', "Ruangan '$conflictingRoom' sudah digunakan pada '$conflictingMeeting' $conflictingSchedule");
        }
        
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
