<?php
// database/migrations/2024_01_01_create_kejadian_bencana_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKejadianBencanaTable extends Migration
{
    public function up()
    {
        Schema::create('kejadian_bencana', function (Blueprint $table) {
            $table->id('kejadian_id');
            $table->string('jenis_bencana', 50);
            $table->date('tanggal');
            $table->text('lokasi_text');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->text('dampak');
            $table->enum('status_kejadian', ['dilaporkan', 'diverifikasi', 'ditangani', 'selesai']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kejadian_bencana');
    }
}
