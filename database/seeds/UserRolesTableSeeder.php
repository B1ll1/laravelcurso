<?php

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    private $table = 'user_roles';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArray = [
        	['name' => 'Administrador']
        	,['name' => 'Vendedor']
        	,['name' => 'Cliente']
        ];

        UserRole::insert($dataArray);
    }
}
