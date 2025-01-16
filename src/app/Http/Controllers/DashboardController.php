<?php

namespace App\Http\Controllers;

use App\Models\WellnessLog;
use App\Models\CrisisPlanLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $startDate = Carbon::now()->subDays(6)->startOfDay();
    $endDate = Carbon::now()->endOfDay();

    $wellnessLogs = WellnessLog::where('user_id', $user->id)
        ->whereBetween('input_date', [$startDate, $endDate])
        ->get()
        ->mapWithKeys(function ($log) {
            $date = Carbon::parse($log->input_date)->format('Y-m-d');
            return [$date => $log];
        });

    $crisisPlanLogs = CrisisPlanLog::where('user_id', $user->id)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->map(function ($log) {
        $log->status = $log->input_date ? '入力済' : '未入力';
        return $log;
    })
    ->groupBy(function ($log) {
        return Carbon::parse($log->created_at)->format('Y-m-d');
    });

    $logs = collect();
    foreach (range(0, 6) as $day) {
        $date = Carbon::now()->subDays($day)->format('Y-m-d');
        $logs->push([
            'date' => $date,
            'wellness' => $wellnessLogs->get($date) ?? null,
            'crisis' => optional($crisisPlanLogs->get($date))->first(),
        ]);
    }

    return view('dashboard', [
        'logs' => $logs->sortBy('date'),
    ]);
}



}
