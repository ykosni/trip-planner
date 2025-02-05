@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-8 text-center">新規アクティビティ編集</h2>
    <form action="{{ route('activities.update', ['plan' => $plan]) }}" method="POST" class="space-y-6">
        @method('PUT')
        @csrf
        <input type="hidden" name="plan_id" value="{{ $plan }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($activities as $index => $activity)
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <input type="hidden" name="id[{{ $index }}]" value="{{ $activity['id'] ?? '' }}">

                    <h3 class="text-xl font-semibold mb-4">アクティビティ {{ $index + 1 }}</h3>
                    <div class="mb-4">
                        <label for="datetime[{{ $index }}]" class="block text-gray-700 font-medium mb-1">日時</label>
                        <input type="datetime-local" name="datetime[{{ $index }}]" value="{{ $activity['datetime'] ? date('Y-m-d\TH:i', strtotime($activity['datetime'])) : '' }}" class="w-full p-2 border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="content[{{ $index }}]" class="block text-gray-700 font-medium mb-1">内容</label>
                        <input type="text" name="content[{{ $index }}]" value="{{ $activity['content'] }}" class="w-full p-2 border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="place[{{ $index }}]" class="block text-gray-700 font-medium mb-1">場所</label>
                        <input type="text" name="place[{{ $index }}]" value="{{ $activity['place'] }}" class="w-full p-2 border rounded-md">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-end space-x-4 mt-8">
            <button type="submit" name="action" value="add" class="bg-blue-500 hover:bg-blue-700 font-bold text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">[＋] 追加</button>
            <button type="submit" name="action" value="save" class="bg-blue-500 hover:bg-blue-700 font-bold text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">保存してプラン一覧へ戻る</button>
        </div>
    </form>

    @foreach($activities as $activity)
        @if(isset($activity['id']))
            <form action="{{ route('activities.destroy', ['plan' => $plan->id, 'activity' => $activity['id']]) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="return confirm('このアクティビティを削除しますか？')">
                    アクティビティ {{ $loop->iteration }} を削除
                </button>
            </form>
        @endif
    @endforeach

</div>

@endsection
