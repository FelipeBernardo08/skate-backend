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

    public function subType()
    {
        return $this->belongsTo(subtypeProducts::class, 'fk_subtype_product');
    }

    public function skater()
    {
        return $this->belongsTo(skater::class, 'fk_skater');
    }

    public function imageProduct()
    {
        return $this->hasMany(imageProduct::class, 'fk_product');
    }

    public function likes()
    {
        return $this->hasMany(LikesProduct::class, 'fk_product');
    }

    public function readProducts(): array
    {
        return self::where('active', true)
            ->where('active', true)
            ->with('type')
            ->with('subType')
            ->with('imageProduct')
            ->with('skater')
            ->with('skater.imageProfile')
            ->with('likes')
            ->get()
            ->toArray();
    }

    public function readProductId(int $id, int $id_skater): array
    {
        return self::where('id', $id)
            ->where('fk_skater', $id_skater)
            ->with('skater')
            ->with('type')
            ->with('subType')
            ->with('imageProduct')
            ->get()
            ->toArray();
    }

    public function readOwnProducts(int $id_skater): array
    {
        return self::where('fk_skater', $id_skater)
            ->with('skater')
            ->with('type')
            ->with('subType')
            ->with('imageProduct')
            ->get()
            ->toArray();
    }

    public function createProduct(object $product, int $id_skater): array
    {
        return self::create([
            'description' => $product->description,
            'brand' => $product->brand,
            'size' => $product->size,
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
                'brand' => $product->brand,
                'size' => $product->size,
                'announcement_type' => $product->announcement_type,
                'fk_type_product' => $product->fk_type_product,
                'fk_subtype_product' => $product->fk_subtype_product,
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

    public function enableProduct(int $id, int $id_skater): bool
    {
        return self::where('id', $id)
            ->where('fk_skater', $id_skater)
            ->update([
                'active' => true
            ]);
    }
}
