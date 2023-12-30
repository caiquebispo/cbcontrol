<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    $modules = [
      ['name' => 'Dashboard', 'label' => 'dashboard', 'url' => '/app/dashboard', 'menu_name' => 'Painel do Gestor', 'icon_class' => 'x-bi-bar-chart-line-fill', 'order_list' => '1', 'is_module' => '1', 'created_at' => '2023-11-19 11:06:36', 'updated_at' => '2023-11-19 11:07:01'],
      ['name' => 'Categorias', 'label' => 'categories', 'url' => '/app/categories', 'menu_name' => 'Produtos', 'icon_class' => NULL, 'order_list' => '2', 'is_module' => '1', 'created_at' => '2023-11-19 11:08:20', 'updated_at' => '2023-11-19 11:08:20'],
      ['name' => 'Produto', 'label' => 'products', 'url' => '/app/products', 'menu_name' => 'Produtos', 'icon_class' => NULL, 'order_list' => '2', 'is_module' => '1', 'created_at' => '2023-11-19 11:09:06', 'updated_at' => '2023-11-19 11:09:06'],
      ['name' => 'Reusmo de Vendas', 'label' => 'sales', 'url' => '/app/sales', 'menu_name' => 'Vendas', 'icon_class' => NULL, 'order_list' => '3', 'is_module' => '1', 'created_at' => '2023-11-19 11:10:09', 'updated_at' => '2023-11-19 11:10:09'],
      ['name' => 'Grupos', 'label' => 'groups', 'url' => '/app/groups', 'menu_name' => 'Clientes', 'icon_class' => NULL, 'order_list' => '4', 'is_module' => '1', 'created_at' => '2023-11-19 11:10:46', 'updated_at' => '2023-11-19 11:10:46'],
      ['name' => 'Clientes', 'label' => 'clients', 'url' => '/app/clients', 'menu_name' => 'Clientes', 'icon_class' => NULL, 'order_list' => '4', 'is_module' => '1', 'created_at' => '2023-11-19 11:11:19', 'updated_at' => '2023-11-19 11:11:19'],
      ['name' => 'Usuários', 'label' => 'users', 'url' => '/app/user', 'menu_name' => 'Configurações', 'icon_class' => NULL, 'order_list' => '5', 'is_module' => '1', 'created_at' => '2023-11-19 11:12:10', 'updated_at' => '2023-11-19 11:12:10'],
      ['name' => 'Empresa', 'label' => 'company', 'url' => '/app/company', 'menu_name' => 'Configurações', 'icon_class' => NULL, 'order_list' => '5', 'is_module' => '1', 'created_at' => '2023-11-19 11:13:03', 'updated_at' => '2023-11-19 11:13:03'],
      ['name' => 'Criar nova permissão', 'label' => 'create-permission', 'url' => NULL, 'menu_name' => NULL, 'icon_class' => NULL, 'order_list' => NULL, 'is_module' => '0', 'created_at' => '2023-11-19 11:21:35', 'updated_at' => '2023-11-19 11:21:35'],
      ['name' => 'Criar novo perfil', 'label' => 'create-profile', 'url' => NULL, 'menu_name' => NULL, 'icon_class' => NULL, 'order_list' => NULL, 'is_module' => '0', 'created_at' => '2023-11-19 11:22:14', 'updated_at' => '2023-11-19 11:22:14'],
      ['name' => 'Pode acessar a loja online', 'label' => 'can-access-online-store', 'url' => NULL, 'menu_name' => NULL, 'icon_class' => NULL, 'order_list' => NULL, 'is_module' => '0', 'created_at' => '2023-11-19 11:22:14', 'updated_at' => '2023-11-19 11:22:14'],
      ['name' => 'Rede', 'label' => 'network', 'url' => '/app/networks', 'menu_name' => 'Configurações', 'icon_class' => NULL, 'order_list' => '5', 'is_module' => '1', 'created_at' => '2023-11-19 11:13:03', 'updated_at' => '2023-11-19 11:13:03'],
      ['name' => 'Permissões', 'label' => 'permission', 'url' => '/app/permissions', 'menu_name' => 'Configurações', 'icon_class' => NULL, 'order_list' => '5', 'is_module' => '1', 'created_at' => '2023-11-19 11:13:03', 'updated_at' => '2023-11-19 11:13:03'],
      ['name' => 'Controle de Usabilidade', 'label' => 'systemUsability', 'url' => '/app/systemUsability', 'menu_name' => 'Configurações', 'icon_class' => NULL, 'order_list' => '5', 'is_module' => '1', 'created_at' => '2023-11-19 11:13:03', 'updated_at' => '2023-11-19 11:13:03'],
    ];

    $module_profiles = [
      ['module_id' => '1', 'profile_id' => '1'],
      ['module_id' => '2', 'profile_id' => '1'],
      ['module_id' => '3', 'profile_id' => '1'],
      ['module_id' => '4', 'profile_id' => '1'],
      ['module_id' => '5', 'profile_id' => '1'],
      ['module_id' => '6', 'profile_id' => '1'],
      ['module_id' => '7', 'profile_id' => '1'],
      ['module_id' => '8', 'profile_id' => '1'],
      ['module_id' => '9', 'profile_id' => '1'],
      ['module_id' => '10', 'profile_id' => '1'],
      ['module_id' => '11', 'profile_id' => '1'],
      ['module_id' => '12', 'profile_id' => '1'],
      ['module_id' => '13', 'profile_id' => '1'],
    ];

    DB::table('modules')->insert($modules);
    DB::table('profiles')->insert(['name' => 'PROFILE DEMO', 'created_at' => (new DateTime())->format('Y-m-d H:i:s'), 'updated_at' => (new DateTime())->format('Y-m-d H:i:s')]);
    DB::table('module_profiles')->insert($module_profiles);
    DB::table('profile_users')->insert(['user_id' => 1, 'profile_id' => 1]);
  }
}
