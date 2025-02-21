<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CalendarController extends Controller
{
    public function showCalendar()
    {
        $events = Package::all();
        return view('calendar', compact('events'));
    }
}
