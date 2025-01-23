@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">アクティビティ編集</h1>

    <form action="{{ route('activities.update', $plan) }}" method="POST">
        @csrf
        @method('PUT')
        
        @foreach($plan->activities as $index => $activity)
            <div class="mb-6 p-4 border rounded">
                <h2 class="text-xl font-semibold mb-2">アクティビティ {{ $index + 1 }}</h2>
                <input type="hidden" name="activities[{{ $index }}][id]" value="{{ $activity->id }}">
                
                <div class="mb-4">
                    <label for="activities[{{ $index }}][content]" class="block text-gray-700 text-sm font-bold mb-2">内容</label>
                    <input type="text" name="activities[{{ $index }}][content]" id="activities[{{ $index }}][content]" value="{{ $activity->content }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="activities[{{ $index }}][date]" class="block text-gray-700 text-sm font-bold mb-2">日付</label>
                    <input type="date" name="activities[{{ $index }}][date]" id="activities[{{ $index }}][date]" value="{{ $activity->date->format('Y-m-d') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="activities[{{ $index }}][time]" class="block text-gray-700 text-sm font-bold mb-2">時間</label>
                    <input type="time" name="activities[{{ $index }}][time]" id="activities[{{ $index }}][time]" value="{{ $activity->time->format('H:i') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="activities[{{ $index }}][place]" class="block text-gray-700 text-sm font-bold mb-2">場所</label>
                    <input type="text" name="activities[{{ $index }}][place]" id="activities[{{ $index }}][place]" value="{{ $activity->place }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
        @endforeach

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                保存
            </button>
        </div>
    </form>
</div>
@endsection
