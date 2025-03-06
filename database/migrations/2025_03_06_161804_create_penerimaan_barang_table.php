<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penerimaan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('id_supplier')->constrained('supplier')->onDelete('cascade');
            $table->foreignId('id_produk')->constrained('produk')->onDelete('cascade');
            $table->foreignId('id_varian')->constrained('produk_varian')->onDelete('cascade');
            $table->integer('qty');
            $table->decimal('harga_beli', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerimaan_barang');
    }
};