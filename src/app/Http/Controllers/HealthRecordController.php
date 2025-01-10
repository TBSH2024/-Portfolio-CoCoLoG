<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HealthRecord;

class HealthRecordController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        return view('dailyHealth.create');
    }

    public function store(Request $request) {
        $request->validate([
            'date' => ['required'],
            'mood' => ['required', 'integer'],
            'energy_level' => ['required', 'integer'],
            'sleep_quality' => ['required', 'integer'],
            'comments' => ['nullable', 'max:200'],
        ]);

        $user_id = Auth::id();

        HealthRecord::create([
            'user_id' => $user_id,
            'date' => $request->date,
            'mood' => $request->mood,
            'energy_level' => $request->energy_level,
            'sleep_quality' => $request->sleep_quality,
            'comments' => $request->comments,
        ]);

        return to_route('index');
    }
}