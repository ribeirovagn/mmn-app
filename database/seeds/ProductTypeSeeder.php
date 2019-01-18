<?php

use Illuminate\Database\Seeder;
use App\ProductType;
use App\Product;



class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ativacao = ProductType::create([
            'name' => 'Activation',
            'is_active' => true
        ]);
        
        $digihash = ProductType::create([
            'name' => 'Multilevel',
            'is_active' => true
        ]);
        
        $voucher = ProductType::create([
            'name' => 'Voucher',
            'is_active' => true
        ]);
        
    }
    
    
    
}
