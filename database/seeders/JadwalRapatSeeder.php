<?php

namespace Database\Seeders;

use App\Models\JadwalModel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalRapatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JadwalModel::create([
            "nama" => "Rapat 1",
            "ruangan" => "R.Bromo",
            "tgl_mulai" => Carbon::now(),
            "tgl_selesai" => Carbon::now(),
            "snack" => 10,
            "status" => "Internal",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
            "requested_by" => "User",
            "approved_by" => "Administrator",            
        ]);
    }
}
