@extends('layouts.app')

@section('content')
<div class="container">
    <h2>新規アクティビティ作成</h2>
    <form action="{{ route('activities.store')}}" method="POST">
        @csrf
        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
        
        @foreach($activities as $index => $activity)
            <div class="activity-input">
                <h3>アクティビティ {{ $index + 1 }}</h3>
                <div>
                    <label for="content[{{ $index }}]">内容</label>
                    <input type="text" name="content[{{ $index }}]" value="{{ $activity['content'] ?? '' }}">
                </div>
                <div>
                    <label for="date[{{ $index }}]">日付</label>
                    <input type="date" name="date[{{ $index }}]" value="{{ $activity['date'] ?? '' }}">
                </div>
                <div>
                    <label for="time[{{ $index }}]">時間</label>
                    <input type="time" name="time[{{ $index }}]" value="{{ $activity['time'] ?? '' }}">
                </div>
                <div>
                    <label for="place[{{ $index }}]">場所</label>
                    <input type="text" name="place[{{ $index }}]" value="{{ $activity['place'] ?? '' }}">
                </div>
            </div>
        @endforeach

        <button type="submit" name="action" value="add">＋</button>
        <button type="submit" name="action" value="save">保存してプラン一覧へ戻る</button>
    </form>
</div>
@endsection
