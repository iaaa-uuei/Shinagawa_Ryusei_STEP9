<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;
use Illuminate\View\View;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Log;

class MyPageController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        //出品商品(自分が出した商品)
        $myProducts = $user->products()->latest()->get();

        //購入商品(sales + product)
        $purchasedProducts = $user->sales()
            ->with('product')
            ->latest()
            ->get();

        return view('mypage.index', compact(
            'user',
            'myProducts',
            'purchasedProducts'
        ));
    }

    public function show(Product $product): View
    {
        //自分の出品かチェック(重要)
        if($product->user_id !== auth()->id()){
            abort(403);
        }

        return view('mypage.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        abort_unless($product->user_id === auth()->id(), 403);

        return view('mypage.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try{
            abort_unless($product->user_id === auth()->id(), 403);

            $imagePath = $product->img_path;

            if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('products', 'public');
            }

            $product->update([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'img_path' => $imagePath,
            ]);

            return redirect()
                ->route('mypage.products.show', $product)
                ->with('status', '更新しました');
        } catch(\Exception $e){
            Log::error($e);

            return redirect()
                ->back()
                ->with('error', '更新に失敗しました。');
        }
    }

    public function destroy(Product $product): RedirectResponse
    {
        try{
            //自分の商品以外は消せない
            abort_unless($product->user_id === auth()->id(), 403);

            $product->delete();

            return redirect()
                ->route('mypage.index')
                ->with('status', '削除しました');
        } catch(\Exception $e){
            Log::error($e);

            return redirect()
                ->back()
                ->with('error', '削除に失敗しました。');
        }
    }

    public function create(): View
    {
        return view('mypage.products.create');
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        try{
            $user = auth()->user();

            $imagePath = null;
            if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('products', 'public');
            }

            Product::create([
                'user_id' => $user->id,
                'product_name' => $request->product_name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'img_path' => $imagePath,
            ]);

            return redirect()
                ->route('mypage.index')
                ->with('status', '商品を登録しました。');
        } catch(\Exception $e){
            Log::error($e);

            return redirect()
                ->back()
                ->with('error', '商品登録に失敗しました。');
        }
    }
}
