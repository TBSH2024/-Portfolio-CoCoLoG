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
        // ログインユーザーを取得
        $user = Auth::user();

        // 過去1週間の体調データを取得
        $wellnessLogs = WellnessLog::where('user_id', $user->id)
            ->orderBy('input_date', 'desc')
            ->take(5)
            ->get();

        // 過去1週間のクライシスプランログを取得
        $crisisPlanLogs = CrisisPlanLog::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 健康状態の推移用データ
        $logs = WellnessLog::where('user_id', $user->id)
            ->whereDate('input_date', '>=', Carbon::now()->subWeek())
            ->get();

        // ラベル（日付）とスコアを取得
        $labels = $logs->pluck('input_date')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        });

        $scores = $logs->pluck('score');

        return view('dashboard', [
            'wellnessLogs' => $wellnessLogs,
            'crisisPlanLogs' => $crisisPlanLogs,
            'labels' => $labels,
            'scores' => $scores,
        ]);
    }
}
