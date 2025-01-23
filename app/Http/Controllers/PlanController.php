<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller

{
    public function index()
    {
        $plans = Plan::all();
        return view('plans.index', compact('plans'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'outline' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            //バリデーションルール
        ]);

        $plan = new Plan($validatedData);
        $plan->user_id = auth()->id();
        $plan->save();
        
        $activities = [['content' => '', 'date' => '', 'time' => '', 'place' => '']];
    return view('activities.create', compact('plan', 'activities'));
    }
        

    
    
    public function show(Plan $plan)
    {
        $activities = $plan->activities()->orderBy('order_number')->get();
        return view('plans.show', compact('plan', 'activities'));
    }

    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'outline' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]); 

        $plan->update($validatedData);

        return redirect()->route('activities.edit', ['plan'=>$plan->id]);
    }


    public function destroy($id)
    {
        
        $plan = Plan::findOrFail($id);
        if (\Auth::id() === $plan->user_id) {
            $plan->delete();
            return redirect()->route('plans.index')->with('success', 'プランが削除されました');
        }
        
        return redirect()->route('plans.index')->with('error', '削除する権限がありません');
    }
}
