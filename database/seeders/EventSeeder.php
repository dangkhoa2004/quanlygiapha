<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            ["title" => "Tết Nguyên Đán", "start" => "2025-01-29", "end" => "2025-02-02", "color" => "red"],
            ["title" => "Ngày Quốc tế Phụ nữ", "start" => "2025-03-08", "end" => "2025-03-09", "color" => "purple"],
            ["title" => "Giỗ Tổ Hùng Vương", "start" => "2025-04-10", "end" => "2025-04-11", "color" => "green"],
            ["title" => "Ngày Quốc tế Lao động", "start" => "2025-05-01", "end" => "2025-05-02", "color" => "orange"],
            ["title" => "Ngày Quốc khánh", "start" => "2025-09-02", "end" => "2025-09-03", "color" => "blue"],
            ["title" => "Tết Trung Thu", "start" => "2025-09-21", "end" => "2025-09-22", "color" => "gold"],
            ["title" => "Lễ hội hoa đào", "start" => "2025-04-05", "end" => "2025-04-10", "color" => "purple"],
            ["title" => "Ngày Nhà giáo Việt Nam", "start" => "2025-11-20", "end" => "2025-11-21", "color" => "teal"],
            ["title" => "Giáng Sinh", "start" => "2025-12-25", "end" => "2025-12-26", "color" => "green"],
            ["title" => "Lễ hội ánh sáng", "start" => "2025-12-10", "end" => "2025-12-12", "color" => "yellow"],
            ["title" => "Ngày Thanh niên", "start" => "2025-06-01", "end" => "2025-06-02", "color" => "blueviolet"],
            ["title" => "Ngày Quốc tế Thiếu nhi", "start" => "2025-06-01", "end" => "2025-06-02", "color" => "magenta"],
            ["title" => "Lễ hội mùa xuân", "start" => "2025-03-20", "end" => "2025-03-22", "color" => "lightgreen"],
            ["title" => "Ngày Quốc tế Hòa Bình", "start" => "2025-08-15", "end" => "2025-08-16", "color" => "skyblue"],
            ["title" => "Lễ hội âm nhạc", "start" => "2025-07-10", "end" => "2025-07-12", "color" => "violet"],
            ["title" => "Hội chợ ẩm thực", "start" => "2025-05-15", "end" => "2025-05-16", "color" => "brown"],
            ["title" => "Triển lãm nghệ thuật", "start" => "2025-10-05", "end" => "2025-10-07", "color" => "coral"],
            ["title" => "Cuộc thi chạy bộ", "start" => "2025-04-15", "end" => "2025-04-16", "color" => "darkorange"],
            ["title" => "Ngày Gia đình", "start" => "2025-05-10", "end" => "2025-05-11", "color" => "lightblue"],
            ["title" => "Lễ hội bóng đá", "start" => "2025-06-20", "end" => "2025-06-22", "color" => "navy"],
            ["title" => "Ngày của Mẹ", "start" => "2025-05-10", "end" => "2025-05-11", "color" => "hotpurple"],
            ["title" => "Ngày của Cha", "start" => "2025-06-15", "end" => "2025-06-16", "color" => "saddlebrown"],
            ["title" => "Ngày Tình Yêu", "start" => "2025-02-14", "end" => "2025-02-15", "color" => "deeppurple"],
            ["title" => "Ngày Độc Thân", "start" => "2025-11-11", "end" => "2025-11-12", "color" => "silver"],
            ["title" => "Ngày Người Cao Tuổi", "start" => "2025-10-01", "end" => "2025-10-02", "color" => "gray"],
            ["title" => "Lễ hội Mua Sắm Cuối Năm", "start" => "2025-12-01", "end" => "2025-12-05", "color" => "crimson"],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate($event);
        }
    }
}
