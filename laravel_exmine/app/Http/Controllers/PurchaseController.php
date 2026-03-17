<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreProductRequest;

class PurchaseController extends Controller
{
    public function create(Product $product): View
    {
        $product->load(['company', 'user']); //表示用
        return view('purchase.create', compact('product'));
    }

    public function store(StoreProductRequest $request, Product $product): RedirectResponse
    {
        

        if($request->quantity > $product->stock){
            return back()
                ->withErrors(['quantity' => '在庫数を超えて購入することは出来ません。'])
                ->withInput();
        }

        //購入履歴
        Sale::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);

        $product->decrement('stock', $request->quantity);

        return redirect()->route('product.index')->with('status','購入しました');
    }
}
