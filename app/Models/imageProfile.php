<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class imageProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'fk_skater'
    ];

    public function skater()
    {
        return $this->belongsTo(skater::class, 'fk_skater');
    }

    public function createImageProfile(object $image, int $id_skater): array
    {
        $img = $image->file('file_name');
        $caminho = $img->store('images', 'public');
        return self::create([
            'file_name' => $caminho,
            'fk_skater' => $id_skater
        ])
            ->get()
            ->toArray();
    }

    public function deleteImgTicket(int $id, int $id_skater): bool
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
