<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nette\Utils\Arrays;

class comentsLocal extends Model
{
    use HasFactory;

    protected $fillable = [
        'coment',
        'fk_local',
        'fk_skater',
        'date'
    ];

    public function skater()
    {
        return $this->belongsTo(skater::class, 'fk_skater');
    }

    public function local()
    {
        return $this->belongsTo(local::class, 'fk_local');
    }

    public function createComment(object $request, int $id_skater): array
    {
        date_default_timezone_set('America/Sao_Paulo');
        $date = new DateTime();
        $dateString = $date->format('Y-m-d');
        return self::create([
            'coment' => $request->coment,
            'date' => $dateString,
            'fk_local' => $request->id_local,
            'fk_skater' => $id_skater
        ])->toArray();
    }

    public function updateComment(object $request, int $id, int $id_skater): bool
    {
        return self::where('id', $id)
            ->where('fk_skater', $id_skater)
            ->update([
                'coment' => $request->coment
            ]);
    }
}
