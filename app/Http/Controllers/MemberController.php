<?php

namespace App\Http\Controllers;


use App\Services\MemberService;
use App\Services\RelationshipService;
use Illuminate\Http\Request;
use Laravel\Pail\ValueObjects\Origin\Console;

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
        $members = $this->memberService->getAllMembers();
        return view('members.index', compact('members'));
    }

    /**
     * Hiển thị form tạo thành viên
     */
    public function create()
    {
        $members = $this->memberService->getAllMembers();
        return view('members.create', compact('members'));
    }

    /**
     * Lưu thành viên mới
     */
    public function store(Request $request)
    {
        $this->memberService->createMember($request);
        return redirect()->route('members.index')->with('success', 'Thành viên được thêm thành công');
    }

    /**
     * Hiển thị form chỉnh sửa thành viên
     */
    public function edit($id)
    {
        $member = $this->memberService->getMemberById($id);
        $members = $this->memberService->getAllMembers();
        $relationship = $this->relationshipService->getRelationshipByMemberId($id); // Lấy quan hệ theo member_id

        return view('members.edit', compact('member', 'members', 'relationship'));
    }


    /**
     * Cập nhật thông tin thành viên
     */
    public function update(Request $request, $id)
    {
        // Gọi dịch vụ cập nhật thành viên
        $this->memberService->updateMember($request, $id);
        return redirect()->route('members.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Xóa thành viên với Swal xác nhận
     */
    public function destroy($id)
    {
        $this->memberService->deleteMember($id);
        return redirect()->route('members.index')->with('success', 'Thành viên đã bị xóa');
    }
}
