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
        'fk_product'
    ];

    public function product()
    {
        return $this->belongsTo('fk_product');
    }

    public function createImageProduct(object $image, int $id_product): array
    {
        $img = $image->file('file_name');
        $caminho = $img->store('images', 'public');
        return self::create([
            'file_name' => $caminho,
            'fk_product' => $id_product
        ])
            ->get()
            ->toArray();
    }

    public function deleteImgTicket(int $id, int $id_product): bool
    {
        $img = self::where('id', $id)
            ->where('fk_product', $id_product)
            ->get()
            ->toArray();

        if (count($img) != 0) {
            Storage::disk('public')->delete($img[0]['file_name']);
            return self::where('id', $id)
                ->where('fk_product', $id_product)
                ->delete();
        }
        return false;
    }
}
