<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function getEvents($date)
    {
        // Ambil events yang terjadi pada tanggal tertentu
        $events = Event::whereDate('event_date', $date)->get();

        return response()->json([
            'events' => $events
        ]);
    }
}
