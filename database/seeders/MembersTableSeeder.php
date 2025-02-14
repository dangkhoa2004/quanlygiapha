<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MembersTableSeeder extends Seeder
{
    public function run()
    {
        $members = [
            ["id" => 1, "name" => "Trần Văn Nam", "birth_date" => "1950-02-15", "gender" => "male", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 2, "name" => "Trần Thị Mai", "birth_date" => "1955-06-20", "gender" => "female", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 3, "name" => "Trần Văn Dũng", "birth_date" => "1975-11-05", "gender" => "male", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 4, "name" => "Trần Văn Tú", "birth_date" => "2000-04-25", "gender" => "male", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 5, "name" => "Trần Thị Hạnh", "birth_date" => "2002-07-19", "gender" => "female", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 6, "name" => "Trần Văn Minh", "birth_date" => "1984-10-06", "gender" => "male", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 7, "name" => "Trần Thị Trang", "birth_date" => "2020-07-09", "gender" => "female", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 8, "name" => "Trần Văn Tảo", "birth_date" => "1984-10-06", "gender" => "male", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 9, "name" => "Trần Văn Đông", "birth_date" => "2020-07-09", "gender" => "male", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 10, "name" => "Trần Minh Khang", "birth_date" => "2024-01-01", "gender" => "male", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 11, "name" => "Trần Thảo Nhi", "birth_date" => "2024-01-01", "gender" => "female", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 12, "name" => "Trần Gia Hưng", "birth_date" => "2024-01-01", "gender" => "male", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 13, "name" => "Trần Khánh Linh", "birth_date" => "2024-01-01", "gender" => "female", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 14, "name" => "Trần Đức Anh", "birth_date" => "2024-01-01", "gender" => "male", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
            ["id" => 15, "name" => "Trần Ngọc Bích", "birth_date" => "2024-01-01", "gender" => "female", "photo" => "https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"],
        ];

        foreach ($members as $member) {
            Member::updateOrCreate(['id' => $member['id']], [
                'name' => $member['name'],
                'birth_date' => $member['birth_date'],
                'gender' => $member['gender'],
                'bio' => '', // Để trống bio
                'photo' => $member['photo'],
            ]);
        }
    }
}
