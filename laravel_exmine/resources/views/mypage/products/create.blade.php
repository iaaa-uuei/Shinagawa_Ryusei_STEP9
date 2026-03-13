<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品新規登録</h2>
    </x-slot>

    <div class="page-section">
        <div class="container-sm">
            <div class="card-simple">
                <form method="POST" action="{{ route('mypage.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-block">
                        <label class="form-label">商品名</label>
                        <input
                            type="text"
                            name="product_name"
                            class="input-text"
                            value="{{ old('product_name') }}"
                            required
                        >
                        @error('product_name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-block">
                        <label class="form-label">商品説明</label>
                        <textarea
                            name="description"
                            class="textarea-common"
                            rows="4"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-block">
                        <label class="form-label">価格</label>
                        <input
                            type="number"
                            name="price"
                            class="input-text"
                            value="{{ old('price') }}"
                            required
                        >
                        @error('price')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-block-lg">
                        <label class="form-label">在庫数</label>
                        <input
                            type="number"
                            name="stock"
                            class="input-number-sm"
                            value="{{ old('stock') }}"
                            min="0"
                            required
                        >
                        @error('stock')
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
                        @error('image')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="actions-row-sm">
                        <a href="{{ route('mypage.index') }}" class="button-gray">
                            戻る
                        </a>

                        <button type="submit" class="button-blue">
                            登録
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>