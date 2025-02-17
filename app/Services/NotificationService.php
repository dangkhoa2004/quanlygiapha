<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    /**
     * Lấy tất cả thông báo
     */
    public function getAllNotifications()
    {
        return Notification::orderBy('created_at', 'desc')->get();
    }

    /**
     * Lấy danh sách thông báo chưa đọc của một thành viên
     */
    public function getNotificationsByMember($memberId)
    {
        return Notification::where('member_id', $memberId)->where('is_read', false)->get();
    }

    /**
     * Đánh dấu thông báo đã đọc
     */
    public function markAsRead($notificationId)
    {
        $notification = Notification::findOrFail($notificationId);
        $notification->update(['is_read' => true]);

        return response()->json(['message' => 'Thông báo đã được đánh dấu là đã đọc'], 200);
    }

    /**
     * Gửi thông báo mới
     */
    public function createNotification($memberId, $type, $message)
    {
        return Notification::create([
            'member_id' => $memberId,
            'type' => $type,
            'message' => $message,
            'is_read' => false
        ]);
    }

    /**
     * Xóa thông báo
     */
    public function deleteNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return response()->json(['message' => 'Thông báo đã bị xóa'], 200);
    }
}
