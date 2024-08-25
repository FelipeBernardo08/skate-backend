<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skater extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_user',
        'name',
        'fone',
        'cpf',
        'address_city',
        'address_neighborhood'
    ];
}
