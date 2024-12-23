<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skater extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_user',
        'name',
        'fone',
        'address_city',
        'address_estate',
        'active',
    ];

    public function imageProfile()
    {
        return $this->hasMany(imageProfile::class, 'fk_skater');
    }

    public function readSkaterByIdUser(int $id): array
    {
        return self::where('fk_user', $id)
            ->get()
            ->toArray();
    }

    public function createSkater(array $skater): array
    {
        return self::create([
            'fk_user' => $skater['id'],
            'name' => $skater['name']
        ])->toArray();
    }

    public function updateSkater(object $skater, int $id): bool
    {
        return self::where('id', $id)
            ->update([
                'name' => $skater->name,
                'fone' => $skater->fone,
                'address_city' => $skater->address_city,
                'address_estate' => $skater->address_estate
            ]);
    }

    public function activateSkater(int $id): bool
    {
        return self::where('id', $id)
            ->update([
                'active' => true
            ]);
    }
}
