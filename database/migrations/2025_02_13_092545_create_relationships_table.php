<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade'); // ID của thành viên
            $table->foreignId('born_id')->nullable()->constrained('members')->onDelete('cascade'); // ID của người sinh ra (có thể null)
            $table->string('relationship'); // Mối quan hệ (VD: "Ông Nội", "Con Gái", ...)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('relationships');
    }
};
