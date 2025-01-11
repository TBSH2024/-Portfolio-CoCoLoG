<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CrisisPlan;

class CrisisPlanLogs extends Model
{
    protected $fillable = [
        'user_id',
        'crisis_plan_id',
        'category',
        'action_index',
        'input_date'
    ];

    /**
     * CrisisPlanとのリレーション
     */
    public function crisisPlan()
    {
        return $this->belongsTo(CrisisPlan::class);
    }
}
