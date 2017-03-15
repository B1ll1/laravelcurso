<?php

use App\Models\ProductStatus;
use Illuminate\Database\Seeder;

class ProductStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$dataArray = [
    		['name' => 'Disponível']
    		,['name' => 'Estoque Reduzido']
    		,['name' => 'Esgotado']
    	];
        
        ProductStatus::insert($dataArray);
    }
}
