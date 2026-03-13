<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">購入</h2>
    </x-slot>

    <div class="page-section">
        <div class="container-sm">
            <div class="card-simple">
                <div class="mb-block">
                    <div class="label-text">商品名</div>
                    <div class="bold-text">{{ $product->product_name }}</div>
                </div>

                <div class="mb-block">
                    <div class="label-text">在庫</div>
                    <div>{{ $product->stock }}</div>
                </div>

                <form method="POST" action="{{ route('purchase.store', $product) }}">
                    @csrf

                    <label class="form-label">価格</label>
                    <div>{{ $product->price }} 円</div>

                    <input
                        type="number"
                        name="quantity"
                        min="1"
                        class="input-number-sm"
                        value="{{ old('quantity', 1) }}"
                        required
                    >

                    @error('quantity')
                        <div class="error-text mt-image">{{ $message }}</div>
                    @enderror

                    <div class="mt-section actions-row-sm">
                        <a href="{{ route('product.show', $product) }}" class="button-gray">
                            戻る
                        </a>
                        <button type="submit" class="button-blue">
                            購入確定
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>