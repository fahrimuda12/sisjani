<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublikController extends Controller
{
    public function index()
    {
        $jadwal = JadwalModel::all();
        return view('publik.pages.index', [
            'title' => 'Jadwal',
            'jadwal' => $jadwal
        ]);
    }
}
