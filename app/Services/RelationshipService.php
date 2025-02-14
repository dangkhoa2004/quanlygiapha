<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Relationship;
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

    public function getRelationshipByMemberId($memberId)
    {
        return Relationship::where('member_id', $memberId)->first();
    }

    /**
     * Tạo một mối quan hệ mới.
     */
    public function createRelationship(Request $request)
    {
        $validatedData = $request->validate([
            'member_id' => 'required|exists:members,id',
            'born_id' => 'nullable|exists:members,id',
            'relationship' => 'required|string|max:255'
        ]);

        return Relationship::create($validatedData);
    }

    /**
     * Cập nhật mối quan hệ.
     */
    public function updateRelationship(Request $request, $id)
    {
        $validatedData = $request->validate([
            'member_id' => 'required|exists:members,id',
            'born_id' => 'nullable|exists:members,id',
            'relationship' => 'required|string|max:255'
        ]);

        $relationship = Relationship::findOrFail($id);
        $relationship->update($validatedData);

        return $relationship;
    }

    /**
     * Xóa mối quan hệ.
     */
    public function deleteRelationship($id)
    {
        $relationship = Relationship::findOrFail($id);
        $relationship->delete();
    }
}
