<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('users')->insert([
            [
                'user_nama' => 'admin',
                'user_pass' => Hash::make('admin'),
                'user_hak' => 'ad',
                'user_sts' => '1'
            ],
        ]);
    }
}
