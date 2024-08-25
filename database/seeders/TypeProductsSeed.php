<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TypeProductsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_products')->insert([
            [
                'name' => 'Vestimentas'
            ],
            [
                'name' => 'Skate'
            ],
            [
                'name' => 'Roller'
            ]
        ]);
    }
}
