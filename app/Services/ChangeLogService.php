<?php

namespace App\Services;

use App\Models\ChangeLog;
use Illuminate\Http\Request;

class ChangeLogService
{
    /**
     * Lấy toàn bộ lịch sử thay đổi
     */
    public function getAllChangeLogs()
    {
        return ChangeLog::orderBy('created_at', 'desc')->get();
    }

    /**
     * Lấy lịch sử thay đổi của một thành viên
     */
    public function getMemberChangeLogs($memberId)
    {
        return ChangeLog::where('member_id', $memberId)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Ghi lại một thay đổi
     */
    public function logChange($memberId, $action, $tableName, $oldData, $newData)
    {
        return ChangeLog::create([
            'member_id' => $memberId,
            'action' => $action,
            'table_name' => $tableName,
            'old_data' => json_encode($oldData),
            'new_data' => json_encode($newData),
        ]);
    }

    /**
     * Xóa lịch sử thay đổi theo ID
     */
    public function deleteChangeLog($id)
    {
        $changeLog = ChangeLog::findOrFail($id);
        $changeLog->delete();
        return response()->json(['message' => 'Lịch sử thay đổi đã bị xóa'], 200);
    }
}
