<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah foreign key ke tabel posko_bencana
     */
    public function up(): void
    {
        Schema::table('posko_bencana', function (Blueprint $table) {
            // Tambah foreign key ke kejadian_bencana.id
            $table->foreign('kejadian_id')
                  ->references('id')
                  ->on('kejadian_bencana')
                  ->onDelete('cascade');
        });
    }

    /**
     * Hapus foreign key jika rollback
     */
    public function down(): void
    {
        Schema::table('posko_bencana', function (Blueprint $table) {
            $table->dropForeign(['kejadian_id']);
        });
    }
};
