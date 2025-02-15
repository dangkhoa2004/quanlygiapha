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
        Schema::create('financial_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('members')->onDelete('cascade');
            $table->string('asset_name'); // Tên tài sản (VD: Nhà đất, Cổ phiếu)
            $table->decimal('value', 15, 2)->nullable(); // Giá trị tài sản
            $table->text('details')->nullable(); // Mô tả tài sản
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('financial_assets');
    }
};
