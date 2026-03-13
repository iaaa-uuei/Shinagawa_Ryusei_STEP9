<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品詳細
        </h2>
    </x-slot>

    <div class="page-section">
        <div class="container-sm">
            <div class="card space-y-main">

                <div>
                    <div class="label-text">商品名</div>
                    <div class="title-text">{{ $product->product_name }}</div>
                </div>

                <div>
                    <div class="label-text">説明</div>
                    <div>{{ $product->description ?? ' (説明なし) ' }}</div>
                </div>

                @if($product->img_path)
                    <div class="mb-block-lg">
                        <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="image-square-lg">
                    </div>
                @else
                    <div class="mb-block-lg muted-text">
                        画像無し
                    </div>
                @endif

                <div class="info-grid">
                    <div>
                        <div class="label-text">価格</div>
                        <div>{{ number_format($product->price) }} 円</div>
                    </div>
                    <div>
                        <div class="label-text">在庫</div>
                        <div>{{ $product->stock }}</div>
                    </div>
                </div>

                <div class="info-grid">
                    <div>
                        <div class="label-text">会社</div>
                        <div>{{ $product->company?->company_name ?? ' (未設定)' }}</div>
                    </div>
                    <div>
                        <div class="label-text">出品者</div>
                        <div>{{ $product->user?->name_kanji ?? $product->user?->name }}</div>
                    </div>
                </div>

                <div class="actions-row">
                    @php
                        $liked = $product->likes->where('user_id', auth()->id())->isNotEmpty();
                    @endphp

                    <a href="{{ route('product.index') }}" class="button-gray">
                        戻る
                    </a>

                    <button
                        id="like-button"
                        type="button"
                        data-url="{{ route('product.like', $product) }}"
                        data-liked="{{ $liked ? '1' : '0' }}"
                        class="like-button {{ $liked ? 'like-button-liked' : 'like-button-unliked' }}"
                    >
                        {{ $liked ? '♡お気に入り解除' : '♡お気に入り' }}
                    </button>

                    <span id="like-count" class="like-count">
                        {{ $product->likes->count() }}
                    </span>

                    @if($product->stock > 0)
                        <a href="{{ route('purchase.create', $product) }}" class="button-blue-hover">
                            購入へ
                        </a>
                    @else
                        <span class="soldout-badge">
                            在庫切れ
                        </span>
                    @endif
                </div>

                @if(session('status'))
                    <div class="success-text">
                        {{ session('status') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>