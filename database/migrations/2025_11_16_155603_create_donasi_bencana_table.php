<?php
// database/migrations/2024_01_01_000003_create_donasi_bencana_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi_bencana', function (Blueprint $table) {
            $table->id('donasi_id');
            $table->foreignId('kejadian_id')
                  ->constrained('kejadian_bencana', 'kejadian_id')
                  ->onDelete('cascade');
            $table->string('donatur_nama');
            $table->string('jenis'); // uang, barang, jasa
            $table->decimal('nilai', 15, 2)->nullable(); // untuk donasi uang
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_bencana');
    }
};
