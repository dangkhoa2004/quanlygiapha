<?php

namespace App\Http\Controllers;

use App\Services\ChangeLogService;
use Illuminate\Http\Request;

class ChangeLogController extends Controller
{
    protected $changeLogService;

    public function __construct(ChangeLogService $changeLogService)
    {
        $this->changeLogService = $changeLogService;
    }

    /**
     * Hiển thị danh sách lịch sử thay đổi
     */
    public function index()
    {
        try {
            $changeLogs = $this->changeLogService->getAllChangeLogs();
            return view('changelog.index', compact('changeLogs'));
        } catch (\Exception $e) {
            return redirect()->route('changelog.index')->with('error', 'Lỗi khi tải danh sách lịch sử thay đổi: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một mục lịch sử thay đổi
     */
    public function destroy($id)
    {
        try {
            $this->changeLogService->deleteChangeLog($id);
            return redirect()->route('changelog.index')->with('success', 'Lịch sử thay đổi đã bị xóa');
        } catch (\Exception $e) {
            return redirect()->route('changelog.index')->with('error', 'Lỗi khi xóa lịch sử thay đổi: ' . $e->getMessage());
        }
    }
}
