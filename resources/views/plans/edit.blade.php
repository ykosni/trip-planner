@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">プラン編集</h1>

    <form action="{{ route('plans.update', $plan) }}" method="POST" class="max-w-lg">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">タイトル</label>
            <input type="text" name="title" id="title" value="{{ $plan->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="outline" class="block text-gray-700 text-sm font-bold mb-2">概要</label>
            <textarea name="outline" id="outline" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $plan->outline }}</textarea>
        </div>

        <div class="mb-4">
            <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">開始日</label>
            <input type="date" name="start_date" id="start_date" value="{{ $plan->start_date->format('Y-m-d') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">終了日</label>
            <input type="date" name="end_date" id="end_date" value="{{ $plan->end_date->format('Y-m-d') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                次へ（アクティビティ編集）
            </button>
            <a href="{{ route('plans.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                キャンセル
            </a>
        </div>
    </form>
</div>
@endsection
