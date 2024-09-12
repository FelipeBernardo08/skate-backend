<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class likesLocal extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_skater',
        'fk_local'
    ];

    public function skater()
    {
        return $this->belongsTo(skater::class, 'fk_skater');
    }

    public function local()
    {
        return $this->belongsTo(local::class, 'fk_local');
    }

    public function createLike(object $request, int $id_skater): array
    {
        return self::create([
            'fk_skater' => $id_skater,
            'fk_local' => $request->id_local
        ])->toArray();
    }
}
