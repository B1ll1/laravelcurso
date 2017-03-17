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
    		['name' => 'Plataforma Exemplo', 'url' => 'plataforma-exemplo','created_at' => \Carbon\Carbon::now()->toDateTimeString(),'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
    		,['name' => 'Plataforma Exemplo 2', 'url' => 'plataforma-exemplo-2','created_at' => \Carbon\Carbon::now()->toDateTimeString(),'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
    	];

        Platform::insert($dataArray);
    }
}
