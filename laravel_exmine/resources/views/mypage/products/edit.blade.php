<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">出品商品編集</h2>
    </x-slot>

    <div class="page-section">
        <div class="container-sm">
            <div class="card-simple">
                <form method="POST" action="{{ route('mypage.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-block">
                        <label class="form-label-dark">商品名</label>
                        <input
                            type="text"
                            name="product_name"
                            class="input-text"
                            value="{{ old('product_name', $product->product_name) }}"
                            required
                        >
                        @error('product_name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-block">
                        <label class="form-label-dark">商品説明</label>
                        <textarea
                            name="description"
                            class="textarea-common"
                            rows="4"
                        >{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-block-lg">
                        <label class="form-label">商品画像</label>
                        <input
                            type="file"
                            name="image"
                            class="input-file"
                            accept="image/*"
                        >

                        @if($product->img_path)
                            <div class="mt-image">
                                <img src="{{ asset('storage/' . $product->img_path) }}" alt="現在の画像" class="image-md">
                            </div>
                        @endif
                    </div>

                    <div class="mb-block-lg">
                        <label class="form-label-dark">価格</label>
                        <input
                            type="number"
                            name="price"
                            min="0"
                            class="input-number-md"
                            value="{{ old('price', $product->price) }}"
                            required
                        >
                        @error('price')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-block-lg">
                        <label class="form-label-dark">在庫</label>
                        <input
                            type="number"
                            name="stock"
                            min="0"
                            class="input-number-md"
                            value="{{ old('stock', $product->stock) }}"
                            required
                        >
                        @error('stock')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="actions-row-sm">
                        <a href="{{ route('mypage.products.show', $product) }}" class="button-gray">
                            戻る
                        </a>
                        <button type="submit" class="button-blue">
                            更新
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>