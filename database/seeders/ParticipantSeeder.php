<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('participants')->updateOrInsert(
            ['email' => 'alya@example.test'],
            [
                'name' => 'Alya Rahma',
                'phone' => '081200000001',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('participants')->updateOrInsert(
            ['email' => 'bima@example.test'],
            [
                'name' => 'Bima Putra',
                'phone' => '081200000002',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('participants')->updateOrInsert(
            ['email' => 'citra@example.test'],
            [
                'name' => 'Citra Nabila',
                'phone' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}