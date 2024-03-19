<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListLiburTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('list_libur', function (Blueprint $table) {
      $table->id();
      $table->string('tahun', 4);
      $table->date('tgllibur');
      $table->string('libur_name', 100);
      $table->string('type', 50);
      $table->string('note', 200)->nullable();
      $table->tinyInteger('isreduce_leave')->comment('0=tidak mengurangi cuti tahunan,1=mengurangi cuti tahunan');
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
    Schema::dropIfExists('list_libur');
  }
}
