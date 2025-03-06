<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        schema::create('users', function (Blueprint $table){
            $table->id('user_id');
            $table->string('user_nama', 50)->nullable();
            $table->string('user_pass', 60)->nullable();
            $table->string('user_hak', 10)->nullable();
            $table->boolean('user_sts')->default(1);
            $table->timestamps();
        });
    }
};