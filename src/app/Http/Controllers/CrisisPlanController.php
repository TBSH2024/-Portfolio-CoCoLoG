<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CrisisPlan;

class CrisisPlanController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        $crisisPlan = CrisisPlan::where('user_id', $user->id)->first();

        return view('crisisPlan.create', compact('user', 'crisisPlan'));
    }

    public function store(Request $request)
    {

        $existingPlan = CrisisPlan::where('user_id', Auth::id())->exists();
        if ($existingPlan) {
            return to_route('crisis_plan.create');
        }

        $request->validate([
            'good_actions' => ['array', 'max:5', 'min:1'],
            'neutral_actions' => ['array', 'max:5', 'min:1'],
            'bad_actions' => ['array', 'max:5', 'min:1'],
        ]);

        CrisisPlan::create([
            'user_id' => Auth::id(),
            'good_actions' => $request->good_actions,
            'neutral_actions' => $request->neutral_actions,
            'bad_actions' => $request->bad_actions,
        ]);

        return to_route('dashboard')->with('success', 'クライシスプランを作成しました。');
    }

    public function edit(string $id)
    {
        $user = Auth::user();

        $crisisPlan = CrisisPlan::where('user_id', $user->id)->first();

        return view('crisisPlan.edit', compact('user', 'crisisPlan'));
    }

    public function update(Request $request, $id)
    {
        $crisisPlan = CrisisPlan::findOrFail($id);

        $request->validate([
            'good_actions' => ['array', 'max:5', 'min:1'],
            'neutral_actions' => ['array', 'max:5', 'min:1'],
            'bad_actions' => ['array', 'max:5', 'min:1'],
        ]);

        $crisisPlan->update([
            'good_actions' => $request->good_actions,
            'neutral_actions' => $request->neutral_actions,
            'bad_actions' => $request->bad_actions,
        ]);

        return to_route('dashboard')->with('success', 'クライシスプランを更新しました。');
    }

    public function destroy($id)
    {
        $crisisPlan = CrisisPlan::findOrFail($id);

        $crisisPlan->delete();

        return to_route('dashboard')->with('danger', 'クライシスプランを削除しました。');
    }
}
