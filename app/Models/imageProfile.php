<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'fk_user'
    ];
}
