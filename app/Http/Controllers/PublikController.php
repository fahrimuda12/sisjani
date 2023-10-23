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
        $today = Carbon::now();
        $jadwal = JadwalModel::whereDate('tgl_mulai', '<=', $today) // Hanya menampilkan jadwal yang dimulai sebelum atau pada hari ini
        ->whereDate('tgl_selesai', '>=', $today) // dan berakhir setelah atau pada hari ini
        ->orderBy('tgl_selesai', 'ASC')
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
        $jadwal = JadwalModel::whereDate('tgl_mulai', '>=', $today) // Hanya menampilkan jadwal yang dimulai sebelum atau pada hari ini
        ->whereDate('tgl_selesai', '<=', $now) // dan berakhir setelah atau pada hari ini
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
