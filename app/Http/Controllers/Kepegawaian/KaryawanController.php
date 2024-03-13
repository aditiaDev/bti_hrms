<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Concerns\MessageErrorAsString;
use App\Models\Kepegawaian\Karyawan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
	use MessageErrorAsString;

	public function index()
	{
		$data = [
			'parent-menu' => "Kepegawaian",
			'child-menu' => "Data Karyawan",
			'title' => 'Data Karyawan',
		];
		return view('kepegawaian.karyawan.index')->with('data', $data);
	}

	public function getall()
	{
		$data = DB::select("
		SELECT 
		A.id, A.nama, A.nik, B.dept_name, C.divisi_name, D.jabatan_name, A.notelp, A.isactive
		FROM master_karyawan AS A
		LEFT JOIN master_departemen AS B ON A.id_departemen = B.id
		LEFT JOIN master_divisi AS C ON A.id_divisi = C.id
		LEFT JOIN master_jabatan AS D ON A.id_jabatan = D.id
		ORDER BY A.nama
		");

		return json_encode(array('data' => $data));
	}
}
