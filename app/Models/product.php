<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'active',
        'brand',
        'size',
        'announcement_type',
        'fk_type_product',
        'fk_subtype_product',
        'fk_skater'
    ];

    public function type()
    {
        return $this->belongsTo(typeProducts::class, 'fk_type_product');
    }

    public function skater()
    {
        return $this->belongsTo(skater::class, 'fk_skater');
    }

    public function readProducts(): array
    {
        return self::where('active', true)
            ->with('type')
            ->with('skater')
            ->get()
            ->toArray();
    }

    public function readProductId(int $id): array
    {
        return self::where('id', $id)
            ->where('active', true)
            ->with('type')
            ->with('skater')
            ->get()
            ->toArray();
    }

    public function readOwnProducts(int $id_skater): array
    {
        return self::where('fk_skater', $id_skater)
            ->with('type')
            ->get()
            ->toArray();
    }

    public function createProduct(object $product, int $id_skater): array
    {
        return self::create([
            'description' => $product->description,
            'announcement_type' => $product->announcement_type,
            'fk_type_product' => $product->fk_type_product,
            'fk_subtype_product' => $product->fk_subtype_product,
            'fk_skater' => $id_skater
        ])->toArray();
    }

    public function updateProduct(object $product, int $id, int $id_skater): bool
    {
        return self::where('id', $id)
            ->where('fk_skater', $id_skater)
            ->update([
                'description' => $product->description,
                'announcement_type' => $product->announcement_type,
                'fk_type_product' => $product->fk_type_product
            ]);
    }

    public function desactiveProduct(int $id, int $id_skater): bool
    {
        return self::where('id', $id)
            ->where('fk_skater', $id_skater)
            ->update([
                'active' => false
            ]);
    }
}
