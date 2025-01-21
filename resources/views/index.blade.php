@extends('layouts.app')

@section('content')

<div class="flex flex-col items-center">
  @if (Auth::check())
                ログインされていたら、プラン一覧を表示
  @else
  <!-- ページタイトル -->
  <div class="prose hero mx-auto max-w-full rounded w-full">
    <div class="hero-content text-center my-10">
      <div class="max-w-md">
        <h2>Welcome to</h2>
        <h1>Trip Planner</h1>
        <svg  xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-luggage"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" /><path d="M9 6v-1a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1" /><path d="M6 10h12" /><path d="M6 16h12" /><path d="M9 20v1" /><path d="M15 20v1" /></svg>
      </div>
    </div>
  </div>
  
  <!-- ログイン画面と会員登録リンク -->
  <div class="flex justify-center items-center h-screen">
    <div class="flex gap-4">
      <a class="btn btn-primary btn-lg normal-case" href="{{ route('login') }}">ログインはこちら</a>
      <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">会員登録はこちら（無料）</a>
    </div>
  </div>

  @endif
  
</div>
    
@endsection