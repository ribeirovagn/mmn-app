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
        
        Product::create([
            'product_type_id' => $ativacao->id,
            'name' => 'DigiPartner',
            'description' => 'Pacote de ativação',
            'value' => 50
        ]);
        
        $digihash = ProductType::create([
            'name' => 'Multilevel',
            'is_active' => true
        ]);
        
        Product::create([
            'product_type_id' => $digihash->id,
            'name' => 'DigiHash',
            'description' => '8 MH/s Poder de mineração',
            'value' => 300
        ]);
        
        Product::create([
            'product_type_id' => $digihash->id,
            'name' => 'DigiHash',
            'description' => '21 MH/s Poder de mineração',
            'value' => 900
        ]);
                
        
        $voucher = ProductType::create([
            'name' => 'Voucher',
            'is_active' => true
        ]);
        
        Product::create([
            'product_type_id' => $voucher->id,
            'name' => 'Voucher',
            'description' => 'DigiPartner - Pacote de ativação',
            'value' => 50
        ]);
    }
    
    
    
}
