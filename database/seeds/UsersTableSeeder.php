<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArray = [
        	[
        		'user_role_id' => 1, 
        		'platform_id' => 1, 
        		'name' => 'Admin', 
        		'email' => 'admin@curso.com.br', 
        		'password' => bcrypt('123456')
    		]
        	,[
        		'user_role_id' => 2, 
        		'platform_id' => 1, 
        		'name' => 'Vendedor Exemplo',
        		'email' => 'vendedor@curso.com.br',
        		'password' => bcrypt('123456')
    		]
	    	,[
	    		'user_role_id' => 3, 
	    		'platform_id' => 1, 
	    		'name' => 'Cliente Exemplo',
	    		'email' => 'cliente@curso.com.br',
	    		'password' => bcrypt('123456')
			]
        ];

        User::insert($dataArray);
    }
}
