<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Concerns\MessageErrorAsString;
use App\Models\Conf\MasterCode;
use App\Models\Kepegawaian\Karyawan;
use App\Models\Master\Departemen;
use App\Models\Master\Jabatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
	use MessageErrorAsString;

	public function index()
	{
		$dept = Departemen::select('id', 'dept_name')->where('isactive', 1)->orderBy('dept_name')->get();
		$jabatan = Jabatan::select('id', 'jabatan_name')->where('isactive', 1)->orderBy('jabatan_name')->get();

		$data = [
			'parent-menu' => "Kepegawaian",
			'child-menu' => "Data Karyawan",
			'title' => 'Data Karyawan',
			'dept' => $dept,
			'jabatan' => $jabatan,
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

	public function new()
	{
		$dept = Departemen::select('id', 'dept_name', 'prefix')->where('isactive', 1)->orderBy('dept_name')->get();
		$jabatan = Jabatan::select('id', 'jabatan_name')->where('isactive', 1)->orderBy('jabatan_name')->get();
		$lembur_kelas = MasterCode::select('code', 'desc')->where('type', 'LEMBUR KELAS')->orderBy('id')->get();
		$agama = MasterCode::select('code', 'desc')->where('type', 'AGAMA')->orderBy('id')->get();
		$status_pajak = MasterCode::select('code', 'desc')->where('type', 'STATUS PAJAK')->orderBy('id')->get();
		$tipeID = MasterCode::select('code', 'desc')->where('type', 'TIPE ID')->orderBy('id')->get();
		$bank = MasterCode::select('code', 'desc')->where('type', 'BANK')->orderBy('id')->get();
		$pendidikan = MasterCode::select('code', 'desc')->where('type', 'PENDIDIKAN')->orderBy('id')->get();
		$marital = MasterCode::select('code', 'desc')->where('type', 'MARITAL')->orderBy('id')->get();
		$status_kepegawaian = MasterCode::select('code', 'desc')->where('type', 'STATUS KEPEGAWAIAN')->orderBy('id')->get();
		$status_pegawai = MasterCode::select('code', 'desc')->where('type', 'STATUS PEGAWAI')->orderBy('id')->get();

		$data = [
			'parent-menu' => "Kepegawaian",
			'child-menu' => "Data Karyawan",
			'title' => 'Add New Karyawan',
			'dept' => $dept,
			'jabatan' => $jabatan,
			'lembur_kelas' => $lembur_kelas,
			'agama' => $agama,
			'status_pajak' => $status_pajak,
			'tipeID' => $tipeID,
			'bank' => $bank,
			'pendidikan' => $pendidikan,
			'marital' => $marital,
			'status_kepegawaian' => $status_kepegawaian,
			'status_pegawai' => $status_pegawai,
		];
		return view('kepegawaian.karyawan.new')->with('data', $data);
	}

	public function generateNIK(Request $request)
	{
		$dept = Departemen::select('prefix', 'digit_number')
			->where('id', $request->dept)
			->get()->toArray();

		$prefix = $dept[0]['prefix'];
		$digit_number = $dept[0]['digit_number'];
		$jml_prefix = strlen($prefix);

		$last_no = Karyawan::where('nik', 'like', $prefix . '%')
			->max('nik');

		$urutan = (int) substr($last_no, $jml_prefix, $digit_number);
		$urutan++;

		$huruf = $prefix;
		$kode = $huruf . sprintf("%0" . $digit_number . "s", $urutan);

		return $kode;
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nik' => 'required|unique:master_karyawan,nik',
			'nama' => 'required',
			'id_departemen' => 'required',
			'id_divisi' => 'required',
			'id_jabatan' => 'required',
			'tgllahir' => 'required',
			'gender' => 'required',
			'marital' => 'required',
			'kebangsaan' => 'required',
			'agama' => 'required',
			'tipeID' => 'required',
			'tglmasuk' => 'required',
			'pendidikan' => 'required',
			'lembur_kelas' => 'required',
			'isactive' => 'required',
		]);

		if ($validator->fails()) {
			$errorMessage = $this->getMessageAsString($validator->errors());
			return response()->json(['status' => 'error', 'message' => $errorMessage], 400);
		}

		try {
			Karyawan::create([
				'nik' => $request->nik,
				'nama' => $request->nama,
				'id_departemen' => $request->id_departemen,
				'id_divisi' => $request->id_divisi,
				'id_jabatan' => $request->id_jabatan,
				'alamat' => $request->alamat,
				'tempat_lahir' => $request->tempat_lahir,
				'tgllahir' => $request->tgllahir,
				'gender' => $request->gender,
				'marital' => $request->marital,
				'kebangsaan' => $request->kebangsaan,
				'agama' => $request->agama,
				'tipeID' => $request->tipeID,
				'noID' => $request->noID,
				'tglmasuk' => $request->tglmasuk,
				'tglresign' => $request->tglresign,
				'npwp' => $request->npwp,
				'status_pajak' => $request->status_pajak,
				'status_pegawai' => $request->status_pegawai,
				'status_kepegawaian' => $request->status_kepegawaian,
				'bank_company' => $request->bank_company,

				'no_rekening' => $request->no_rekening,
				'notelp' => $request->notelp,
				'email' => $request->email,
				'pendidikan' => $request->pendidikan,
				'jurusan' => $request->jurusan,
				'lembur_kelas' => $request->lembur_kelas,
				'isactive' => $request->isactive,
			]);

			return response()->json(['status' => 'success', 'message' => 'NIK ' . $request->nik . ', Data Saved Successfully'], 200);
		} catch (\Illuminate\Database\QueryException $e) {
			return response()->json(['status' => 'error', 'message' => 'Error Saving Data, ' . $e->errorInfo[2]], 200);
		}
	}

	public function changeStatus(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'act' => 'required',
			'id' => 'required',
		]);

		if ($validator->fails()) {
			$errorMessage = $this->getMessageAsString($validator->errors());
			return response()->json(['status' => 'error', 'message' => $errorMessage], 400);
		}

		$nik = Karyawan::where('id', $request->id)->max('nik');

		try {
			Karyawan::where('id', $request->id)->update(['isactive' => $request->act]);

			return response()->json(['status' => 'success', 'message' => 'NIK ' . $request->nik . ', Data Update Successfully'], 200);
		} catch (\Illuminate\Database\QueryException $e) {
			return response()->json(['status' => 'error', 'message' => 'Error Updating Data, ' . $e->errorInfo[2]], 200);
		}
	}
}
