<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kejadian_bencana', function (Blueprint $table) {
            $table->id('kejadian_id');
            $table->string('jenis_bencana');
            $table->date('tanggal');
            $table->string('lokasi_text');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('dampak')->nullable();
            $table->string('status')->default('Dalam Penanganan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kejadian_bencana');
    }
};
