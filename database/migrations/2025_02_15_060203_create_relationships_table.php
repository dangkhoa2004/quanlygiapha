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
        Schema::create('relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade'); // Thành viên chính
            $table->foreignId('related_member_id')->constrained('members')->onDelete('cascade'); // Thành viên liên quan
            $table->enum('relationship_type', ['parent', 'child', 'sibling', 'spouse']); // Quan hệ gia đình
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('relationships');
    }
};
