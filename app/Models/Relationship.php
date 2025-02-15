<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'related_member_id', 'relationship_type'];

    // Thành viên chính (người có mối quan hệ)
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    // Thành viên liên quan (cha, con, anh chị em, vợ/chồng)
    public function relatedMember()
    {
        return $this->belongsTo(Member::class, 'related_member_id');
    }
}
