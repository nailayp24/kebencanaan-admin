<?php
// database/migrations/2024_01_01_create_media_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->string('ref_table'); // 'posko_bencana', 'kejadian_bencana', dll
            $table->unsignedBigInteger('ref_id'); // ID dari tabel di atas
            $table->string('file_name'); // nama file yang disimpan
            $table->string('caption')->nullable(); // keterangan
            $table->string('mime_type')->nullable(); // jenis file
            $table->integer('sort_order')->default(0); // urutan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
