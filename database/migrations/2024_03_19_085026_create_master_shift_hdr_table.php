<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterShiftHdrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_shift_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('shift_name', 200)->unique();
            $table->tinyInteger('libur_random')->comment('0=Libur biasa,1=libur random day');
            $table->string('note', 300)->nullable();
            $table->tinyInteger('isactive')->nullable();
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
        Schema::dropIfExists('master_shift_hdr');
    }
}
