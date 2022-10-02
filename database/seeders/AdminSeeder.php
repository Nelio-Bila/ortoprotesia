<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Nélio',
            'surname' => 'Bila',
            'birthdate' => Carbon::createFromDate('1993', '08', '5'),
            'email' => 'neliobila@gmail.com',
            'password' => Hash::make('123456'),
            'created_at' => now()
        ]);
    }
}