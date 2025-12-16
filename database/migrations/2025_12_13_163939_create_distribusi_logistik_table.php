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
        Schema::create('distribusi_logistik', function (Blueprint $table) {
            $table->id('distribusi_id');
            $table->foreignId('logistik_id')
                  ->constrained('logistik_bencana', 'logistik_id')
                  ->onDelete('cascade');
            $table->foreignId('posko_id')
                  ->constrained('posko_bencana', 'posko_id')
                  ->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->string('penerima', 100);
            $table->timestamps();

            $table->index('logistik_id');
            $table->index('posko_id');
            $table->index('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusi_logistik');
    }
};
