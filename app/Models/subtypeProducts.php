<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subtypeProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type'
    ];

    public function getSubtype(string $request): array
    {
        return self::where('type', $request)
            ->get()
            ->toArray();
    }
}
