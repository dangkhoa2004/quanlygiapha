<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Relationship;
use Exception;
use Illuminate\Http\Request;

class RelationshipService
{
    /**
     * Lấy danh sách tất cả các mối quan hệ.
     */
    public function getAllRelationships()
    {
        return Relationship::all();
    }

    /**
     * Lấy dữ liệu quan hệ dưới dạng JSON.
     */
    public function getRelationshipData()
    {
        $members = Member::all();
        $relationships = Relationship::all();

        if ($members->isEmpty()) {
            return response()->json([], 200);
        }

        return $members->map(function ($member) use ($relationships) {
            $relationship = $relationships->where('member_id', $member->id)->first();
            return [
                "ID" => $member->id,
                "HoTen" => $member->name,
                "NgaySinh" => $member->birth_date,
                "GioiTinh" => $member->gender,
                "QuanHe" => $relationship ? $relationship->relationship : "Không rõ",
                "ChaID" => $relationship ? $relationship->born_id : null,
                "AVT" => $member->photo ? asset($member->photo) : asset('assets/default-avatar.png')
            ];
        });
    }

    /**
     * Lấy mối quan hệ theo ID.
     */
    public function getRelationshipByMemberId($memberId)
    {
        return Relationship::where('member_id', $memberId)->first();
    }

    /**
     * Tạo một mối quan hệ mới.
     */
    public function createRelationship(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'member_id' => 'required|exists:members,id',
                'born_id' => 'nullable|exists:members,id',
                'relationship' => 'required|string|max:255'
            ]);

            return Relationship::create($validatedData);
        } catch (Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Cập nhật mối quan hệ.
     */
    public function updateRelationship(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'member_id' => 'required|exists:members,id',
                'born_id' => 'nullable|exists:members,id',
                'relationship' => 'required|string|max:255'
            ]);

            $relationship = Relationship::findOrFail($id);
            $relationship->update($validatedData);

            return response()->json(['message' => 'Cập nhật thành công'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Xóa mối quan hệ.
     */
    public function deleteRelationship($id)
    {
        try {
            $relationship = Relationship::findOrFail($id);
            $relationship->delete();

            return response()->json(['message' => 'Xóa thành công'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }
}
