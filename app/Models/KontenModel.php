<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontenModel extends Model
{
    use HasFactory;

    public $table = 'konten';
    public $timestamps = true;

    protected $fillable = [
        'foto',
    ];
}
