@extends('layouts.app')

@section('title', '旅行プラン一覧')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">旅行プラン一覧</h1>

    <a href="{{ route('plans.create') }}" class="btn btn-primary mb-4">
        新規プラン作成
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">


        @foreach($plans as $plan)
        <div class="card border rounded-lg p-4">
            <h2 class="text-xl font-semibold mb-2">{{ $plan->title }}</h2>
            <p>旅行期間: {{ $plan->start_date }} 〜 {{ $plan->end_date }}</p>
            <div class="mt-4">
                <a href="{{ route('plans.show', $plan) }}" class="btn btn-sm btn-outline">詳細</a>
                <a href="{{ route('plans.edit', $plan) }}" class="btn btn-sm btn-outline">編集</a>
                <form method="POST" action="{{ route('plans.destroy', $plan->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-sm normal-case" 
                    onclick="return confirm('このプランを削除しますか?')">削除</button>
                </form>
            </div>
            
        </div>
        @endforeach
    </div>
</div>
@endsection
