<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

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
            ["title" => "Hội thảo giáo dục", "start" => "2025-04-02", "end" => "2025-04-04", "color" => "violet"],
            ["title" => "Hội chợ du học", "start" => "2025-05-11", "end" => "2025-05-13", "color" => "coral"],
            ["title" => "Ngày di sản văn hóa", "start" => "2025-03-31", "end" => "2025-04-03", "color" => "violet"],
            ["title" => "Lễ hội điện ảnh", "start" => "2025-04-14", "end" => "2025-04-16", "color" => "green"],
            ["title" => "Hội chợ công nghệ", "start" => "2025-02-28", "end" => "2025-03-02", "color" => "navy"],
            ["title" => "Hội nghị blockchain", "start" => "2025-03-16", "end" => "2025-03-17", "color" => "orange"],
            ["title" => "Ngày sáng tạo nghệ thuật", "start" => "2025-03-02", "end" => "2025-03-03", "color" => "gray"],
            ["title" => "Ngày vinh danh phụ nữ", "start" => "2025-03-27", "end" => "2025-03-28", "color" => "blue"],
            ["title" => "Ngày bảo vệ môi trường", "start" => "2025-03-19", "end" => "2025-03-21", "color" => "orange"],
            ["title" => "Ngày khám phá khoa học", "start" => "2025-03-30", "end" => "2025-04-02", "color" => "red"],
            ["title" => "Hội nghị blockchain", "start" => "2025-05-17", "end" => "2025-05-20", "color" => "coral"],
            ["title" => "Lễ hội xe đạp", "start" => "2025-03-21", "end" => "2025-03-22", "color" => "purple"],
            ["title" => "Lễ hội nghệ thuật", "start" => "2025-03-03", "end" => "2025-03-06", "color" => "navy"],
            ["title" => "Lễ hội ánh sáng mùa đông", "start" => "2025-03-24", "end" => "2025-03-25", "color" => "blue"],
            ["title" => "Lễ hội ánh sáng mùa đông", "start" => "2025-04-26", "end" => "2025-04-27", "color" => "navy"],
            ["title" => "Ngày hội việc làm", "start" => "2025-05-15", "end" => "2025-05-17", "color" => "gray"],
            ["title" => "Hội thảo kỹ năng mềm", "start" => "2025-03-29", "end" => "2025-04-01", "color" => "teal"],
            ["title" => "Hội thảo khởi nghiệp", "start" => "2025-02-22", "end" => "2025-02-24", "color" => "gray"],
            ["title" => "Hội nghị quốc tế về môi trường", "start" => "2025-03-03", "end" => "2025-03-04", "color" => "navy"],
            ["title" => "Hội chợ sản phẩm xanh", "start" => "2025-03-05", "end" => "2025-03-06", "color" => "brown"],
            ["title" => "Lễ hội văn hóa dân gian", "start" => "2025-03-23", "end" => "2025-03-26", "color" => "orange"],
            ["title" => "Ngày hội xe cổ", "start" => "2025-04-08", "end" => "2025-04-11", "color" => "purple"],
            ["title" => "Lễ hội mô hình", "start" => "2025-03-02", "end" => "2025-03-05", "color" => "blue"],
            ["title" => "Hội nghị về AI", "start" => "2025-05-20", "end" => "2025-05-23", "color" => "blue"],
            ["title" => "Hội chợ công nghệ", "start" => "2025-03-31", "end" => "2025-04-01", "color" => "green"],
            ["title" => "Ngày thể thao quốc tế", "start" => "2025-03-30", "end" => "2025-03-31", "color" => "teal"],
            ["title" => "Ngày di sản văn hóa", "start" => "2025-02-27", "end" => "2025-03-01", "color" => "green"],
            ["title" => "Hội chợ sản phẩm xanh", "start" => "2025-04-30", "end" => "2025-05-03", "color" => "blue"],
            ["title" => "Lễ hội mô hình", "start" => "2025-03-20", "end" => "2025-03-21", "color" => "coral"],
            ["title" => "Lễ hội cosplay", "start" => "2025-05-09", "end" => "2025-05-10", "color" => "orange"],
            ["title" => "Ngày hội xe cổ", "start" => "2025-04-04", "end" => "2025-04-05", "color" => "brown"],
            ["title" => "Lễ hội âm nhạc đường phố", "start" => "2025-04-08", "end" => "2025-04-10", "color" => "teal"],
            ["title" => "Ngày hội xe cổ", "start" => "2025-05-18", "end" => "2025-05-19", "color" => "blue"],
            ["title" => "Cuộc thi đầu bếp trẻ", "start" => "2025-05-16", "end" => "2025-05-18", "color" => "violet"],
            ["title" => "Lễ hội mô hình", "start" => "2025-04-23", "end" => "2025-04-24", "color" => "gold"],
            ["title" => "Ngày thể thao quốc tế", "start" => "2025-05-21", "end" => "2025-05-22", "color" => "green"],
            ["title" => "Hội thảo giáo dục", "start" => "2025-05-01", "end" => "2025-05-02", "color" => "gold"],
            ["title" => "Ngày quốc tế yoga", "start" => "2025-03-22", "end" => "2025-03-24", "color" => "purple"],
            ["title" => "Hội chợ du học", "start" => "2025-04-19", "end" => "2025-04-21", "color" => "teal"],
            ["title" => "Lễ hội nghệ thuật", "start" => "2025-03-24", "end" => "2025-03-26", "color" => "blue"],
            ["title" => "Ngày di sản văn hóa", "start" => "2025-03-26", "end" => "2025-03-29", "color" => "gold"],
            ["title" => "Ngày khám phá khoa học", "start" => "2025-04-16", "end" => "2025-04-18", "color" => "red"],
            ["title" => "Ngày hội sáng tạo trẻ", "start" => "2025-03-23", "end" => "2025-03-26", "color" => "blue"],
            ["title" => "Ngày đổi mới sáng tạo", "start" => "2025-05-12", "end" => "2025-05-15", "color" => "gold"],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate($event);
        }
    }
}
