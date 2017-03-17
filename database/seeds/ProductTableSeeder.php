<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
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
    			'status_id' => 1
    			,'category_id' => 1
    			,'seller_id' => 2
    			,'name' => 'Notebook XYZ'
    			,'description' => 'Notebook da marca XYZ, 16GB RAM'
    			,'price' => 2500.00
    			,'amount_by_package' => 10
    			,'package_amount' => 5
    			,'photo' => NULL
                                    ,'created_at' => \Carbon\Carbon::now()->toDateTimeString()
                                    ,'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
    		]
    		,[
    			'status_id' => 2
    			,'category_id' => 4
    			,'seller_id' => 2
    			,'name' => 'Action Figure Batman'
    			,'description' => 'Action Figure do Batman - Cavaleiro das Trevas'
    			,'price' => 300.00
    			,'amount_by_package' => 5
    			,'package_amount' => 20
    			,'photo' => NULL
                                    ,'created_at' => \Carbon\Carbon::now()->toDateTimeString()
                                    ,'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
    		]
    		,[
    			'status_id' => 3
    			,'category_id' => 2
    			,'seller_id' => 2
    			,'name' => 'Maquiagem Maneira'
    			,'description' => 'Maquiagem famosa mais maneira de todas'
    			,'price' => 45.99
    			,'amount_by_package' => 50
    			,'package_amount' => 100
    			,'photo' => NULL
                                    ,'created_at' => \Carbon\Carbon::now()->toDateTimeString()
                                    ,'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
    		]
    	];

        Product::insert($dataArray);
    }
}
