<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use App\Models\Admin;

use Auth;

class AxiosController extends Controller
{
  public function __construct()
  {
    $this->bookLimit = 24;
    $this->bookItems = 24;
  }

  public function register(Request $request)
  {
    $data = [
      'name'  => $request->name,
      'email' => $request->email,
      'mobile'  => $request->mobile,
      'username'  => $request->username,
      'division'  => $request->division,
      'country' => $request->country,
      'password' => '$2y$10$dSwjpyX9/3Xu8lVKy.gGmuFFPMrFkFueUrv8vVM7cmc8MYLpBIU8m',
    ];
    return Admin::create($data) ? 1:0;

    try{
      return json_encode([
        'admin' => Auth::guard('admin')->check() ? Auth::guard('admin')->user()->toArray() : null,
        'web' => Auth::guard('web')->check() ? Auth::guard('web')->user()->toArray() : null,
      ]);
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
