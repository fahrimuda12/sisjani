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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('ruangan');
            $table->dateTime('tgl_mulai');
            $table->dateTime('tgl_selesai');
            $table->string('snack');
            $table->string('status');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->string('requested_by');
            $table->string('approved_by');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_jadwal');
    }
};
