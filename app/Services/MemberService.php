<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Relationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberService
{
    public function getAllMembers()
    {
        return Member::all();
    }

    public function getMemberById($id)
    {
        return Member::findOrFail($id);
    }

    public function createMember(Request $request)
    {
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

        return $member;
    }

    public function updateMember(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'photo' => 'nullable|image|max:2048',
            'born_id' => 'nullable|exists:members,id',
        ]);

        $member = Member::findOrFail($id);

        if ($request->hasFile('photo')) {
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

        return $member;
    }

    public function deleteMember($id)
    {
        $member = Member::findOrFail($id); // Retrieve the member or fail if not found

        // Handle photo deletion if it exists
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }

        // Ensure relationships tied to the member are deleted
        $relationships = Relationship::where('member_id', $id);
        if ($relationships->exists()) {
            $relationships->delete(); // Delete related relationships
        }

        // Finally, delete the member
        $member->delete();
    }
}
