<?php
// database/migrations/2024_01_01_create_warga_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargaTable extends Migration
{
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id('warga_id');
            $table->string('no_ktp', 20)->unique();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama', 20);
            $table->string('pekerjaan', 50);
            $table->string('telp', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('warga');
    }
};
