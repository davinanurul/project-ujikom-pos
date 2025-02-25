<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('batch', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('harga_beli', 10, 2);
            $table->decimal('harga_jual', 10, 2)->nullable();
            $table->date('tanggal_kedaluwarsa');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('batch');
    }
};