<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $hour = $now->hour;

        if ($hour >= 5 && $hour < 12) {
            $greeting = "Pagi";
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = "Siang";
        } else {
            $greeting = "Malam";
        }

        $title = 'Dashboard';
        return view('dashboard.index', compact('title', 'greeting'));
    }
}
