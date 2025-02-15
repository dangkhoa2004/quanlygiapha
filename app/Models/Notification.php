<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'type', 'message', 'is_read'
    ];

    // Quan hệ với Thành viên
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
