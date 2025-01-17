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

        $validated = $request->validate([
            'good_actions' => ['required', 'array', 'min:1', 'max:5'],
            'neutral_actions' => ['required', 'array', 'min:1', 'max:5'],
            'bad_actions' => ['required', 'array', 'min:1', 'max:5'],
        ]);

        $errors = [];

        if (!$this->hasAtLeastOneNonEmpty($validated['good_actions'])) {
            $errors['good_actions'] = 'この項目は最低1つは入力してください。';
        }
        if (!$this->hasAtLeastOneNonEmpty($validated['neutral_actions'])) {
            $errors['neutral_actions'] = 'この項目は最低1つは入力してください。';
        }
        if (!$this->hasAtLeastOneNonEmpty($validated['bad_actions'])) {
            $errors['bad_actions'] = 'この項目は最低1つは入力してください。';
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        CrisisPlan::create([
            'user_id' => Auth::id(),
            'good_actions' => array_filter($validated['good_actions'], fn($value) => !empty($value)),
            'neutral_actions' => array_filter($validated['neutral_actions'], fn($value) => !empty($value)),
            'bad_actions' => array_filter($validated['bad_actions'], fn($value) => !empty($value)),
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

    private function hasAtLeastOneNonEmpty(array $actions): bool
    {
        foreach ($actions as $action) {
            if (!empty($action)) {
                return true;
            }
        }
        return false;
    }
}
