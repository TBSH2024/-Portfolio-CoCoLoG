<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WellnessLog extends Model
{
    protected $fillable = [
        'user_id',
        'input_date',
        'energy_level',
        'sleep_quality',
        'mood',
        'score',
        'comments',
    ];

    public function getScoreAttribute()
    {
        $labels = [
            5 => '5点(満点)',
            4 => '4点',
            3 => '3点',
            2 => '4点',
            1 => '5点',
        ];
        return $labels[$this->attributes['score']] ?? '点数なし';
    }

    public function scopeGroupByMonth($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->selectRaw('TO_CHAR(input_date, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'desc');
    }

    /**
     * Userとのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}