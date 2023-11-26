<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Categorias - EDITADO',
            'label' => 'categories',
            'url' => '/app/categories',
            'menu_name' => 'Produtos',
            'order_list' => 1,
            'is_module' => 1,
        ];
    }
}
