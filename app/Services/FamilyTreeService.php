<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Relationship;

class FamilyTreeService
{
    public function getMember($id)
    {
        return Member::with(['parents.relatedMember', 'children.relatedMember', 'siblings.relatedMember', 'spouses.relatedMember'])
            ->findOrFail($id);
    }

    public function getParents($memberId)
    {
        return Relationship::where('related_member_id', $memberId)
            ->where('relationship_type', 'parent')
            ->with('member')
            ->get()
            ->pluck('member');
    }

    public function getChildren($memberId)
    {
        return Relationship::where('member_id', $memberId)
            ->where('relationship_type', 'child')
            ->with('relatedMember')
            ->get()
            ->pluck('relatedMember');
    }

    public function getSiblings($memberId)
    {
        return Relationship::where('member_id', $memberId)
            ->where('relationship_type', 'sibling')
            ->with('relatedMember')
            ->get()
            ->pluck('relatedMember');
    }

    public function getSpouses($memberId)
    {
        return Relationship::where('member_id', $memberId)
            ->where('relationship_type', 'spouse')
            ->with('relatedMember')
            ->get()
            ->pluck('relatedMember');
    }

    public function addRelationship($memberId, $relatedMemberId, $type)
    {
        return Relationship::create([
            'member_id' => $memberId,
            'related_member_id' => $relatedMemberId,
            'relationship_type' => $type
        ]);
    }
}
