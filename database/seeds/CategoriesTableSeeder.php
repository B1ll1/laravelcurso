<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArray = [
        	['name' => 'Eletrônicos']
        	,['name' => 'Cosméticos']
        	,['name' => 'Vestuário']
        	,['name' => 'Colecionáveis']
        	,['name' => 'Calçados']
        	,['name' => 'Acessórios p/ computadores']
        	,['name' => 'Computadores e Smartphones']
        ];

        Category::insert($dataArray);
    }
}
