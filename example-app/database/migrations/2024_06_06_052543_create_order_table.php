<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_kh');
            $table->datetime('ngay_lap_hoa_don')->default(now());
            $table->dateTime('ngay_nhan_hang')->nullable();
            $table->tinyInteger('ttthanhtoan')->default('0');
            $table->tinyInteger('ttvanchuyen')->default('0');
            $table->tinyInteger('trangthai')->default('0');
            $table->timestamps();
            
            $table->foreign('ma_kh')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};