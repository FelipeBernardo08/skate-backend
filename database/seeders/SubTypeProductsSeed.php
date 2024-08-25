<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubTypeProductsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subtype_products')->insert([
            [
                'name' => 'Tenis',
                'type' => 'Vestimentas'
            ],
            [
                'name' => 'Calça',
                'type' => 'Vestimentas'
            ],
            [
                'name' => 'Camiseta',
                'type' => 'Vestimentas'
            ],
            [
                'name' => 'Acessórios',
                'type' => 'Vestimentas'
            ],
            [
                'name' => 'Rolamento',
                'type' => 'Skate'
            ],
            [
                'name' => 'Roda',
                'type' => 'Skate'
            ],
            [
                'name' => 'Truck',
                'type' => 'Skate'
            ],
            [
                'name' => 'Shape',
                'type' => 'Skate'
            ],
            [
                'name' => 'Skate completo',
                'type' => 'Skate'
            ],
            [
                'name' => 'Acessórios',
                'type' => 'Skate'
            ],
            [
                'name' => 'Rolamento',
                'type' => 'Roller'
            ],
            [
                'name' => 'Roda',
                'type' => 'Roller'
            ],
            [
                'name' => 'Roller completo',
                'Roller'
            ]
        ]);
    }
}
