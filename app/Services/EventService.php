<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Http\Request;

class EventService
{
    /**
     * Lấy tất cả sự kiện.
     */
    public function getAllEvents()
    {
        return Event::all();
    }

    /**
     * Lấy sự kiện theo ID.
     */
    public function getEventById($id)
    {
        return Event::findOrFail($id);
    }

    /**
     * Tạo mới sự kiện.
     */
    public function createEvent(Request $request)
    {
        try {
            // Validate dữ liệu đầu vào
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date',
                'end' => 'required|date|after_or_equal:start',
                'color' => 'nullable|string|max:7',
            ]);

            // Tạo mới sự kiện
            $event = Event::create($validatedData);

            return response()->json(['message' => 'Sự kiện đã được tạo thành công', 'data' => $event], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi khi tạo sự kiện: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Cập nhật sự kiện.
     */
    public function updateEvent(Request $request, $id)
    {
        try {
            // Tìm sự kiện theo ID
            $event = Event::findOrFail($id);

            // Validate dữ liệu trước khi cập nhật
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date',
                'end' => 'required|date|after_or_equal:start',
                'color' => 'nullable|string|max:7',
            ]);

            // Cập nhật sự kiện
            $event->update($validatedData);

            return response()->json(['message' => 'Cập nhật sự kiện thành công', 'data' => $event], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi khi cập nhật sự kiện: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Xóa sự kiện.
     */
    public function deleteEvent($id)
    {
        try {
            // Tìm sự kiện theo ID
            $event = Event::findOrFail($id);

            // Xóa sự kiện
            $event->delete();

            return response()->json(['message' => 'Sự kiện đã được xóa thành công'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi khi xóa sự kiện: ' . $e->getMessage()], 500);
        }
    }
}
