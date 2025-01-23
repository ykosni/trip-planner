@if (Auth::check())
    {{-- プラン一覧ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('plans.index') }}">プラン一覧</a></li>
    {{-- 新規プラン作成ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('plans.create') }}">新規プラン</a></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
@else
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">ログイン</a></li>
    {{-- ユーザー登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">会員登録</a></li>

@endif