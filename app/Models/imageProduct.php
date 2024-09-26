<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class imageProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'fk_product',
        'fk_skater'
    ];

    public function product()
    {
        return $this->belongsTo('fk_product');
    }

    public function createImageProduct(object $image, int $id_skater): array
    {
        $img = $image->file('file_name');
        $caminho = $img->store('images', 'public');
        return self::create([
            'file_name' => $caminho,
            'fk_product' => $image->id,
            'fk_skater' => $id_skater
        ])
            ->get()
            ->toArray();
    }

    public function deleteImgProduct(int $id, int $id_skater): bool
    {
        $img = self::where('id', $id)
            ->where('fk_skater', $id_skater)
            ->get()
            ->toArray();

        if (count($img) != 0) {
            Storage::disk('public')->delete($img[0]['file_name']);
            return self::where('id', $id)
                ->where('fk_skater', $id_skater)
                ->delete();
        }

        return false;
    }
}
