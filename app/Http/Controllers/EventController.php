<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    /**
     * Trả về view hiển thị lịch sự kiện.
     */
    public function index()
    {
        return view('events.index');
    }

    /**
     * API trả về dữ liệu sự kiện dưới dạng JSON.
     */
    public function getEventData()
    {
        $events = Event::all()->map(function ($event) {
            return [
                "id" => $event->id,
                "title" => $event->title,
                "start" => $event->start,
                "end" => $event->end,
                "color" => $event->color ?? "#007bff",
            ];
        });

        return response()->json($events);
    }
}
