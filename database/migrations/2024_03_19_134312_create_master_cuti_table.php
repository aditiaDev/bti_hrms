<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterCutiTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('master_cuti', function (Blueprint $table) {
      $table->id();
      $table->string('cuti_name', 150)->unique();
      $table->string('note', 150)->nullable();
      $table->smallInteger('max');
      $table->tinyInteger('isunpaid')->comment('0=dibayar, 1=tidak dibayar');
      $table->tinyInteger('inc_holiday')->comment('0=tidak include tgl merah, 1=include tgl merah');
      $table->tinyInteger('half_day')->comment('0=Cuti full day, 1=Cuti half day');
      $table->tinyInteger('isactive')->comment('0=not active, 1=active');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('master_cuti');
  }
}
