<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">マイページ</h2>
    </x-slot>

    <div class="page-section">
        <div class="container-md section-gap">

            <div class="card-simple">
                <div class="flex items-center justify-between">
                    <h3 class="bold-text title-text">ユーザー情報</h3>

                    <a href="{{ route('profile.edit') }}" class="button-blue-hover">
                        アカウント編集
                    </a>
                </div>

                <div class="info-grid-wide">
                    <div class="space-y-2">
                        <div>ユーザー名：{{ $user->name }}</div>
                        <div>Eメール：{{ $user->email }}</div>
                    </div>
                    <div class="space-y-2">
                        <div>名前：{{ $user->name_kanji }}</div>
                        <div>カナ：{{ $user->name_kana }}</div>
                    </div>
                </div>
            </div>

            <div class="card-simple">
                <div class="flex items-center justify-between">
                    <h3 class="bold-text title-text">&lt;出品商品&gt;</h3>

                    <a href="{{ route('mypage.products.create') }}" class="button-blue-hover">
                        新規登録
                    </a>
                </div>

                <div class="mt-section overflow-x-auto">
                    <table class="table-common table-fixed-layout">
                        <thead class="table-head-border">
                            <tr class="table-row-muted">
                                <th class="table-head-cell">商品番号</th>
                                <th class="table-head-cell">商品名</th>
                                <th class="table-head-cell">商品説明</th>
                                <th class="table-head-cell">商品画像</th>
                                <th class="table-head-cell">料金(￥)</th>
                                <th class="table-head-cell"></th>
                            </tr>
                        </thead>
                        <tbody class="table-divide">
                            @forelse($myProducts as $product)
                                <tr>
                                    <td class="table-body-cell">{{ $product->id }}</td>
                                    <td class="table-body-cell">{{ $product->product_name }}</td>
                                    <td class="table-body-cell">{{ $product->description }}</td>
                                    <td class="table-body-cell">
                                        @if($product->img_path)
                                            <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="image-thumb">
                                        @else
                                            画像無し
                                        @endif
                                    </td>
                                    <td class="table-body-cell">{{ $product->price }}</td>
                                    <td class="table-body-cell">
                                        <a href="{{ route('mypage.products.show', $product) }}" class="button-green">
                                            詳細
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="table-empty" colspan="5">出品商品がありません</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-simple">
                <h3 class="bold-text title-text">&lt;購入した商品&gt;</h3>

                <div class="mt-section overflow-x-auto">
                    <table class="table-common table-fixed-layout">
                        <thead class="table-head-border">
                            <tr class="table-row-muted">
                                <th class="table-head-cell">商品名</th>
                                <th class="table-head-cell">商品説明</th>
                                <th class="table-head-cell">商品画像</th>
                                <th class="table-head-cell">料金(￥)</th>
                                <th class="table-head-cell">個数</th>
                            </tr>
                        </thead>
                        <tbody class="table-divide">
                            @forelse($purchasedProducts as $sale)
                                <tr>
                                    <td class="table-body-cell">{{ $sale->product?->product_name }}</td>
                                    <td class="table-body-cell">
                                        {{ $sale->product?->description ?? '説明なし'}}
                                    </td>
                                    <td class="table-body-cell">
                                        @if($sale->product?->img_path)
                                            <img src="{{ asset('storage/' . $sale->product->img_path) }}" alt="商品画像" class="image-thumb">
                                        @else
                                            画像無し
                                        @endif
                                    </td>
                                    <td class="table-body-cell">{{ $sale->product?->price }}</td>
                                    <td class="table-body-cell">{{ $sale->quantity }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="table-empty" colspan="4">購入履歴がありません</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>