@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">新規アクティビティ作成</h2>
    <form action="{{ route('activities.store', ['plan'=>$plan] ) }}" method="POST">
        @csrf
        <input type="hidden" name="plan_id" value="{{ $plan }}">
        
        @foreach($activities as $index => $activity)
            <div class="activity-input bg-gray-100 p-6 rounded-lg shadow">
                <h3>アクティビティ {{ $index + 1 }}</h3>
                <div>
                    <label for="datetime[{{ $index }}]">日時</label>
                    <input type="datetime-local" name="datetime[{{ $index }}]" value="{{ $activity['datetime'] ? date('Y-m-d\TH:i', strtotime($activity['datetime'])) : '' }}">
                </div>
                <div>
                    <label for="content[{{ $index }}]">内容</label>
                    <input type="text" name="content[{{ $index }}]" value="{{ $activity['content'] }}">
                </div>
                <div>
                    <label for="place[{{ $index }}]">場所</label>
                    <input type="text" name="place[{{ $index }}]" value="{{ $activity['place'] }}">
                </div>
            </div>
        @endforeach

        <button type="submit" name="action" value="add">[＋]追加</button>
        <button type="submit" name="action" value="save">保存してプラン一覧へ戻る</button>
        
    </form>
</div>
@endsection
