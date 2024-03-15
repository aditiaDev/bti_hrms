<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfMasterCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_master_code', function (Blueprint $table) {
            $table->id();
            $table->string('type', 150);
            $table->string('code', 20);
            $table->string('desc', 100)->nullable();
            $table->string('note', 400)->nullable();

            $table->unique(['type', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conf_master_code');
    }
}
