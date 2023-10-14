<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RunningTextModel extends Model
{
    use HasFactory;

    public $table = 'running';
    public $timestamps = false;

    protected $fillable = [
        'text',
    ];
}
