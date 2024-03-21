<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Conf\MasterCode;
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

  public function new()
  {
    $field = MasterCode::select('field', 'code', 'desc')->where('type', 'DAYOFWEEK')->orderBy('code')->get();

    $data = [
      'parent-menu' => "Master Data",
      'child-menu' => "Master Shift",
      'title' => 'Add New Shift',
      'field' => $field,
    ];
    return view('master.m_shift.new')->with('data', $data);
  }

  public function store(Request $request)
  {
    // dd($request->all());
    $Mshift = MasterCode::select('field', 'code', 'desc')->where('type', 'DAYOFWEEK')->orderBy('code')->get();

    try {
      $libur_random = 0;
      if (isset($request->libur_random)) {
        $libur_random = $request->libur_random;
      }

      // $hdr = shiftHdr::create([
      //   'shift_name' => $request->shift_name,
      //   'libur_random' => $libur_random,
      //   'isactive' => 1,
      // ]);

      // $id_shift = $hdr->id;
      $id_shift = 1;
      $arrData = [];
      $arr = [];
      $i = 0;
      foreach ($Mshift as $key => $value) {
        $arr = [
          'id_shift' => $id_shift,
          'day' => $value->code,
          'shift_in' => $request->masuk[$i],
          'shift_out' => $request->pulang[$i],
          'break_in1' => $request->break_in1[$i],
          'break_out1' => $request->break_out1[$i],
          'break_in2' => $request->break_in2[$i],
          'break_out2' => $request->break_out2[$i],
          'break_in3' => $request->break_in3[$i],
          'break_out3' => $request->break_out3[$i],

          'break_in1_nd' => $request->break_in1_nd[$i],
          'break_out1_nd' => $request->break_out1_nd[$i],
          'break_in2_nd' => $request->break_in2_nd[$i],
          'break_out2_nd' => $request->break_out2_nd[$i],
          'break_in3_nd' => $request->break_in3_nd[$i],
          'break_out3_nd' => $request->break_out3_nd[$i],

          'isOT_day' => $request->isOT_day[$i],
          'workhour' => $request->workhour[$i],
        ];
        array_push($arrData, $arr);
        // shiftDtl::create([
        //   'id_shift' => $id_shift,
        //   'day' => $value->code,
        //   'shift_in' => $request->masuk_.$value->field,
        // ]);
        $i++;
      }

      dd($arrData);
    } catch (\Throwable $th) {
      //throw $th;
    }
  }
}
