<?php


namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\ImageUploadHelper;
use App\Helpers\QueryHelper;
use App\Helpers\StringHelper;
use App\Helpers\NumberHelper;

use App\Models\Message;
use App\Models\SystemMessage;

use Auth;
use DB;

class NotificationController extends Controller
{

	/**
	* Site Access
	**/
	public function __construct()
	{
		$this->middleware('admin');
		$this->initalItems = 24;
	}
	public function history()
	{

        if (request()->filled('items')) {
            $items = request()->items;
        }else{
            $items = $this->initalItems;
        }

		$admin_id = Auth::guard('admin')->user()->id;

		$messages = Message::orderBy('updated', 'desc')
			->whereIn('admin_id', [$admin_id, 0])
            ->paginate($items);

        $total = $messages->total();
		
		return view('frontend.pages.user.notification.index', compact('messages', 'total', 'items'));
	}
}
