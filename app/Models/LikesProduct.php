<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikesProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_skater',
        'fk_product'
    ];

    public function skater()
    {
        return $this->belongsTo(skater::class, 'fk_skater');
    }

    public function product()
    {
        return $this->belongsTo(product::class, 'fk_product');
    }

    public function createLike(object $request, int $id_skater): array
    {
        return self::create([
            'fk_skater' => $id_skater,
            'fk_product' => $request->id_product
        ])->toArray();
    }

    public function removeLike(int $id, int $id_skater): bool
    {
        return self::where('fk_skater', $id_skater)
            ->where('fk_product', $id)
            ->delete();
    }
}
