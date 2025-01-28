@extends('layouts.app')

@section('title', $plan->title)

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">{{ $plan->title }}</h1>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">プラン詳細</h2>
            <p><strong>概要:</strong> {{ $plan->outline }}</p>
            <p><strong>開始日:</strong> {{ $plan->start_date->format('Y年m月d日') }}</p>
            <p><strong>終了日:</strong> {{ $plan->end_date->format('Y年m月d日') }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">アクティビティ</h2>
            @if($activities->isNotEmpty())
                @foreach($activities as $activity)
                    <div class="border-b py-2">
                        <p><strong>{{ $activity->datetime }}</strong></p>
                        <p>{{ $activity->content }}</p>
                        <p>場所: {{ $activity->place }}</p>
                    </div>
                @endforeach
            @else
                <p>アクティビティはまだありません。</p>
            @endif
        </div>
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('plans.edit', $plan) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            プランを編集
        </a>
        <a href="{{ route('plans.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            プラン一覧に戻る
        </a>
    </div>
</div>
@endsection
