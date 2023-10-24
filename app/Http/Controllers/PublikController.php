<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use App\Models\KontenModel;
use App\Models\RunningTextModel;
use Carbon\Carbon;

class PublikController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $now = Carbon::now();
        $tomorrow = $today->copy()->addDay(); // Menambahkan satu hari untuk mendapatkan tanggal besok
        $jadwal = JadwalModel::where('tgl_mulai', '>=', $today) // Rapat dimulai pada hari ini atau setelahnya
        ->where('tgl_selesai', '>=', $now) // Rapat berakhir pada hari ini atau setelahnya
        ->where('tgl_mulai', '<', $tomorrow) // Rapat tidak dimulai di tanggal selanjutnya
        ->orderBy('tgl_mulai', 'ASC')
        ->get();
        // $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
        $text = RunningTextModel::all();
        return view('publik.pages.index', [
            'title' => 'Index',
            'jadwal' => $jadwal,
            'text' => $text,
        ]);
    }

    public function flip()
    {
        $today = Carbon::today();
        $now = Carbon::now();
        $tomorrow = $today->copy()->addDay(); // Menambahkan satu hari untuk mendapatkan tanggal besok
        $jadwal = JadwalModel::where('tgl_mulai', '>=', $today) // Rapat dimulai pada hari ini atau setelahnya
        ->where('tgl_selesai', '>=', $now) // Rapat berakhir pada hari ini atau setelahnya
        ->where('tgl_mulai', '<', $tomorrow) // Rapat tidak dimulai di tanggal selanjutnya
        ->orderBy('tgl_mulai', 'ASC')
        ->get();
        // $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
        $konten = KontenModel::all();
        $text = RunningTextModel::all();
        return view('publik.pages.flip', [
            'title' => 'Flip',
            'jadwal' => $jadwal,
            'text' => $text,
            'konten' => $konten,
        ]);
    }
}
