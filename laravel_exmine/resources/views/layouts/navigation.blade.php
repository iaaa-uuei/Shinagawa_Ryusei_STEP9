<nav class="nav-shell">
    <div class="nav-inner">
        <div class="nav-logo">
            Cytech EC
        </div>

        <div class="nav-menu">
            <a href="{{ route('product.index') }}" class="link-nav">
                Home
            </a>

            <a href="{{ route('mypage.index') }}" class="link-nav">
                マイページ
            </a>

            <span class="nav-user">
                ログインユーザー： {{ Auth::user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}" class="nav-inline">
                @csrf
                <button type="submit" class="button-red-hover">
                    ログアウト
                </button>
            </form>
        </div>
    </div>
</nav>