<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'access',
        'address_street',
        'address_number',
        'address_neighborhood',
        'address_city',
        'address_estate',
        'fk_skater'
    ];
}
