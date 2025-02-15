<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birth_date', 'death_date', 'gender', 'bio', 'photo'];

    // Quan hệ với thông báo
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Quan hệ với bài viết trên mạng xã hội gia đình
    public function posts()
    {
        return $this->hasMany(SocialPost::class);
    }

    // Quan hệ với lịch sử thay đổi
    public function changeLogs()
    {
        return $this->hasMany(ChangeLog::class);
    }

    // Quan hệ với tài sản tài chính
    public function assets()
    {
        return $this->hasMany(FinancialAsset::class, 'owner_id');
    }

    // Quan hệ với tất cả các mối quan hệ
    public function relationships()
    {
        return $this->hasMany(Relationship::class, 'member_id');
    }

    // Lấy danh sách cha mẹ
    public function parents()
    {
        return $this->hasMany(Relationship::class, 'related_member_id')
            ->where('relationship_type', 'parent');
    }

    // Lấy danh sách con
    public function children()
    {
        return $this->hasMany(Relationship::class, 'member_id')
            ->where('relationship_type', 'child');
    }

    // Lấy danh sách anh chị em
    public function siblings()
    {
        return $this->hasMany(Relationship::class, 'member_id')
            ->where('relationship_type', 'sibling');
    }

    // Lấy danh sách vợ/chồng
    public function spouses()
    {
        return $this->hasMany(Relationship::class, 'member_id')
            ->where('relationship_type', 'spouse');
    }
}
