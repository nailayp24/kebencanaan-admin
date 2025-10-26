<?php
// database/migrations/2024_01_01_create_media_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->string('ref_table', 50);
            $table->unsignedBigInteger('ref_id');
            $table->string('file_url');
            $table->string('caption')->nullable();
            $table->string('mime_type', 50);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
};
