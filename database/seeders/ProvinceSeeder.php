<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Cabo Delgado',
            'cod' => 'CD',
            'created_at' => now(),
        ]);
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Gaza',
            'cod' => 'GZ',
            'created_at' => now(),
        ]);
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Inhambane',
            'cod' => 'IB',
            'created_at' => now(),
        ]);
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Manica',
            'cod' => 'MN',
            'created_at' => now(),
        ]);
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Maputo Provincia',
            'cod' => 'MP',
            'created_at' => now(),
        ]);
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Nampula',
            'cod' => 'NP',
            'created_at' => now(),
        ]);
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Niassa',
            'cod' => 'NS',
            'created_at' => now(),
        ]);
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'SOFALA',
            'cod' => 'SF',
            'created_at' => now(),
        ]);
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Tete',
            'cod' => 'TT',
            'created_at' => now(),
        ]);
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Zambézia',
            'cod' => 'ZB',
            'created_at' => now(),
        ]);
        DB::table('provinces')->insert([
            'id' => Str::uuid()->toString(),
            'name' => 'Maputo Cidade',
            'cod' => 'MC',
            'created_at' => now(),
        ]);
    }
}
