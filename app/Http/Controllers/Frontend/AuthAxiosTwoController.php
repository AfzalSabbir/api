<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use App\Helpers\QueryHelper;
use App\Helpers\ImageUploadHelper;

use App\Models\Book;
use App\Models\BookReport;
use App\Models\BookAcceptHistory;
use App\Models\Grade;
use App\Models\Admin;
use App\Models\WishList;
use App\Models\Message;
use App\Models\SystemMessage;
use App\Models\ReservedUsername;

use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use App\Models\InstitutionName;

use Auth, DB, Hash;

class AuthAxiosTwoController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin');
  }

  public function check()
  {
    dd(Auth::guard('admin')->check());
  }

  public function get_all(Request $request)
  {
    dd(Auth::guard('admin')->check());
  }

  public function institutions(Request $request)
  {
    return InstitutionName::get(['id', 'i_code', 'i_name']);
  }

  public function districts(Request $request)
  {
    try{
      if (get_locale('bn')) return District::select(['id', 'bn_name as name'])->orderBy('bn_name', 'asc')->get();
      else return District::select(['id', 'name'])->orderBy('name', 'asc')->get();
    }
    catch (ValidationException $exception) {
      return response()->json([
        'status'    => 'error',
        'message'   => 'Error',
        'errors'    => $exception->errors(),
      ], 422);
    }
  }

  public function upazilas(Request $request)
  {
    try{
      $request->validate([
        'district_id' => 'required'
      ]);

      if (get_locale('bn')) return Upazila::where('district_id', $request->district_id)->select(['id', 'bn_name as name', 'district_id'])->orderBy('bn_name', 'asc')->get();
      else return Upazila::where('district_id', $request->district_id)->select(['id', 'name', 'district_id'])->orderBy('name', 'asc')->get();
    }
    catch (ValidationException $exception) {
      return response()->json([
        'status'    => 'error',
        'message'   => 'Error',
        'errors'    => $exception->errors(),
      ], 422);
    }
  }

  public function unions(Request $request)
  {
    try{
      $request->validate([
        'upazila_id' => 'required'
      ]);

      if (get_locale('bn')) return Union::where('upazila_id', $request->upazila_id)->select(['id', 'bn_name as name', 'upazila_id'])->orderBy('bn_name', 'asc')->get();
      else return Union::where('upazila_id', $request->upazila_id)->select(['id', 'name', 'upazila_id'])->orderBy('name', 'asc')->get();
    }
    catch (ValidationException $exception) {
      return response()->json([
        'status'    => 'error',
        'message'   => 'Error',
        'errors'    => $exception->errors(),
      ], 422);
    }
  }

}
