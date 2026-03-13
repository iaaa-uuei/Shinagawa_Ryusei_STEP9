<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;
use Illuminate\View\View;

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

    public function update(Request $request, Product $product)
    {
        abort_unless($product->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['img_path'] = $imagePath;
        }

        $product->update($validated);

        return redirect()
            ->route('mypage.products.show', $product)
            ->with('status', '更新しました');
    }

    public function destroy(Product $product): RedirectResponse
    {
        //自分の商品以外は消せない
        abort_unless($product->user_id === auth()->id(), 403);

        $product->delete();

        return redirect()
            ->route('mypage.index')
            ->with('status', '削除しました');
    }

    public function create(): View
    {
        return view('mypage.products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = auth()->user();

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'product_name' => $validated['product_name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'img_path' => $imagePath,
        ]);

        return redirect()
            ->route('mypage.index')
            ->with('status', '商品を登録しました');
    }
}
