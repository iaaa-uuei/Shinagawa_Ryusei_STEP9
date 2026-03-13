<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">お問い合わせフォーム</h2>
    </x-slot>

    <div class="page-section">
        <div class="container-form">
            <div class="card-form">

                @if(session('status'))
                    <div class="success-box">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="mb-block">
                        <label class="form-label-dark">名前</label>
                        <input
                            type="text"
                            name="name"
                            class="input-text"
                            value="{{ old('name', auth()->user()->name ?? '') }}"
                            required
                        >
                        @error('name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-block">
                        <label class="form-label-dark">メールアドレス</label>
                        <input
                            type="email"
                            name="email"
                            class="input-text"
                            value="{{ old('email', auth()->user()->email ?? '') }}"
                            required
                        >
                        @error('email')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-block">
                        <label class="form-label-dark">件名</label>
                        <input
                            type="text"
                            name="subject"
                            class="input-text"
                            value="{{ old('subject') }}"
                            required
                        >
                        @error('subject')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-block-lg">
                        <label class="form-label-dark">お問い合わせ内容</label>
                        <textarea
                            name="message"
                            rows="6"
                            class="textarea-common"
                            required
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="actions-row-sm">
                        <a href="{{ route('product.index') }}" class="button-gray">
                            戻る
                        </a>

                        <button type="submit" class="button-blue">
                            送信
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>