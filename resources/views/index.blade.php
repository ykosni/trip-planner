@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center">
  <!-- ページタイトル -->
  <div class="prose hero bg-base-200 mx-auto max-w-full rounded w-full">
    <div class="hero-content text-center my-10">
      <div class="max-w-md">
        <h2>Welcome to</h2>
        <h1>Trip Planner</h1>
      </div>
    </div>
  </div>

  <!-- ログイン画面と会員登録リンク -->
  <div class="mx-auto max-w-full rounded w-full">
    <div class="flex flex-col items-center">
      <div class="max-w-md my-10">
        {{-- ログイン画面をインクルードする --}}
        ＜＜ログイン画面インクルード表示部分＞＞
      </div>
      
      <div class="max-w-md my-10">
        {{-- ユーザー登録ページへのリンク --}}
        <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">会員登録はこちら！（無料）</a>
      </div>
    </div>
  </div>
</div>

    
@endsection