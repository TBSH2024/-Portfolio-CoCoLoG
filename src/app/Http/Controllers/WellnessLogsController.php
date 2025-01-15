<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $logsByMonth = WellnessLog::groupByMonth($this->user->id)
            ->paginate(5);

        $logsByDay = WellnessLog::where('user_id', $this->user->id)
            ->whereMonth('input_date', now()->month)
            ->get();

        $convertedItems = ConvertLogsService::convertItems($logsByDay);

        $logsByDay = $logsByDay->map(function ($log) use ($convertedItems) {
            $convertedItem = $convertedItems->firstWhere('input_date', $log->input_date);
            $log->convertedMood = $convertedItem->convertedMood ?? '不明';
            $log->convertedEnergy = $convertedItem->convertedEnergy ?? '不明';
            $log->convertedSleep = $convertedItem->convertedSleep ?? '不明';
            return $log;
        });

        return view('wellness.index', compact('user', 'logsByMonth', 'logsByDay', 'convertedItems'));
    }


    public function create()
    {
        $wellnessLog = wellnessLog::where('user_id', $this->user->id)
        ->where('input_date', now()->toDateString())
        ->first();

        return view('wellness.create', compact('wellnessLog'));
    }

    public function store(Request $request) {
        $request->validate([
            'input_date' => ['required', 'date'],
            'mood' => ['required', 'integer'],
            'energy_level' => ['required', 'integer'],
            'sleep_quality' => ['required', 'integer'],
            'comments' => ['nullable', 'string', 'max:200'],
        ]);

        WellnessLog::create([
            'user_id' => $this->user->id,
            'input_date' => $request->input_date,
            'mood' => $request->mood,
            'energy_level' => $request->energy_level,
            'sleep_quality' => $request->sleep_quality,
            'comments' => $request->comments,
        ]);

        return to_route('dashboard');
    }

    public function edit(string $id)
    {
        $wellnessLog = WellnessLog::where('user_id', $this->user->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('wellness.edit', compact('wellnessLog'));
    }

    public function update(Request $request, $id)
    {
        $wellnessLog = WellnessLog::where('user_id', $this->user->id)
        ->where('id', $id)
        ->firstOrFail();

        $validated = $request->validate([
            'input_date' => ['required', 'date'],
            'mood' => ['required', 'integer'],
            'energy_level' => ['required', 'integer'],
            'sleep_quality' => ['required', 'integer'],
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

        return to_route('wellness.index');
    }
}