<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id', 'asset_name', 'value', 'details'
    ];

    // Quan hệ với Thành viên (chủ sở hữu tài sản)
    public function owner()
    {
        return $this->belongsTo(Member::class, 'owner_id');
    }
}
