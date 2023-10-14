<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use App\Models\RunningTextModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublikController extends Controller
{
    public function index()
    {
        $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'ASC')->get();
        // $wkt_mulai = $jadwal[3];
        // $wkt_selesai = $jadwal[4];
        $text = RunningTextModel::all();
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
        $text = RunningTextModel::all();
        return view('publik.pages.flip', [
            'title' => 'Flip',
            'text' => $text,
        ]);
    }
}
