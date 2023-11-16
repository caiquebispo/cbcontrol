<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'corporate_reason' => 'Company Teste',
            'email' => 'companyteste@cbcontrol.com',
            'state_registration' => 'BA',
            'foundation_date' => (new \DateTime('now'))->format('Y-m-d'),
            'phone' => '48 93431-9801',
            'cnpj' => '01.141.370/0001-01',
        ];
    }
}
