<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\Like;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): View
    {
        $loginUserId = auth()->id();

        $products = Product::getIndexProducts($loginUserId);

        return view('products.index', compact('products'));
    }

    //追加：詳細
    public function show(Product $product): View
    {
        // company / user を使うなら再読み込み (N+1防止)
        $product->load(['company', 'user', 'likes']);

        return view('products.show', compact('product'));
    }

    public function toggleLike(Product $product): JsonResponse
    {
        $userId = auth()->id();

        $liked = Like::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->exists();

        if($liked){
            Like::where('user_id', $userId)
                ->where('product_id', $product->id)
                ->delete();

            $liked = false;
        }
        else{
            Like::create([
                'user_id' => $userId,
                'product_id' => $product->id,
            ]);

            $liked = true;
        }

        $likeCount = Like::where('product_id', $product->id)->count();

        return response()->json([
            'liked' => $liked,
            'like_count' => $likeCount,
        ]);
    }
}
