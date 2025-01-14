<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CrisisPlan;

class CrisisPlanLog extends Model
{
    protected $fillable = [
        'user_id',
        'crisis_plan_id',
        'input_date',
        'good_actions',
        'neutral_actions',
        'bad_actions',
    ];
    

    protected $casts = [
        'good_actions' => 'array',
        'neutral_actions' => 'array',
        'bad_actions' => 'array',
    ];

    public function scopeGroupByMonth($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->selectRaw('DATE_FORMAT(input_date, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'desc');
    }

    /**
     * CrisisPlanとのリレーション
     */
    public function crisisPlan()
    {
        return $this->belongsTo(CrisisPlan::class);
    }
}
