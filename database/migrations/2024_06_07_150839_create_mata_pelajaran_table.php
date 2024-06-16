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
    Schema::create('mata_pelajaran', function (Blueprint $table) {
        $table->id('id_mata_pelajaran');
        $table->string('nama_pelajaran');
        $table->unsignedBigInteger('id_admin');
        $table->timestamps();
        
        // Tambahkan foreign key jika diperlukan
        $table->foreign('id_admin')->references('id')->on('users')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::dropIfExists('mata_pelajaran');
}};

