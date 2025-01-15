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