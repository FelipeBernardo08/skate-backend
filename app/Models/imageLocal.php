<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageLocal extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'fk_local'
    ];
}
