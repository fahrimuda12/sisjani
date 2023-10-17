<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        //$jadwal = JadwalModel::all();
        $jadwal = JadwalModel::where('tgl_selesai', '>', Carbon::now())->orderBy('tgl_selesai', 'DESC')->get();
        return view('user.pages.dashboard', [
            'title' => 'Dashboard',
            'jadwal' => $jadwal,
        ]);
    }
}