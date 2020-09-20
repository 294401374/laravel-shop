<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $buider = Product::query()->where('on_sale', true);
        if ($search = $request->input('search', '')){
            $like = '%' . $search . '%';
            $buider->where(function ($query) use ($like){
                $query->where('title', 'like' , $like)
                      ->orWhere('description', 'like', $like)
                      ->orWhereHas('skus', function($query) use ($like){
                         $query->where('title', 'like', $like)
                               ->orWhere('description', 'like', $like);
                      });
            });
        }
        if ($order = $request->input('order', '')){
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    $buider->orderBy($m[1], $m[2]);
                }
            }
        }
        $products = $buider->paginate(16);
        $filters = [
            'search' => $search,
            'order' => $order,
        ];
        return view('products.index', compact('products', 'filters'));
    }
}
