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
        'evaluation',
    ];
    

    protected $casts = [
        'good_actions' => 'array',
        'neutral_actions' => 'array',
        'bad_actions' => 'array',
    ];

    public function getEvaluationAttribute()
    {
        $labels = [
            1 => '安定状態',
            2 => '安定状態〜注意状態',
            3 => '注意状態',
            4 => '注意状態〜要注意状態',
            5 => '要注意状態',
        ];
        return $labels[$this->attributes['evaluation']] ?? '点数なし';
    }

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
