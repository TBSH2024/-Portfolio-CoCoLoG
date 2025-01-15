<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CrisisPlanLog;
use App\Models\CrisisPlan;
use Carbon\Carbon;

class CrisisPlanLogsController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        $user = $this->user;

        $logsByMonth = CrisisPlanLog::groupByMonth($this->user->id)
            ->paginate(5);

        $logsByDay = CrisisPlanLog::where('user_id', $this->user->id)
            ->whereMonth('input_date', now()->month)
            ->get();

        $crisisPlanTable = CrisisPlan::where('user_id', $this->user->id)
            ->first();

        return view('crisisPlanLogs.index', compact('user', 'logsByMonth', 'logsByDay', 'crisisPlanTable'));
    }

    public function create()
    {
        $user = $this->user;

        $crisisPlanLog = CrisisPlanLog::where('user_id', $user->id)
        ->where('input_date', now()->toDateString())
        ->first();

        $crisisPlanTable = CrisisPlan::where('user_id', $user->id)->first();

        return view('crisisPlanLogs.create', compact('user', 'crisisPlanLog', 'crisisPlanTable'));
    }

    public function store(Request $request)
    {
        $user = $this->user;

        $validated = $request->validate([
            'input_date' => ['required', 'date'],
            'good_actions' => ['array', 'nullable'],
            'neutral_actions' => ['array', 'nullable'],
            'bad_actions' => ['array', 'nullable'],
        ]);

        $crisisPlanId = CrisisPlan::where('user_id', $user->id)->firstOrFail()->id;
        $inputDate = $validated['input_date'];

        $crisisPlanLog = CrisisPlanLog::create([
            'user_id' => $user->id,
            'crisis_plan_id' => $crisisPlanId,
            'input_date' => $inputDate,
            'good_actions' => $validated['good_actions'] ?? [],
            'neutral_actions' => $validated['neutral_actions'] ?? [],
            'bad_actions' => $validated['bad_actions'] ?? [],
        ]);

        return to_route('dashboard')->with('success', 'データが保存されました。');
    }

    public function edit($id)
    {
        $user = $this->user;

        $crisisPlanLog = CrisisPlanLog::where('user_id', $user->id)->where('id', $id)->firstOrFail();
        $formattedDate = Carbon::parse($crisisPlanLog->input_date)->format('n月j日');

        $crisisPlanTable = CrisisPlan::where('user_id', $user->id)->first();

        return view('crisisPlanLogs.edit', compact('user', 'crisisPlanLog', 'formattedDate', 'crisisPlanTable'));
    }

    public function update(Request $request, $id)
    {
        $crisisPlanLog = CrisisPlanLog::where('user_id', $this->user->id)
            ->where('id', $id)
            ->firstOrFail();

        $validated = $request->validate([
            'input_date' => ['required', 'date'],
            'good_actions' => ['array', 'nullable'],
            'neutral_actions' => ['array', 'nullable'],
            'bad_actions' => ['array', 'nullable'],
        ]);

        $crisisPlanLog->update($validated);

        return to_route('logs.index')->with('success', 'データを更新しました。');
    }

    public function destroy($id)
    {
        $crisisPlanLog = CrisisPlanLog::where('user_id', $this->user->id)
            ->where('id', $id)
            ->firstOrFail();

        $crisisPlanLog->delete();

        return to_route('logs.index')->with('danger', 'データを削除しました。');
    }
}