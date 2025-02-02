@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">新規アクティビティ編集</h2>
    <form action="{{ route('activities.update', ['plan'=>$plan] ) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="plan_id" value="{{ $plan }}">
        
        @foreach($activities as $index => $activity)
            <div class="activity-input bg-gray-100 p-4 rounded-lg shadow my-4">
                <!--$activity['id']が存在するか確認し、存在しなければ、idに空のボックスを作る-->
                <input type="hidden" name="id[{{ $index }}]" value="{{ $activity['id'] ?? '' }}">

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

        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded" name="action" value="add">[＋]追加</button>
        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded" name="action" value="save">保存してプラン一覧へ戻る</button>
        
    </form>

        <!-- 削除ボタンをここに追加 -->    
        @foreach($activities as $activity)
            @if(isset($activity['id']))
            <form action="{{ route('activities.destroy',['plan' => $plan->id, 'activity' => $activity['id']]) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('このアクティビティを削除しますか？')">
                        アクティビティ {{ $loop->iteration }} を削除
                    </button>
                </form>
            @endif
        @endforeach 

</div>

@endsection
