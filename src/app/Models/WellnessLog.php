<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WellnessLog extends Model
{
    protected $fillable = [
        'user_id',
        'input_date',
        'mood',
        'energy_level',
        'sleep_quality',
        'comments'
    ];

    public function getMoodLabelAttribute()
    {
        $labels = [
            1 => '非常に良い',
            2 => '良い',
            3 => '普通',
            4 => '悪い',
            5 => '非常に悪い',
        ];
        return $labels[$this->attributes['mood']] ?? '不明';
    }

    public function scopeGroupByMonth($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->selectRaw('DATE_FORMAT(input_date, "%Y-%m") as month, COUNT(*) as count')
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