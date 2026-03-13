<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">お問い合わせ完了</h2>
    </x-slot>

    <div class="page-section">
        <div class="container-xs">
            <div class="card-center">
                <p class="title-text mb-block">お問い合わせありがとうございました。</p>
                <p class="label-text-dark mb-block-lg">内容を確認の上、必要に応じて対応いたします。</p>

                <a href="{{ route('product.index') }}" class="button-blue">
                    Homeへ戻る
                </a>
            </div>
        </div>
    </div>
</x-app-layout>