<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birth_date', 'death_date', 'gender', 'bio', 'photo'];

    public function relationships()
    {
        return $this->hasMany(Relationship::class, 'member_id');
    }

    public function parents()
    {
        return $this->hasMany(Relationship::class, 'born_id');
    }
}
