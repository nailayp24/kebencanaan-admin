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
        Schema::create('logistik_bencana', function (Blueprint $table) {
            $table->id('logistik_id');
            $table->foreignId('kejadian_id')
                  ->constrained('kejadian_bencana', 'kejadian_id')
                  ->onDelete('cascade');
            $table->string('nama_barang', 100);
            $table->string('satuan', 20);
            $table->integer('stok')->default(0);
            $table->string('sumber', 100);
            $table->timestamps();

            $table->index('kejadian_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistik_bencana');
    }
};
