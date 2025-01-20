<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CrisisPlanLogs;

class CrisisPlan extends Model
{
    protected $fillable = [
        'user_id',
        'good_actions',
        'good_methods',
        'neutral_actions',
        'neutral_methods',
        'bad_actions',
        'bad_methods',
    ];

    protected $casts = [
        'good_actions' => 'array',
        'good_methods' => 'array',
        'neutral_actions' => 'array',
        'neutral_methods' => 'array',
        'bad_actions' => 'array',
        'bad_methods' => 'array'
    ];

    /**
     * Userとのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * CrisisPlanLogsとのリレーション
     */
    public function items()
    {
        return $this->hasMany(CrisisPlanLogs::class);
    }
}
