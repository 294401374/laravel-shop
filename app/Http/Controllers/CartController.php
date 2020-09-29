<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddcartRequest;
use App\Models\CartItem;

class CartController extends Controller
{
    public function add(AddcartRequest $request)
    {
        $user = $request->user();
        $skuId = $request->input('sku_id');
        $amount = $request->input('amount');
        if ($cartItem = $user->cartItem()->where('product_sku_id', $skuId)->first()) {
            $cartItem->update([
                'amount' => $cartItem->amount + $amount
            ]);
        } else {
            $cartItem = new CartItem(['amount' => $amount]);
            $cartItem->user()->associate($user);
            $cartItem->productSku()->associate($skuId);
            $cartItem->save();
        }
    }
}
