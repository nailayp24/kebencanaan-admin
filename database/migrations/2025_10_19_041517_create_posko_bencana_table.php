<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('posko_bencana', function (Blueprint $table) {
        $table->id('posko_id');

        $table->unsignedBigInteger('kejadian_id'); // Create the column
        
        $table->foreign('kejadian_id') // Define the foreign key
          ->references('kejadian_id') // Reference the actual PK name in kejadian_bencana
          ->on('kejadian_bencana') // Specify the referenced table
          ->onDelete('cascade');

        $table->string('nama');
        $table->string('alamat');
        $table->string('kontak');
        $table->string('penanggung_jawab');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posko_bencana');
    }
};
