<?php

use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$dataArray = [
    		['name' => 'Plataforma Exemplo', 'url' => 'plataforma-exemplo']
    		,['name' => 'Plataforma Exemplo 2', 'url' => 'plataforma-exemplo-2']
    	];
        
        Platform::insert($dataArray);
    }
}
