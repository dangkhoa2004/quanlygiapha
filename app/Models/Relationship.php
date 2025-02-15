<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'born_id', 'relationship'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function born()
    {
        return $this->belongsTo(Member::class, 'born_id');
    }
}
