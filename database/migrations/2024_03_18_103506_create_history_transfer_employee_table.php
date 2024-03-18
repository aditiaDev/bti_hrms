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
      $table->integer('id_karyawan');
      $table->date('tglmutasi');
      $table->string('fr_nik', 50);
      $table->string('to_nik', 50);
      $table->tinyInteger('type')->comment('0=Transfer,1=Promosi,2=Demosi');
      $table->smallInteger('fr_departemen');
      $table->smallInteger('fr_divisi');
      $table->smallInteger('fr_jabatan');
      $table->tinyInteger('fr_status_pegawai')->comment('1=direct, 2=indirect, 3=expat');
      $table->tinyInteger('fr_status_kepegawaian')->comment('1=PKWTT, 2=PKWT, 3=daily');
      $table->smallInteger('to_departemen');
      $table->smallInteger('to_divisi');
      $table->smallInteger('to_jabatan');
      $table->tinyInteger('to_status_pegawai')->comment('1=direct, 2=indirect, 3=expat');
      $table->tinyInteger('to_status_kepegawaian')->comment('1=PKWTT, 2=PKWT, 3=daily');
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
