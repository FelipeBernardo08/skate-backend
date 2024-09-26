<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class imageLocal extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'fk_local',
        'fk_skater'
    ];

    public function local()
    {
        return $this->belongsTo(local::class, 'fk_local');
    }

    public function createImageLocal($request, int $id, int $id_skater): array
    {
        $img = $request->file('file_name');
        $caminho = $img->store('images', 'public');
        return self::create([
            'file_name' => $caminho,
            'fk_local' => $id,
            'fk_skater' => $id_skater
        ])->get()->toArray();
    }

    public function deleteImage(int $id, int $id_skater): bool
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
