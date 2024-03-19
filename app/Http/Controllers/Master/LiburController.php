<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LiburController extends Controller
{
  public function index()
  {
    $data = [
      'parent-menu' => "Master",
      'child-menu' => "Libur & Cuti Bersama",
      'title' => 'Data Libur & Cuti Bersama',
    ];
    return view('master.m_libur.index')->with('data', $data);
  }

  public function getByYear(Request $request)
  {
  }
}
