<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
  public function index()
  {
  }

  public function getDivisiByDept(Request $request)
  {
    $divisi = Divisi::select('id', 'id_dept', 'divisi_name')
      ->where('isactive', 1)
      ->where('id_dept', $request->id_dept)
      ->orderBy('divisi_name')->get();

    return response()->json($divisi);
  }
}
