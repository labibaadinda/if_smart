<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkripsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skripsis', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->nullable();
            $table->string('judul')->nullable();
            $table->string('progres')->nullable();        
            $table->string('stat_skripsi')->nullable();
            $table->string('tanggal_sidang')->nullable();
            $table->string('konfirmasi')->nullable()->default('0');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('skripsis');
    }
}
