<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Shift\shiftDtl;
use App\Models\Master\Shift\shiftHdr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MShiftController extends Controller
{
  public function index()
  {
    $data = [
      'parent-menu' => "Master",
      'child-menu' => "Data Master Shift",
      'title' => 'Data Master Shift',
    ];
    return view('master.m_shift.index')->with('data', $data);
  }

  public function gethdrall()
  {
    $data = shiftHdr::select('id', 'shift_name', 'libur_random')->where('isactive', 1)->orderBy('shift_name')->get();

    return json_encode(array('data' => $data));
  }

  public function getdtlbyid(Request $request)
  {
    $id_shift = $request->id_shift;
    $query = "
		SELECT 
    A.id, A.day, B.desc as day_name, A.shift_in, A.shift_out, 
    A.break_in1, A.break_out1, A.break_in2, A.break_out2, A.break_in3, A.break_out3,
    A.nextday, A.workhour, A.isOT_day
    FROM master_shift_dtl A
    LEFT JOIN conf_master_code B ON A.day = B.code AND B.type='DAYOFWEEK'
    WHERE id_shift='" . $id_shift . "'
    ORDER BY day
		";

    $data = DB::select($query);

    return json_encode(array('data' => $data));
  }
}
