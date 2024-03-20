<?php

namespace App\Http\Controllers\Master;

use App\Concerns\MessageErrorAsString;
use App\Http\Controllers\Controller;
use App\Models\Conf\MasterCode;
use App\Models\Master\Libur;
use App\Models\Master\MCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class LiburController extends Controller
{
  use MessageErrorAsString;
  public function index()
  {
    $tipe_libur = MasterCode::select('code', 'desc')->where('type', 'TIPE LIBUR')->orderBy('id')->get();
    $MCuti = MCuti::select('id', 'cuti_name')->where('isactive', '1')->where('id', '5')->orderBy('cuti_name')->get();

    $data = [
      'parent-menu' => "Master",
      'child-menu' => "Libur & Cuti Bersama",
      'title' => 'Data Libur & Cuti Bersama',
      'tipe_libur' => $tipe_libur,
      'MCuti' => $MCuti,
    ];
    return view('master.m_libur.index')->with('data', $data);
  }

  public function getByYear(Request $request)
  {
    $data = DB::table('list_libur AS A')
      ->join('conf_master_code AS B', 'A.type', '=', 'B.code')
      ->select('A.id', 'A.tgllibur', 'A.libur_name', 'A.type', 'B.desc', 'A.isreduce_leave')
      ->where('B.type', 'TIPE LIBUR')
      ->where('tahun', $request->tahun)
      ->orderBy('tgllibur')->get();

    return json_encode(array('data' => $data));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'tgllibur' => 'required',
      'libur_name' => 'required',
      'type' => 'required',
    ]);

    if ($validator->fails()) {
      $errorMessage = $this->getMessageAsString($validator->errors());
      return redirect()->back()->with('error', $errorMessage);
    }

    $year = date("Y", strtotime($request->tgllibur));

    try {
      Libur::create([
        'tahun' => $year,
        'tgllibur' => $request->tgllibur,
        'libur_name' => $request->libur_name,
        'type' => $request->type,
        'isreduce_leave' => $request->isreduce_leave,
        'id_cuti' => $request->id_cuti,
      ]);

      return response()->json(['status' => 'success', 'message' => 'Save Data Successfully.'], 200);
    } catch (\Illuminate\Database\QueryException $e) {
      return response()->json(['status' => 'error', 'message' => 'Error Saving Data, ' . $e->errorInfo[2]], 200);
    }
  }

  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'tgllibur' => 'required',
      'libur_name' => 'required',
      'type' => 'required',
    ]);

    if ($validator->fails()) {
      $errorMessage = $this->getMessageAsString($validator->errors());
      return redirect()->back()->with('error', $errorMessage);
    }

    $year = date("Y", strtotime($request->tgllibur));

    try {
      Libur::where('id', $request->id)
        ->update([
          'tahun' => $year,
          'tgllibur' => $request->tgllibur,
          'libur_name' => $request->libur_name,
          'type' => $request->type,
          'isreduce_leave' => $request->isreduce_leave,
          'id_cuti' => $request->id_cuti,
        ]);

      return response()->json(['status' => 'success', 'message' => 'Update Data Successfully.'], 200);
    } catch (\Illuminate\Database\QueryException $e) {
      return response()->json(['status' => 'error', 'message' => 'Error Updating Data, ' . $e->errorInfo[2]], 200);
    }
  }

  public function destroy(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);

    if ($validator->fails()) {
      $errorMessage = $this->getMessageAsString($validator->errors());
      return redirect()->back()->with('error', $errorMessage);
    }

    try {
      Libur::where('id', $request->id)->delete();

      return response()->json(['status' => 'success', 'message' => 'Delete Data Successfully.'], 200);
    } catch (\Illuminate\Database\QueryException $e) {
      return response()->json(['status' => 'error', 'message' => 'Error Deleting Data, ' . $e->errorInfo[2]], 200);
    }
  }

  public function getLiburAPI()
  {
    $client = new Client();

    $res = $client->get('https://api-harilibur.vercel.app/api?year=2025');

    $res->getHeader('content-type');
    $contents   = json_decode($res->getBody());
    dd($contents);
  }
}
