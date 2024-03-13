<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan_name', 100);
            $table->string('note', 250)->nullable();
            $table->tinyInteger('isactive')->comment('1=aktif, 0=non aktif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_jabatan');
    }
}
