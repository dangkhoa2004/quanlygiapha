<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * Hiển thị danh sách sự kiện
     */
    public function index()
    {
        try {
            $events = $this->eventService->getAllEvents();
            return view('events.index', compact('events'));
        } catch (\Exception $e) {
            return redirect()->route('events.index')->with('error', 'Lỗi khi tải danh sách sự kiện');
        }
    }

    /**
     * Lấy dữ liệu sự kiện với API
     */
    public function getEventData()
    {
        try {
            $events = $this->eventService->getAllEvents()->map(function ($event) {
                return [
                    "id" => $event->id,
                    "title" => $event->title,
                    "start" => $event->start,
                    "end" => $event->end,
                    "color" => $event->color ?? "#007bff",
                ];
            });

            return response()->json($events, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi khi lấy dữ liệu sự kiện: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Hiển thị form tạo sự kiện
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Lưu sự kiện mới
     */
    public function store(Request $request)
    {
        try {
            $this->eventService->createEvent($request);
            return redirect()->route('events.index')->with('success', 'Sự kiện được thêm thành công');
        } catch (\Exception $e) {
            return redirect()->route('events.create')->with('error', 'Lỗi khi tạo sự kiện: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị form chỉnh sửa sự kiện
     */
    public function edit($id)
    {
        try {
            $event = $this->eventService->getEventById($id);
            return view('events.edit', compact('event'));
        } catch (\Exception $e) {
            return redirect()->route('events.index')->with('error', 'Không tìm thấy sự kiện');
        }
    }

    /**
     * Cập nhật thông tin sự kiện
     */
    public function update(Request $request, $id)
    {
        try {
            $this->eventService->updateEvent($request, $id);
            return redirect()->route('events.index')->with('success', 'Cập nhật sự kiện thành công');
        } catch (\Exception $e) {
            return redirect()->route('events.edit', ['id' => $id])->with('error', 'Lỗi khi cập nhật sự kiện: ' . $e->getMessage());
        }
    }

    /**
     * Xóa sự kiện
     */
    public function destroy($id)
    {
        try {
            $this->eventService->deleteEvent($id);
            return redirect()->route('events.index')->with('success', 'Sự kiện đã bị xóa');
        } catch (\Exception $e) {
            return redirect()->route('events.index')->with('error', 'Lỗi khi xóa sự kiện: ' . $e->getMessage());
        }
    }
}
