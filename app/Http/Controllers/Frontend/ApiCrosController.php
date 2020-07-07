<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Redirect;

use App\Helpers\QueryHelper;
use App\Helpers\ImageUploadHelper;
use App\Helpers\VisitorHelper;

use App\Models\Visitor;
use App\Models\Subscriber;
use Auth, DB, Hash;

class ApiCrosController extends Controller
{
	public function __construct()
	{
		$this->middleware('cors');
		app('debugbar')->disable();
	}

	public function test()
	{
		return json_encode('asdasd');
	}

	public function getVisitor(Request $request)
	{
		return VisitorHelper::insert_visitor();
	}

	public function subscribe(Request $request)
	{
		try{
			$request->validate([
				'email' => 'required|email|unique:subscribers',
			]);

			$user = Subscriber::firstOrNew(['email' => $request->email]);
			$user->email = $request->email;
			$user->save();

			VisitorHelper::insert_visitor();

			// return redirect()->back()->with('ref', 1);
			return Redirect::to(url('/').'?ref=1');
		}
		catch (ValidationException $exception) {
			// return redirect()->back()->with('ref', 2);
			return Redirect::to(url('/').'?ref=2');
			/*return response()->json([
				'status'    => 'error',
				'message'   => 'Error',
				'errors'    => $exception->errors(),
			], 422);*/
		}
	}
}