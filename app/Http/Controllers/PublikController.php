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
        $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
        $text = RunningTextModel::all();

        // $wkt_mulai = $jadwal[3];
        // $wkt_selesai = $jadwal[4];
        return view('publik.pages.index', [
            'title' => 'Jadwal',
            'jadwal' => $jadwal,
            // 'wkt_mulai' => $wkt_mulai,
            // 'wkt_selesai' => $wkt_selesai,
            'text' => $text,
        ]);
    }

    public function flip()
    {
        $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
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
