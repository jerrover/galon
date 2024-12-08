<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->insert([
            [
                'name' => 'ddddTeam',
                'phone_number' => '085893930323',
                'address' => 'parungpanjang',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'fadhil',
                'phone_number' => '085893930323',
                'address' => 'jagabaya',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 