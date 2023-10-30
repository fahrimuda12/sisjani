<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function index()
    // {
    //     $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
    //     return view('admin.pages.dashboard', [
    //         'title' => 'Dashboard',
    //         'jadwal' => $jadwal,
    //     ]);
    // }

    public function getJadwal()
    {
        $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_mulai', 'ASC')->get();
        return view('admin.pages.dashboard', [
            'title' => 'Jadwal Rapat',
            'jadwal' => $jadwal,
        ]);
    }

    public function getHistory()
    {
        $jadwal = JadwalModel::where('tgl_selesai', '<', Carbon::now())->orderBy('tgl_selesai', 'DESC')->get();
        return view('admin.pages.history-jadwal', [
            'title' => 'History Rapat',
            'jadwal' => $jadwal,
        ]);
    }

    public function addJadwal()
    {
        return view('admin.pages.tambah-jadwal', [
            'title' => 'Tambah Jadwal Rapat',
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
        ], [
            'tgl_mulai.after' => 'Tanggal mulai harus setelah tanggal dan waktu sekarang.',
            'tgl_selesai.after' => 'Tanggal selesai harus setelah tanggal dan waktu mulai.',
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

            return back()->withInput()->withError("Ruangan '$conflictingRoom' sudah digunakan pada '$conflictingMeeting' $conflictingSchedule");
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

        return redirect('/admin/dashboard')->withSuccess('Data berhasil ditambahkan');
    }

    public function editJadwal($id)
    {
        $jadwal = JadwalModel::find($id);
        return view('admin.pages.edit-jadwal', [
            'title' => 'Edit Jadwal Rapat',
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
        ], [
            'tgl_mulai.after' => 'Tanggal mulai harus setelah tanggal dan waktu sekarang.',
            'tgl_selesai.after' => 'Tanggal selesai harus setelah tanggal dan waktu mulai.',
        ]);

        // Mengambil jadwal rapat yang sedang diubah
        $jadwal = JadwalModel::find($id);

        if ($jadwal) {
            // Jika ada perubahan pada tgl_mulai atau tgl_selesai
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
                ->where('id', '!=', $id) // Exclude the current meeting being edited
                ->first();

            if ($existingMeeting) {
                $conflictingMeeting = $existingMeeting->nama;
                $conflictingRoom = $existingMeeting->ruangan;
                $conflictingSchedule = "mulai " . $existingMeeting->tgl_mulai . " hingga " . $existingMeeting->tgl_selesai;

                return back()->withError("Ruangan '$conflictingRoom' sudah digunakan pada '$conflictingMeeting' $conflictingSchedule");
            }
        }

        // Jika tidak ada konflik, lakukan pembaruan jadwal rapat
        $jadwal->update([
            'nama' => $request->nama,
            'ruangan' => $request->ruangan,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'snack' => $request->snack,
            'status' => $request->status,
        ]);

        return redirect('/admin/dashboard')->withSuccess('Data berhasil diperbarui');
    }

    public function deleteJadwal($id)
    {
        JadwalModel::destroy($id);

        return redirect('/admin/dashboard')->withSuccess('Data berhasil dihapus');
    }
}
