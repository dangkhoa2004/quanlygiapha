<?php

namespace App\Http\Controllers;

use App\Services\MemberService;
use App\Services\RelationshipService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $memberService;
    protected $relationshipService;

    public function __construct(MemberService $memberService, RelationshipService $relationshipService)
    {
        $this->memberService = $memberService;
        $this->relationshipService = $relationshipService;
    }

    /**
     * Hiển thị danh sách thành viên
     */
    public function index()
    {
        try {
            $members = $this->memberService->getAllMembers();
            return view('members.index', compact('members'));
        } catch (\Exception $e) {
            return redirect()->route('members.index')->with('error', 'Lỗi khi tải danh sách thành viên: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị form tạo thành viên
     */
    public function create()
    {
        try {
            $members = $this->memberService->getAllMembers();
            return view('members.create', compact('members'));
        } catch (\Exception $e) {
            return redirect()->route('members.index')->with('error', 'Lỗi khi tải danh sách thành viên');
        }
    }

    /**
     * Lưu thành viên mới
     */
    public function store(Request $request)
    {
        try {
            $this->memberService->createMember($request);
            return redirect()->route('members.index')->with('success', 'Thành viên được thêm thành công');
        } catch (\Exception $e) {
            return redirect()->route('members.create')->with('error', 'Lỗi khi tạo thành viên: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị form chỉnh sửa thành viên
     */
    public function edit($id)
    {
        try {
            $member = $this->memberService->getMemberById($id);
            $members = $this->memberService->getAllMembers();
            $relationship = $this->relationshipService->getRelationshipByMemberId($id);

            return view('members.edit', compact('member', 'members', 'relationship'));
        } catch (\Exception $e) {
            return redirect()->route('members.index')->with('error', 'Không tìm thấy thành viên');
        }
    }

    /**
     * Cập nhật thông tin thành viên
     */
    public function update(Request $request, $id)
    {
        try {
            $this->memberService->updateMember($request, $id);
            return redirect()->route('members.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('members.edit', ['id' => $id])->with('error', 'Lỗi khi cập nhật thành viên: ' . $e->getMessage());
        }
    }

    /**
     * Xóa thành viên
     */
    public function destroy($id)
    {
        try {
            $this->memberService->deleteMember($id);
            return redirect()->route('members.index')->with('success', 'Thành viên đã bị xóa');
        } catch (\Exception $e) {
            return redirect()->route('members.index')->with('error', 'Lỗi khi xóa thành viên: ' . $e->getMessage());
        }
    }
}
