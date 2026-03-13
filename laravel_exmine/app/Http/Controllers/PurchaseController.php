<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PurchaseController extends Controller
{
    public function create(Product $product): View
    {
        $product->load(['company', 'user']); //表示用
        return view('purchase.create', compact('product'));
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $userId = auth()->id();
        $qty = (int)$request->quantity;

        DB::transaction(function() use ($product, $userId, $qty){
            //競合対策：この商品行をロック
            $locked = Product::where('id', $product->id)->lockForUpdate()->first();

            if($locked->stock < $qty){
                abort(422, '在庫が足りません');
            }

            //購入履歴
            Sale::create([
                'user_id' => $userId,
                'product_id' => $locked->id,
                'quantity' => $qty,
            ]);

            //在庫減らす
            $locked->decrement('stock', $qty);
        });

        return redirect()->route('product.show', $product)->with('status','購入しました');
    }
}
