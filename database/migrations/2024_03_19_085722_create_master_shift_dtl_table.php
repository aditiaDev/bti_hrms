<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterShiftDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_shift_dtl', function (Blueprint $table) {
            $table->id();
            $table->integer('id_shift');
            $table->tinyInteger('day');
            $table->string('shift_in', 5)->comment('Waktu Shift dimulai');
            $table->string('shift_out', 5)->comment('Waktu Shift berakhir');
            $table->tinyInteger('nextday')->comment('0=Shift berakhir dihari yg sama,1=Shift berakhir di hari selanjutnya');
            $table->string('break_in1', 5)->comment('Waktu Istirahat pertama dimulai');
            $table->string('break_out1', 5)->comment('Waktu Istirahat pertama berakhir');
            $table->string('break_in2', 5)->comment('Waktu Istirahat kedua dimulai')->nullable();
            $table->string('break_out2', 5)->comment('Waktu Istirahat kedua berakhir')->nullable();
            $table->string('break_in3', 5)->nullable();
            $table->string('break_out3', 5)->nullable();
            $table->string('break_in4', 5)->nullable();
            $table->string('break_out4', 5)->nullable();
            $table->string('break_in5', 5)->nullable();
            $table->string('break_out5', 5)->nullable();
            $table->string('break_in6', 5)->nullable();
            $table->string('break_out6', 5)->nullable();

            $table->string('break_in1_nd', 5)->comment('0=Break dimulai dihari yg sama,1=Break dimulai di hari selanjutnya')->nullable();
            $table->string('break_out1_nd', 5)->comment('0=Break berakhir dihari yg sama,1=Break berakhir di hari selanjutnya')->nullable();
            $table->string('break_in2_nd', 5)->nullable();
            $table->string('break_out2_nd', 5)->nullable();
            $table->string('break_in3_nd', 5)->nullable();
            $table->string('break_out3_nd', 5)->nullable();
            $table->string('break_in4_nd', 5)->nullable();
            $table->string('break_out4_nd', 5)->nullable();
            $table->string('break_in5_nd', 5)->nullable();
            $table->string('break_out5_nd', 5)->nullable();
            $table->string('break_in6_nd', 5)->nullable();
            $table->string('break_out6_nd', 5)->nullable();
            $table->string('workhour', 5)->comment('Jumlah Jam Kerja Shift');
            $table->string('isOT_day', 5)->comment('0=Hari kerja biasa,1=Hari Kerja OverTime');
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
        Schema::dropIfExists('master_shift_dtl');
    }
}
