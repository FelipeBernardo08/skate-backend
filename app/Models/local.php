<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'access',
        'address_street',
        'address_number',
        'address_neighborhood',
        'address_city',
        'address_estate',
        'fk_skater'
    ];


    public function skater()
    {
        return $this->belongsTo(skater::class, 'fk_skater');
    }

    public function images()
    {
        return $this->hasMany(imageLocal::class, 'fk_local');
    }

    public function likes()
    {
        return $this->hasMany(likesLocal::class, 'fk_local');
    }

    public function coments()
    {
        return $this->hasMany(comentsLocal::class, 'fk_local');
    }

    public function readLocals(): array
    {
        return self::with('skater')
            ->with('skater.imageProfile')
            ->with('images')
            ->with('likes')
            ->with('coments')
            ->with('coments.skater')
            ->with('coments.skater.imageProfile')
            ->get()
            ->toArray();
    }

    public function readLocalId(int $id): array
    {
        return self::where('id', $id)
            ->with('images')
            ->with('skater')
            ->with('skater.imageProfile')
            ->with('likes')
            ->with('coments')
            ->get()
            ->toArray();
    }

    public function createLocal(object $local, int $id_skater): array
    {
        return self::create([
            'title' => $local->title,
            'description' => $local->description,
            'access' => $local->access,
            'address_street' => $local->address_street,
            'address_number' => $local->address_number,
            'address_neighborhood' => $local->address_neighborhood,
            'address_city' => $local->address_city,
            'address_estate' => $local->address_estate,
            'fk_skater' => $id_skater
        ])->toArray();
    }

    public function updateLocal(object $local, int $id, int $id_skater): bool
    {
        return self::where('id', $id)
            ->where('fk_skater', $id_skater)
            ->update([
                'title' => $local->title,
                'description' => $local->description,
                'access' => $local->access,
                'address_street' => $local->address_street,
                'address_number' => $local->address_number,
                'address_neighborhood' => $local->address_neighborhood,
                'address_city' => $local->address_city,
                'address_estate' => $local->address_estate,
            ]);
    }
}
