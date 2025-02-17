<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Hiển thị danh sách thông báo
     */
    public function index()
    {
        try {
            $notifications = $this->notificationService->getAllNotifications();
            return view('notifications.index', compact('notifications'));
        } catch (\Exception $e) {
            return redirect()->route('notifications.index')->with('error', 'Lỗi khi tải danh sách thông báo: ' . $e->getMessage());
        }
    }

    /**
     * Đánh dấu thông báo là đã đọc
     */
    public function markAsRead($id)
    {
        try {
            $this->notificationService->markAsRead($id);
            return redirect()->route('notifications.index')->with('success', 'Thông báo đã được đánh dấu là đã đọc');
        } catch (\Exception $e) {
            return redirect()->route('notifications.index')->with('error', 'Lỗi khi cập nhật thông báo: ' . $e->getMessage());
        }
    }

    /**
     * Xóa thông báo
     */
    public function destroy($id)
    {
        try {
            $this->notificationService->deleteNotification($id);
            return redirect()->route('notifications.index')->with('success', 'Thông báo đã bị xóa');
        } catch (\Exception $e) {
            return redirect()->route('notifications.index')->with('error', 'Lỗi khi xóa thông báo: ' . $e->getMessage());
        }
    }
}
