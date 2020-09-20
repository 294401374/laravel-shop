<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::query()->where('on_sale', true)->paginate(16);
        return view('products.index', compact('products'));
    }
}
