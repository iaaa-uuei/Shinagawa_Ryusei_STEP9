<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', [ProductController::class, 'index'])
        ->middleware('auth')
        ->name('product.index');
});

Route::middleware('auth')->group(function(){
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');

    //追加：商品詳細
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
});

Route::middleware('auth')->group(function(){
    Route::post('/products/{product}/likes', [ProductController::class, 'toggleLike'])
        ->name('product.like');
});

Route::middleware('auth')->group(function(){
    Route::get('/products/{product}/purchase', [PurchaseController::class, 'create'])
        ->name('purchase.create');

    Route::post('/products/{product}/purchase', [PurchaseController::class, 'store'])
        ->name('purchase.store');
});

Route::middleware('auth')->group(function(){
    Route::get('/mypage', [MyPageController::class, 'index'])
        ->name('mypage.index');
});

Route::middleware('auth')->group(function(){
    Route::get('/mypage/products/{product}',
        [MyPageController::class, 'show'])
        ->name('mypage.products.show');
});

Route::middleware('auth')->group(function(){
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage.index');

    //新規登録画面
    Route::get('/mypage/products/create', [MyPageController::class, 'create'])
        ->name('mypage.products.create');

    //登録処理
    Route::post('/mypage/products', [MyPageController::class, 'store'])
        ->name('mypage.products.store');

    //出品商品詳細
    Route::get('/mypage/products/{product}', [MyPageController::class, 'show'])
        ->whereNumber('product')
        ->name('mypage.products.show');

    //編集画面
    Route::get('/mypage/products/{product}/edit', [MyPageController::class, 'edit'])
        ->whereNumber('product')
        ->name('mypage.products.edit');

    //更新
    Route::put('/mypage/products/{product}', [MyPageController::class, 'update'])
        ->whereNumber('product')
        ->name('mypage.products.update');

    //削除
    Route::delete('/mypage/products/{product}', [MyPageController::class, 'destroy'])
        ->whereNumber('product')
        ->name('mypage.products.destroy');
});

Route::middleware('auth')->group(function(){
    Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');
});

require __DIR__.'/auth.php';
