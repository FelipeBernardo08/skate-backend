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

    public function createImageLocal($request, int $id): array
    {
        $img = $request->file('file_name');
        $caminho = $img->store('images', 'public');
        return self::create([
            'file_name' => $caminho,
            'fk_local' => $id
        ])->toArray();
    }
}
