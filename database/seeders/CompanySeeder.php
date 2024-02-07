<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            'corporate_reason' => 'Company Demo',
            'email' => 'companydemo@cbcontrol.com',
            'state_registration' => 'BA',
            'foundation_date' => (new \DateTime('now'))->format('Y-m-d'),
            'phone' => '47 93431-9801',
            'cnpj' => '01.141.370/0001-01',
        ]);
    }
}
