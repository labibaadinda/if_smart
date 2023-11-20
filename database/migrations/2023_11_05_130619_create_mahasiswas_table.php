<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->nullable(); //unique
            $table->string('nama')->nullable();
            $table->string('dosen_id')->nullable();
            $table->string('status')->default('aktif');
            $table->string('angkatan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota_id')->nullable();
            $table->string('provinsi_id')->nullable();
            $table->string('jalur_masuk')->nullable();
            $table->string('handphone')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
}
