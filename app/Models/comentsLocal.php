<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comentsLocal extends Model
{
    use HasFactory;

    protected $fillable = [
        'coment',
        'fk_local',
        'fk_skater',
        'date'
    ];
}
