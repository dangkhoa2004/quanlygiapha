<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MembersTableSeeder extends Seeder
{
    public function run()
    {
        $members = [
            ["id" => 1, "name" => "Trần Văn Nam", "birth_date" => "1950-02-15", "gender" => "male"],
            ["id" => 2, "name" => "Trần Thị Mai", "birth_date" => "1955-06-20", "gender" => "female"],
            ["id" => 3, "name" => "Trần Văn Dũng", "birth_date" => "1975-11-05", "gender" => "male"],
            ["id" => 4, "name" => "Trần Văn Tú", "birth_date" => "2000-04-25", "gender" => "male"],
            ["id" => 5, "name" => "Trần Thị Hạnh", "birth_date" => "2002-07-19", "gender" => "female"],
            ["id" => 6, "name" => "Trần Văn Minh", "birth_date" => "1984-10-06", "gender" => "male"],
            ["id" => 7, "name" => "Trần Thị Trang", "birth_date" => "2020-07-09", "gender" => "female"],
            ["id" => 8, "name" => "Trần Văn Tảo", "birth_date" => "1984-10-06", "gender" => "male"],
            ["id" => 9, "name" => "Trần Văn Đông", "birth_date" => "2020-07-09", "gender" => "male"],
            ["id" => 10, "name" => "Trần Minh Khang", "birth_date" => "2024-01-01", "gender" => "male"],
            ["id" => 11, "name" => "Trần Thảo Nhi", "birth_date" => "2024-01-01", "gender" => "female"],
            ["id" => 12, "name" => "Trần Gia Hưng", "birth_date" => "2024-01-01", "gender" => "male"],
            ["id" => 13, "name" => "Trần Khánh Linh", "birth_date" => "2024-01-01", "gender" => "female"],
            ["id" => 14, "name" => "Trần Đức Anh", "birth_date" => "2024-01-01", "gender" => "male"],
            ["id" => 15, "name" => "Trần Ngọc Bích", "birth_date" => "2024-01-01", "gender" => "female"],
        ];

        foreach ($members as $member) {
            Member::updateOrCreate(['id' => $member['id']], [
                'name' => $member['name'],
                'birth_date' => $member['birth_date'],
                'gender' => $member['gender'],
                'bio' => '', // Để trống bio
                'photo' => '' // Để trống photo
            ]);
        }
    }
}
