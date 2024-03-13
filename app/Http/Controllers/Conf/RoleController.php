<?php

namespace App\Http\Controllers\Conf;

use App\Http\Controllers\Controller;
use App\Concerns\MessageErrorAsString;
use App\Models\Conf\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
  use MessageErrorAsString;

  public function index()
  {
    $data = [
      'parent-menu' => "Konfigurasi",
      'child-menu' => "User Role",
      'title' => 'Data User Role',
    ];
    return view('config.role.index')->with('data', $data);
  }

  public function getall()
  {
    $data = Role::all();
    return json_encode(array('data' => $data));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'role_name' => 'required',
      'isactive' => 'required',
    ]);

    if ($validator->fails()) {
      $errorMessage = $this->getMessageAsString($validator->errors());
      return redirect()->back()->with('error', $errorMessage);
    }

    try {
      Role::create([
        'role_name' => $request->role_name,
        'isactive' => $request->isactive,
      ]);

      return response()->json(['status' => 'success', 'message' => 'Save Data Successfully.'], 200);
    } catch (\Illuminate\Database\QueryException $e) {
      return response()->json(['status' => 'error', 'message' => 'Error Saving Data, ' . $e->errorInfo[2]], 200);
    }
  }

  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required',
      'role_name' => 'required',
      'isactive' => 'required',
    ]);

    if ($validator->fails()) {
      $errorMessage = $this->getMessageAsString($validator->errors());
      return redirect()->back()->with('error', $errorMessage);
    }

    try {
      Role::where('id', $request->id)
        ->update([
          'role_name' => $request->role_name,
          'isactive' => $request->isactive,
        ]);
      return response()->json(['status' => 'success', 'message' => 'Save Data Successfully.'], 200);
    } catch (\Illuminate\Database\QueryException $e) {
      return response()->json(['status' => 'error', 'message' => 'Error Saving Data, ' . $e->errorInfo[2]], 200);
    }
  }

  public function changeStatus(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required',
      'isactive' => 'required',
    ]);

    if ($validator->fails()) {
      $errorMessage = $this->getMessageAsString($validator->errors());
      return redirect()->back()->with('error', $errorMessage);
    }

    try {
      Role::where('id', $request->id)
        ->update([
          'isactive' => $request->isactive,
        ]);
      return response()->json(['status' => 'success', 'message' => 'Save Data Successfully.'], 200);
    } catch (\Illuminate\Database\QueryException $e) {
      return response()->json(['status' => 'error', 'message' => 'Error Saving Data, ' . $e->errorInfo[2]], 200);
    }
  }
}
