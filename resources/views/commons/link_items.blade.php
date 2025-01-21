@if (Auth::check())

    {{-- ユーザー名の表示 --}}
    <li>{{ Auth::user()->name }}さん</li>
 

    {{-- プラン一覧ページへのリンク --}}
    <li><a class="link link-hover" href="#">プラン一覧</a></li>
    {{-- 新規プラン作成ページへのリンク --}}
    <li><a class="link link-hover" href="#">新規プラン</a></li>
    
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
@else
    {{-- ユーザー登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">会員登録</a></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">ログイン</a></li>
@endif