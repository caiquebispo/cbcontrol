<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'User Demo',
            'email' => 'demo@cbcontrol.com',
            'company_id' => 1,
            'number_phone' => '47 93431-9801',
            'cpf' => '052.907.845-78',
            'password' => Hash::make('12345678'),
        ]);
    }
}
