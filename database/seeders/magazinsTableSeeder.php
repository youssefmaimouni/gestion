<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class magazinsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('magazins')->insert([
            'nom' => 'magazin principal',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
