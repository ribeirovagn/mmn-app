<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Graduation;
use App\Bonus;

class BusinessPlan extends Controller
{
    public function index(){
        
        $productController = new ProductController();
        
        return [
            'graduations' => Graduation::all(),
            'bonuses' => Bonus::where('is_active', 1)->get(),
            'products' => Product::with(['productType', 'levels'])->get()
        ];
    }
}
