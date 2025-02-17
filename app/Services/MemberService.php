<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Relationship;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberService
{
    /**
     * Lấy tất cả thành viên.
     */
    public function getAllMembers()
    {
        return Member::all();
    }

    /**
     * Lấy thành viên theo ID.
     */
    public function getMemberById($id)
    {
        return Member::findOrFail($id);
    }

    /**
     * Tạo mới thành viên.
     */
    public function createMember(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'birth_date' => 'nullable|date',
                'gender' => 'required|in:male,female',
                'photo' => 'nullable|image|max:2048',
                'born_id' => 'nullable|exists:members,id',
            ]);

            if ($request->hasFile('photo')) {
                $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
            }

            $member = Member::create($validatedData);

            if ($request->born_id) {
                Relationship::create([
                    'member_id' => $member->id,
                    'born_id' => $request->born_id,
                    'relationship' => 'parent-child',
                ]);
            }

            return response()->json(['message' => 'Thành viên đã được tạo', 'data' => $member], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Lỗi khi tạo thành viên: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Cập nhật thông tin thành viên.
     */
    public function updateMember(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'birth_date' => 'nullable|date',
                'gender' => 'required|in:male,female',
                'photo' => 'nullable|image|max:2048',
                'born_id' => 'nullable|exists:members,id',
            ]);

            $member = Member::findOrFail($id);

            if ($request->hasFile('photo')) {
                // Xóa ảnh cũ nếu có
                if ($member->photo) {
                    Storage::disk('public')->delete($member->photo);
                }
                $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
            }

            $member->update($validatedData);

            Relationship::updateOrCreate(
                ['member_id' => $member->id],
                ['born_id' => $request->born_id, 'relationship' => 'Con trai']
            );

            return response()->json(['message' => 'Cập nhật thành công', 'data' => $member], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Lỗi khi cập nhật thành viên: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Xóa thành viên.
     */
    public function deleteMember($id)
    {
        try {
            $member = Member::findOrFail($id);

            // Xóa ảnh nếu có
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }

            // Xóa quan hệ liên quan
            Relationship::where('member_id', $id)->delete();

            // Xóa thành viên
            $member->delete();

            return response()->json(['message' => 'Thành viên đã bị xóa'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Lỗi khi xóa thành viên: ' . $e->getMessage()], 500);
        }
    }
}
