<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Relationship;

class RelationshipController extends Controller
{
    /**
     * Trả về view hiển thị sơ đồ quan hệ.
     */
    public function index()
    {
        return view('relationships.index');
    }

    /**
     * API trả về dữ liệu quan hệ dưới dạng JSON.
     */
    public function getRelationshipData()
    {
        $members = Member::all();
        $relationships = Relationship::all();

        $treeData = $members->map(function ($member) use ($relationships) {
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

        return response()->json($treeData);
    }
}
