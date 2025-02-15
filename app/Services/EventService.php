<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function getAllEvents()
    {
        // Trả về tất cả sự kiện
        return Event::all();
    }

    public function getEventById($id)
    {
        // Trả về sự kiện theo ID, nếu không tìm thấy sẽ trả về lỗi 404
        return Event::findOrFail($id);
    }

    public function createEvent($request)
    {
        // Validate dữ liệu trước khi lưu
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'color' => 'nullable|string|max:7', // Mã màu có thể là 7 ký tự (bao gồm dấu #)
        ]);

        // Tạo mới sự kiện
        return Event::create([
            'title' => $validated['title'],
            'start' => $validated['start'],
            'end' => $validated['end'],
            'color' => $validated['color'] ?? null,
        ]);
    }

    public function updateEvent($request, $id)
    {
        // Tìm sự kiện theo ID
        $event = Event::findOrFail($id);

        // Validate dữ liệu trước khi cập nhật
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'color' => 'nullable|string|max:7',
        ]);

        // Cập nhật sự kiện
        $event->update([
            'title' => $validated['title'],
            'start' => $validated['start'],
            'end' => $validated['end'],
            'color' => $validated['color'] ?? $event->color,
        ]);

        return $event;
    }

    public function deleteEvent($id)
    {
        // Tìm sự kiện theo ID
        $event = Event::findOrFail($id);

        // Xóa sự kiện
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully.']);
    }
}

