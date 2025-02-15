<?php

namespace App\Http\Controllers;

use App\Services\RelationshipService;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    protected $relationshipService;

    public function __construct(RelationshipService $relationshipService)
    {
        $this->relationshipService = $relationshipService;
    }

    /**
     * Hiển thị danh sách mối quan hệ.
     */
    public function index()
    {
        try {
            $relationships = $this->relationshipService->getAllRelationships();
            return view('relationships.index', compact('relationships'));
        } catch (\Exception $e) {
            return redirect()->route('relationships.index')->with('error', 'Lỗi khi tải danh sách quan hệ: ' . $e->getMessage());
        }
    }

    /**
     * Lấy dữ liệu quan hệ dưới dạng JSON.
     */
    public function getRelationshipData()
    {
        try {
            $treeData = $this->relationshipService->getRelationshipData();
            return response()->json($treeData, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi khi lấy dữ liệu quan hệ: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Hiển thị form tạo mới mối quan hệ.
     */
    public function create()
    {
        return view('relationships.create');
    }

    /**
     * Lưu mối quan hệ mới.
     */
    public function store(Request $request)
    {
        try {
            $this->relationshipService->createRelationship($request);
            return redirect()->route('relationships.index')->with('success', 'Mối quan hệ đã được thêm');
        } catch (\Exception $e) {
            return redirect()->route('relationships.create')->with('error', 'Lỗi khi tạo mối quan hệ: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị form chỉnh sửa mối quan hệ.
     */
    public function edit($id)
    {
        try {
            $relationship = $this->relationshipService->getRelationshipByMemberId($id);
            return view('relationships.edit', compact('relationship'));
        } catch (\Exception $e) {
            return redirect()->route('relationships.index')->with('error', 'Không tìm thấy mối quan hệ');
        }
    }

    /**
     * Cập nhật mối quan hệ.
     */
    public function update(Request $request, $id)
    {
        try {
            $this->relationshipService->updateRelationship($request, $id);
            return redirect()->route('relationships.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->route('relationships.edit', ['id' => $id])->with('error', 'Lỗi khi cập nhật mối quan hệ: ' . $e->getMessage());
        }
    }

    /**
     * Xóa mối quan hệ.
     */
    public function destroy($id)
    {
        try {
            $this->relationshipService->deleteRelationship($id);
            return redirect()->route('relationships.index')->with('success', 'Mối quan hệ đã bị xóa');
        } catch (\Exception $e) {
            return redirect()->route('relationships.index')->with('error', 'Lỗi khi xóa mối quan hệ: ' . $e->getMessage());
        }
    }
}
