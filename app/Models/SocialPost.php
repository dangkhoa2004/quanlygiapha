<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'content', 'media'
    ];

    // Quan hệ với Thành viên
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Quan hệ với Bình luận
    public function comments()
    {
        return $this->hasMany(SocialComment::class, 'post_id');
    }
}
