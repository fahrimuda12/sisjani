<?php

namespace App\Http\Controllers;

use App\Models\RunningTextModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RunningController extends Controller
{
    public function index()
    {
        //$jadwal = JadwalModel::all();
        $running = RunningTextModel::all();
        return view('admin.pages.running.index', [
            'title' => 'Dashboard',
            'running' => $running,
        ]);
    }

    public function add()
    {
        //$jadwal = JadwalModel::all();
        return view('admin.pages.running.tambah', [
            'title' => 'Dashboard',
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'text' => 'required',
        ]);

        RunningTextModel::create([
            'text' => $request->input('text'),
        ]);

        return redirect()->to('/admin/running')->withSuccess('Data berhasil ditambahkan');
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
        $running = RunningTextModel::find($id);
        return view('admin.pages.running.edit', [
            'title' => 'Jadwal',
            'running' => $running,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'running' => 'required',
        ]);
        $running = RunningTextModel::find($id);
        $running->updated_at = Carbon::now();
        $running->save();

        return redirect()->to('/admin/running')->withSuccess('Data berhasil diubah');
    }

    public function destroy($id)
    {
        // delete file foto
        $running = RunningTextModel::destroy($id);
        return redirect()->to('/admin/running')->withSuccess('Data berhasil dihapus');
    }

}
