<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'member_id', 'comment'
    ];

    // Quan hệ với Bài viết
    public function post()
    {
        return $this->belongsTo(SocialPost::class);
    }

    // Quan hệ với Thành viên
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
