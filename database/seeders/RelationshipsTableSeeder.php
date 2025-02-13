<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Relationship;

class RelationshipsTableSeeder extends Seeder
{
    public function run()
    {
        $relationships = [
            ["member_id" => 2, "born_id" => 1, "relationship" => "Con Gái"],
            ["member_id" => 3, "born_id" => 1, "relationship" => "Con Trai"],
            ["member_id" => 4, "born_id" => 3, "relationship" => "Con Trai"],
            ["member_id" => 5, "born_id" => 3, "relationship" => "Con Gái"],
            ["member_id" => 6, "born_id" => 2, "relationship" => "Con Trai"],
            ["member_id" => 7, "born_id" => 2, "relationship" => "Con Gái"],
            ["member_id" => 8, "born_id" => 6, "relationship" => "Con Trai"],
            ["member_id" => 9, "born_id" => 6, "relationship" => "Con Trai"],
            ["member_id" => 10, "born_id" => 4, "relationship" => "Con Trai"],
            ["member_id" => 11, "born_id" => 4, "relationship" => "Con Gái"],
            ["member_id" => 12, "born_id" => 5, "relationship" => "Con Trai"],
            ["member_id" => 13, "born_id" => 5, "relationship" => "Con Gái"],
            ["member_id" => 14, "born_id" => 7, "relationship" => "Con Trai"],
            ["member_id" => 15, "born_id" => 7, "relationship" => "Con Gái"],
        ];

        foreach ($relationships as $relation) {
            Relationship::updateOrCreate(['member_id' => $relation['member_id'], 'born_id' => $relation['born_id']], $relation);
        }
    }
}
