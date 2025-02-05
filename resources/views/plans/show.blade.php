@php
use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('title', $plan->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">{{ $plan->title }}</h1>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
        <div class="bg-blue-600 text-white py-3 px-4">
            <h2 class="text-xl font-semibold">プラン詳細</h2>
        </div>
        <div class="p-4">
            <p class="mb-2"><span class="font-semibold text-gray-700">概要:</span> {{ $plan->outline }}</p>
            <p class="mb-2"><span class="font-semibold text-gray-700">開始日:</span> {{ $plan->start_date->format('Y年m月d日') }}</p>
            <p><span class="font-semibold text-gray-700">終了日:</span> {{ $plan->end_date->format('Y年m月d日') }}</p>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-blue-600 text-white py-3 px-4">
            <h2 class="text-xl font-semibold">アクティビティ</h2>
        </div>
        <div class="p-4 relative">
            @if($activities->isNotEmpty())
                <div class="absolute left-[1.3125rem] top-0 bottom-0 w-0.5 bg-gray-300"></div>
                @foreach($activities as $activity)
                    <div class="flex items-start mb-4 relative">
                        <div class="rounded-full bg-blue-500 w-3 h-3 mt-1.5 mr-4 flex-shrink-0 z-10"></div>
                        <div class="flex-grow">
                            <div class="flex items-center mb-2">
                                <div class="flex items-center mr-4">
                                    <p class="text-blue-600">{{ Carbon::parse($activity->datetime)->format('n/j　') }}</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-blue-600">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <p class="font-semibold text-blue-600">{{ Carbon::parse($activity->datetime)->format('H:i') }}</p>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <p class="text-gray-600">{{ $activity->place }}</p>
                                </div>
                            </div>
                            <p class="mt-1 font-bold">{{ $activity->content }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-600 italic">アクティビティはまだありません。</p>
            @endif
        </div>
    </div>

    <div class="mt-8 flex space-x-4">
        @if(Auth::check() && Auth::id() == $plan->user_id)
            <a href="{{ route('plans.edit', $plan) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                プランを編集
            </a>
        @endif
        <a href="{{ route('plans.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-300">
            プラン一覧に戻る
        </a>
    </div>
</div>
@endsection
