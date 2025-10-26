<?php
// database/migrations/2024_01_01_create_posko_bencana_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoskoBencanaTable extends Migration
{
    public function up()
    {
        Schema::create('posko_bencana', function (Blueprint $table) {
            $table->id('posko_id');
            $table->foreignId('kejadian_id')->constrained('kejadian_bencana', 'kejadian_id');
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('kontak', 15);
            $table->string('penanggung_jawab', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posko_bencana');
    }
}
