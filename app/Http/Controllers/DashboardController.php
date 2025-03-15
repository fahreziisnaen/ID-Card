<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activities = ActivityLog::with('user')
                        ->latest()
                        ->take(10)
                        ->get();

        return view('dashboard', compact('activities'));
    }
} 