<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\WellnessLog;
use App\Services\ConvertLogsService;

class WellnessLogsController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        $user = $this->user;

        // 月ごとのログをグループ化し、ページネーションを適用
        $logsByMonth = WellnessLog::where('user_id', $this->user->id)
            ->select(DB::raw("EXTRACT(YEAR FROM input_date) as year"), DB::raw("EXTRACT(MONTH FROM input_date) as month"))
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->paginate(1);

        $logsByDay = WellnessLog::where('user_id', $this->user->id)
        ->whereMonth('input_date', now()->month)
        ->orderBy('input_date', 'desc')
        ->get();

        // 変換データを取得
        $convertedItems = ConvertLogsService::convertItems($logsByDay);

        //　ログに変換データを追加
        $logsByDay = $logsByDay->map(function ($log) use ($convertedItems) {
            $convertedItem = $convertedItems->firstWhere('input_date', $log->input_date);
            $log->convertedMood = $convertedItem->convertedMood ?? '不明';
            $log->convertedEnergy = $convertedItem->convertedEnergy ?? '不明';
            $log->convertedSleep = $convertedItem->convertedSleep ?? '不明';
            return $log;
        });

        $convertedItems = ConvertLogsService::convertItems($logsByDay);

        return view('wellness.index', compact('user', 'logsByMonth', 'logsByDay', 'convertedItems'));
    }


    public function create()
    {
        $wellnessLog = WellnessLog::where('user_id', $this->user->id)
        ->where('input_date', today())->first();

        return view('wellness.create', compact('wellnessLog'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'input_date' => ['required', 'date'],
            'energy_level' => ['required', 'integer'],
            'sleep_quality' => ['required', 'integer'],
            'mood' => ['required', 'integer'],
            'score' => ['required', 'integer', 'between:1,5'],
            'comments' => ['nullable', 'string', 'max:200'],
        ]);

        $existingLog = WellnessLog::where('user_id', $this->user->id)
        ->where('input_date', $validated['input_date'])
        ->first();
        
        if ($existingLog) {
            return redirect()->back()->with('danger', 'この日付は既に登録されています')
                ->withInput();
        }

        $create = WellnessLog::create([
            'user_id' => $this->user->id,
            'input_date' => $validated['input_date'],
            'energy_level' => $validated['energy_level'],
            'sleep_quality' => $validated['sleep_quality'],
            'mood' => $validated['mood'],
            'score' => $validated['score'],
            'comments' => $validated['comments'],
        ]);


        return to_route('dashboard')->with('success', '今日の体調を記録しました。');
    }

    public function edit(string $id)
    {
        $wellnessLog = WellnessLog::where('user_id', $this->user->id)
            ->where('id', $id)
            ->first();

        return view('wellness.edit', compact('wellnessLog'));
    }

    public function update(Request $request, $id)
    {
        $wellnessLog = WellnessLog::where('user_id', $this->user->id)
            ->where('id', $id)
            ->firstOrFail();

        $validated = $request->validate([
            'input_date' => ['required', 'date'],
            'energy_level' => ['required', 'integer'],
            'sleep_quality' => ['required', 'integer'],
            'mood' => ['required', 'integer'],
            'score' => ['required', 'integer', 'between:1,5'],
            'comments' => ['nullable', 'string', 'max:200'],
        ]);

        $wellnessLog->update($validated);

        return to_route('wellness.index')->with('success', 'データを更新しました。');
    }

    public function destroy($id)
    {
        $wellnessLog = WellnessLog::where('user_id', $this->user->id)
        ->where('id', $id)
        ->firstOrFail();

        $wellnessLog->delete();

        return to_route('wellness.index')->with('danger', 'データを削除しました。');
    }
}