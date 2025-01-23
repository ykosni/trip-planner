<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Plan;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    
    public function index()
    {
        $activities = Activity::orderBy('order_number')->get();
        return view('activities.index', compact('activities'));
    }

    public function create(Plan $plan)
    {
        $activities = $plan->activities()->orderBy('order_number')->get();
        return view('activities.create', compact('plan', 'activities'));
    }

    
    
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'content' => 'array',
            'content.*' => 'nullable|string',
            'date' => 'array',
            'date.*' => 'nullable|date',
            'time' => 'array',
            'time.*' => 'nullable|date_format:H:i',
            'place' => 'array',
            'place.*' => 'nullable|string',
        ]);

        $plan = Plan::findOrFail($validatedData['plan_id']);

        $activities = [];
        foreach ($validatedData['content'] as $index => $content) {
            $activities[] = [
                'content' => $content,
                'date' => $validatedData['date'][$index],
                'time' => $validatedData['time'][$index],
                'place' => $validatedData['place'][$index],
            ];
        }

        if ($request->input('action') === 'add') {
            $activities[] = ['content' => '', 'date' => '', 'time' => '', 'place' => '']; // 新しい空のフォーム
            return view('activities.create', compact('plan', 'activities'));
        }

        // データベースへの保存処理
        foreach ($activities as $activityData) {
            if (!empty($activityData['content'])) {
                $maxOrderNumber = Activity::where('plan_id', $plan->id)->max('order_number') ?? 0;
                $activity = new Activity($activityData);
                $activity->order_number = $maxOrderNumber + 1;
                $plan->activities()->save($activity);
            }
        }

        return redirect()->route('plans.index');
    }


    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    public function edit($planId)
    {
        $plan = Plan::findOrFail($planId);
        return view('activities.edit', ['plan' => $plan]);
    }
    

    public function update(Request $request)
    {
        //$requestの中に、複数のactivitiesがある為、それぞれをバリデーションさせる
        $validatedData = $request->validate([
            'activities' => 'required|array',
            'activities.*.id' => 'required|exists:activities,id',
            'activities.*.date' => 'required|date',
            'activities.*.content' => 'required|max:255',
            'activities.*.time' => 'required',
            'activities.*.place' => 'required|max:255',
        ]);

        //各アクティビティのデータをupdate処理
        foreach ($validatedData['activities'] as $activityData) {
            $activity = Activity::findOrFail($activityData['id']);
            $activity->update($activityData);
        }

        // ※すべてのアクティビティが同じプランに属していると仮定する
        //バリデーション済のデータから最初のアクティビティのIDを取得
            $firstActivityId = $validatedData['activities'][0]['id'];
        //そのIDを使ってデータベースからActivityレコードを取得
            $activity = Activity::findOrFail($firstActivityId);
        //取得したActivityレコードから関連するプランのIDを取得
            $planId = $activity->plan_id;
        
        return redirect()->route('plans.show', ['plan' => $planId]);
    }


    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index');
    }
}
