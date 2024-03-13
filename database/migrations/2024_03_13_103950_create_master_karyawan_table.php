<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 50)->unique();
            $table->string('nama', 150);
            $table->smallInteger('id_departemen');
            $table->smallInteger('id_divisi');
            $table->smallInteger('id_jabatan');
            $table->string('alamat', 250)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tgllahir');
            $table->tinyInteger('gender')->comment('1:LAKI-LAKI, 2:PEREMPUAN');
            $table->tinyInteger('marital')->comment('1=Tidak Menikah, 2=Menikah, 3 lainnya');
            $table->string('kebangsaan', 30);
            $table->string('agama', 30);
            $table->tinyInteger('tipeID')->comment('1:KTP, 2:PASPOR');
            $table->string('noID', 100)->nullable();
            $table->date('tglmasuk');
            $table->date('tglresign')->nullable();
            $table->string('npwp', 100)->nullable();
            $table->string('status_pajak', 10)->nullable();
            $table->tinyInteger('status_pegawai')->comment('1=direct, 2=indirect, 3=expat');
            $table->tinyInteger('status_kepegawaian')->comment('1=PKWTT, 2=PKWT, 3=daily');
            $table->string('bank_company', 100)->nullable();
            $table->string('no_rekening', 100)->nullable();
            $table->string('notelp', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->smallInteger('pendidikan');
            $table->string('jurusan', 100)->nullable();
            $table->tinyInteger('lembur_kelas')->comment('0=Not paid, 1=Production line employees, 2=Non-line employees');
            $table->tinyInteger('isactive')->comment('1=aktif, 0=non aktif (delete/resign)');

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
        Schema::dropIfExists('master_karyawan');
    }
}
