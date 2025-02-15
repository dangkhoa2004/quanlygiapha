<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('change_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->string('action'); // Hành động (thêm, sửa, xóa)
            $table->string('table_name'); // Bảng bị thay đổi
            $table->json('old_data')->nullable(); // Dữ liệu cũ
            $table->json('new_data')->nullable(); // Dữ liệu mới
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('change_logs');
    }
};
