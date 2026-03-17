<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseApiController extends Controller
{
    public function store(Request $request, Product $product): JsonResponse
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($product->stock < $request->quantity) {
            return response()->json([
                'message' => '在庫が足りません',
                'product_id' => $product->id,
                'stock' => $product->stock,
                'requested_quantity' => $request->quantity,
            ], 422);
        }

        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'user_id' => $request->user_id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);

            $product->decrement('stock', $request->quantity);

            DB::commit();

            return response()->json([
                'message' => '購入が完了しました',
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'user_id' => $request->user_id,
                'quantity' => $request->quantity,
                'remaining_stock' => $product->fresh()->stock,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'message' => '購入処理に失敗しました',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}