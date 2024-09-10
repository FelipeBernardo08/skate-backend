<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageLocal extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'fk_local'
    ];

    public function local()
    {
        return $this->belongsTo(local::class, 'fk_local');
    }

    public function createImageLocal(object $request): bool
    {
        try {
            foreach ($request->images as $image) {
                $img = $image->file('file_name');
                $caminho = $img->store('images', 'public');
                self::create([
                    'file_name' => $caminho,
                    'fk_local' => $request->id_local
                ]);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
