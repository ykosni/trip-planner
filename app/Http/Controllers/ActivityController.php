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
        return view('activities.index', ['activities'=>$activities]);
    }

    public function create($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        $activities = Activity::where('plan_id', $plan_id)->orderBy('order_number')->get();
        return view('activities.create', [
            'plan' => $plan,
            'activities' => $activities
        ]);
    }

    
    
    

    public function store(Request $request, Plan $plan)
    {
        //dd($request->all());
        
        
        //$リクエストのデータが正しいのか確認する
        $validatedData = $request->validate([
            'content' => 'array',
            'content.*' => 'nullable|string',
            'datetime' => 'array',
            'datetime.*' => 'nullable|date_format:Y-m-d\TH:i',
            'place' => 'array',
            'place.*' => 'nullable|string',
        ]);

        //入力済のアクティビティのデータを$activitiesに配列として保存する
        //$activitiesの空の配列を作り、
        $activities = [];
        //$contentの$index番号に対して、ループをおこなう
        foreach ($validatedData['content'] as $index => $content) {
            //アクティビティ情報を連想配列として作成し、$indexに対応するcontent、datetime、placeを$activitiesの中に保存する
            $activities[] = [
                'content' => $content,
                'datetime' => $validatedData['datetime'][$index],
                'place' => $validatedData['place'][$index],
            ];
        }
        
        //「＋」ボタンを押された場合、空のフォームを持って、アクティビティ作成画面（activities.create）に移動する
        if ($request->input('action') === 'add') {
            $activities[] = ['content' => '', 'datetime' => '', 'place' => '']; // 新しい空のフォームを作って、activitiesに入れる
            return view('activities.create', [
                'plan' => $plan,
                'activities' => $activities
            ]);
        }

        //「保存して一覧へ戻る」ボタンを押された場合、これまで$activitiesに保存した配列をサーバーに保存してプラン一覧（plan.index）に戻る

        // アクティビティを保存
            foreach ($validatedData['content'] as $index => $content) {
                if (!empty($content)) {
                    $activity = new Activity([
                        'content' => $content,
                        'datetime' => $validatedData['datetime'][$index],
                        'place' => $validatedData['place'][$index],
                    ]);
                    $plan->activities()->save($activity);
                }
            }

                return redirect()->route('plans.index');
    }


    public function show(Activity $activity)
    {
        return view('activities.show', ['activity'=>$activity]);
    }


    public function edit($planId)
    {
        $plan = Plan::findOrFail($planId);
        $activities = $plan->activities()->orderBy('datetime')->get();
        return view('activities.edit', [
            'plan' => $plan,
            'activities' => $activities
            ]);
    }
    

    public function update(Request $request, $planId)
    {
        //dd($request->all());
        
        $plan = Plan::findOrFail($planId);
        
        //$リクエストのデータが正しいのか確認する
        $validatedData = $request->validate([
            'content' => 'array',
            'content.*' => 'nullable|string',
            'datetime' => 'array',
            'datetime.*' => 'nullable|date_format:Y-m-d\TH:i',
            'place' => 'array',
            'place.*' => 'nullable|string',
            'id' => 'array'
        ]);
        
        //dd($validatedData);

        //入力済のアクティビティのデータを$activitiesに配列として保存する
        //$activitiesの空の配列を作り、
        $activities = [];
        //$contentの$index番号に対して、ループをおこなう
        foreach ($validatedData['content'] as $index => $content) {
            //アクティビティ情報を連想配列として作成し、$indexに対応するcontent、datetime、place、idを$activitiesの中に保存する
            $activities[] = [
                'content' => $content,
                'datetime' => $validatedData['datetime'][$index],
                'place' => $validatedData['place'][$index],
                'id' => $validatedData['id'][$index]
            ];
            
        }
        
        //dd($activities);
        
        //「＋」ボタンを押された場合、空のフォームを持って、アクティビティ作成画面（activities.create）に移動する
        if ($request->input('action') === 'add') {
            $activities[] = ['content' => '', 'datetime' => '', 'place' => '']; // 新しい空のフォームを作って、activitiesに入れる
            return view('activities.edit', [
                'plan' => $plan,
                'activities' => $activities
            ]);
        }

        //「保存して一覧へ戻る」ボタンを押された場合、これまで$activitiesに保存した配列をサーバーに保存してプラン一覧（plan.index）に戻る

        // バリデーションしたアクティビティデータを保存
            foreach ($validatedData['content'] as $index => $content) {
                
                //もし$contentが空でなければ（＝入力済なら）以下の処理を実施
                if (!empty($content)) {
                    //もし$validatedDataの'id’が空なら、
                    if (!empty($validatedData['id'][$index])){
                        $activity = [
                            'plan_id' => $planId,
                            'content' => $content,
                            'datetime' => $validatedData['datetime'][$index],
                            'place' => $validatedData['place'][$index],
                            'id' => $validatedData['id'][$index]
                        ];
                    }
                    else {
                        $activity = [
                            'plan_id' => $planId,
                            'content' => $content,
                            'datetime' => $validatedData['datetime'][$index],
                            'place' => $validatedData['place'][$index]
                        ];
                    }
                    
                    $plan->activities()->upsert($activity, ['id']);
                    
                }
            }

                return redirect()->route('plans.index');
    }


    public function destroy($planId, $activityId)
    {
        $plan = Plan::findOrFail($planId);
        $activity = Activity::findOrFail($activityId);
        $activities = $plan->activities()->orderBy('datetime')->get();
        $activity->delete();

        return redirect()->route('activities.edit', ['plan' => $planId]);
    }
}
