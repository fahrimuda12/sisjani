<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalModel extends Model
{
    use HasFactory;

    public $table = 'jadwal';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'ruangan',
        'tgl_mulai',
        'tgl_selesai',
        'snack',
        'status',
        'submitted_by',
    ];
    protected $casts = [
        'tgl_mulai' => 'datetime',
        'tgl_selesai' => 'datetime',
    ];
}
