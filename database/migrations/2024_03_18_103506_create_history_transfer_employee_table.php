<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTransferEmployeeTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('history_transfer_employee', function (Blueprint $table) {
      $table->id();
      $table->string('nik', 50);
      $table->date('tanggal_mutasi');
      $table->tinyInteger('type')->comment('0=Transfer,1=Promosi,2=Demosi');
      $table->smallInteger('id_departemen');
      $table->smallInteger('id_divisi');
      $table->smallInteger('id_jabatan');
      $table->tinyInteger('status_pegawai')->comment('1=direct, 2=indirect, 3=expat');
      $table->tinyInteger('status_kepegawaian')->comment('1=PKWTT, 2=PKWT, 3=daily');
      $table->string('note', 500)->nullable();
      $table->timestamp('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('history_transfer_employee');
  }
}
