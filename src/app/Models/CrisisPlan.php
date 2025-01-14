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
        'neutral_actions',
        'bad_actions',
    ];

    protected $casts = [
        'good_actions' => 'array',
        'neutral_actions' => 'array',
        'bad_actions' => 'array',
    ];

    public function getGoodActionsAttribute($value)
    {
        return json_decode($value, true);
    }
    public function getNeutralActionsAttribute($value)
    {
        return json_decode($value, true);
    }
    public function getBadActionsAttribute($value)
    {
        return json_decode($value, true);
    }

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
