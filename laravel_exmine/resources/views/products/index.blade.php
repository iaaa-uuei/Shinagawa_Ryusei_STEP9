<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品一覧
        </h2>
    </x-slot>

    <div class="page-section-sm">
        <div class="container-main">
            <div class="card">
                <table class="table-common table-fixed-layout">
                    <thead>
                        <tr>
                            <th class="table-head-cell">商品ID</th>
                            <th class="table-head-cell">商品名</th>
                            <th class="table-head-cell">商品画像</th>
                            <th class="table-head-cell">会社</th>
                            <th class="table-head-cell">出品者</th>
                            <th class="table-head-cell">価格</th>
                            <th class="table-head-cell">在庫</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="table-body-cell">{{ $product->id }}</td>
                                <td class="table-body-cell">{{ $product->product_name }}</td>
                                <td class="table-body-cell">
                                    @if($product->img_path)
                                        <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="image-thumb">
                                    @else
                                        画像無し
                                    @endif
                                </td>
                                <td class="table-body-cell">{{ $product->company?->company_name }}</td>
                                <td class="table-body-cell">{{ $product->user?->name_kanji }}</td>
                                <td class="table-body-cell">{{ $product->price }}</td>
                                <td class="table-body-cell">{{ $product->stock }}</td>
                                <td class="table-body-cell-wide">
                                    <a href="{{ route('product.show', $product->id) }}" class="button-green">
                                        詳細
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($products->isEmpty())
                    <p class="mt-section">表示できる商品はありません</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>