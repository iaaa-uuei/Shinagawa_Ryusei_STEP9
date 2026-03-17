<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">
            商品一覧
        </h2>
    </x-slot>

    <div class="page-section-sm">
        <div class="container-main">
            <div class="card">

                {{-- 検索フォーム --}}
                <form method="GET" action="{{ route('product.index') }}" class="product-search-form">
                    <input
                        type="text"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="商品名を入力"
                        class="search-input search-keyword"
                    >

                    <input
                        type="number"
                        name="min_price"
                        value="{{ request('min_price') }}"
                        placeholder="最低価格"
                        class="search-input search-price"
                    >

                    <span class="search-separator">〜</span>

                    <input
                        type="number"
                        name="max_price"
                        value="{{ request('max_price') }}"
                        placeholder="最高価格"
                        class="search-input search-price"
                    >

                    <button type="submit" class="button-search">
                        検索
                    </button>
                </form>

                {{-- 一覧テーブル --}}
                <table class="product-table">
                    <thead>
                        <tr>
                            <th class="product-th">商品番号</th>
                            <th class="product-th">商品名</th>
                            <th class="product-th">商品説明</th>
                            <th class="product-th product-image-col">画像</th>
                            <th class="product-th">料金(￥)</th>
                            <th class="product-th product-detail-col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="product-row">
                                <td class="product-td">{{ $product->id }}</td>
                                <td class="product-td">{{ $product->product_name }}</td>
                                <td class="product-td">{{ $product->description }}</td>
                                <td class="product-td product-image-col">
                                    @if($product->img_path)
                                        <img
                                            src="{{ asset('storage/' . $product->img_path) }}"
                                            alt="商品画像"
                                            class="product-table-image"
                                        >
                                    @else
                                        <span class="muted-text">画像無し</span>
                                    @endif
                                </td>
                                <td class="product-td">{{ $product->price }}</td>
                                <td class="product-td product-detail-col">
                                    <a href="{{ route('product.show', $product->id) }}" class="button-green">
                                        詳細
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="table-empty">
                                    表示できる商品はありません
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>