<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">出品商品詳細</h2>
    </x-slot>

    <div class="page-section">
        <div class="container-sm">
            <div class="card-simple">

                <div class="mb-block">
                    <div class="label-text">商品名</div>
                    <div class="bold-text">{{ $product->product_name }}</div>
                </div>

                <div class="mb-block">
                    <div class="label-text">商品説明</div>
                    <div>{{ $product->description }}</div>
                </div>

                @if($product->img_path)
                    <div class="mb-block">
                        <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="image-lg">
                    </div>
                @endif

                <div class="mb-block">
                    <div class="label-text">価格</div>
                    <div>{{ $product->price }}</div>
                </div>

                <div class="actions-row-md">
                    <a href="{{ route('mypage.index') }}" class="button-gray">
                        戻る
                    </a>

                    <a href="{{ route('mypage.products.edit', $product) }}" class="button-blue">
                        編集
                    </a>

                    <form method="POST" action="{{ route('mypage.products.destroy', $product) }}" onsubmit="return confirm('削除しますか？')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="button-red">
                            削除
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>