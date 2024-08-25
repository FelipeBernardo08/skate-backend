<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'announcement_type',
        'fk_type_product',
        'fk_skater'
    ];
}
