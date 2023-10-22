<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function index()
    // {
    //     $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
    //     return view('user.pages.dashboard', [
    //         'title' => 'Dashboard',
    //         'jadwal' => $jadwal,
    //     ]);
    // }

    public function getJadwal()
    {
        $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
        return view('user.pages.dashboard', [
            'title' => 'Jadwal Rapat',
            'jadwal' => $jadwal
        ]);
    }

    public function getHistory()
    {
        $jadwal = JadwalModel::where('tgl_selesai', '<', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
        return view('user.pages.history-jadwal', [
            'title' => 'History Rapat',
            'jadwal' => $jadwal,
        ]);
    }

    public function addJadwal()
    {
        return view('user.pages.input-jadwal', [
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
            'submitted_by' => 'required',
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

            return redirect('/jadwal/input')->with('error', "Ruangan '$conflictingRoom' sudah digunakan pada '$conflictingMeeting' $conflictingSchedule");
        }
        
        JadwalModel::create([
            'nama' => $request->nama,
            'ruangan' => $request->ruangan,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'snack' => $request->snack,
            'status' => $request->status,
            'submitted_by' => $request->submitted_by,
        ]);

        return redirect('/dashboard')->with('success', 'Data berhasil ditambahkan');
    }

    public function editJadwal($id)
    {
        $jadwal = JadwalModel::find($id);
        return view('user.pages.edit-jadwal', [
            'title' => 'Input Jadwal',
            'jadwal' => $jadwal,
        ]);
    }

    public function updateJadwal(Request $request, $id)
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
    
            return redirect("/jadwal/$id/edit")->with('error', "Ruangan '$conflictingRoom' sudah digunakan pada '$conflictingMeeting' $conflictingSchedule");
        }
    
        JadwalModel::where('id', $id)->update([
            'nama' => $request->nama,
            'ruangan' => $request->ruangan,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'snack' => $request->snack,
            'status' => $request->status,
        ]);
    
        return redirect('/dashboard')->with('success', 'Data berhasil diperbarui');
    }

    public function deleteJadwal($id)
    {
        JadwalModel::destroy($id);
    
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus');
    }
    
    
}
