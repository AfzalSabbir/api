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

class MessageController extends Controller
{

	/**
	* Site Access
	**/
	public function __construct()
	{
		$this->middleware('admin');
		$this->initalItems = 24;
	}
	public function inbox()
	{

        if (request()->filled('items')) {
            $items = request()->items;
        }else{
            $items = $this->initalItems;
        }

		$admin_id = Auth::guard('admin')->user()->id;
		// Message::where('admin_id', $admin_id)
		// 	->where('status', '1')
		// 	->where('admin_id', '!=', '0')
		// 	->update(['status' => '2', 'updated' => time()]);

		$messages = Message::orderBy('updated', 'desc')
			->whereIn('admin_id', [$admin_id, 0])
            ->paginate($items);
			// ->get();
        $total = $messages->total();

		$system_message_ids = array();
		$system_message_count = array();
		$found = 0;
		$data_system_message['admin_id'] = Auth::guard('admin')->user()->id;

		foreach ($messages as $message) {
			if ($message->admin_id == 0) {
				$system_message_ids[$message->id] = $message->id;
			}
		}


		$system_message_messages = SystemMessage::where('admin_id', Auth::guard('admin')->user()->id)
			->where('status', '1')
			->get();

		foreach($system_message_ids as $system_message_id) {
			// dd($system_message_ids);
			$found = 0;
			foreach ($system_message_messages as $system_message_row) {
				if ($system_message_id == $system_message_row->message_notification_id) {
					// dd($system_message_row->message_notification_id);
					// $system_message_count[$system_message_row->id] = $system_message_row;
					$found = 1;
				}
			}
			if ($found == 0) {
				$data_system_message['message_notification_id'] = $system_message_id;
				// $data_system_message['status'] = 2;
				QueryHelper::simpleInsert('SystemMessage', $data_system_message);

			}
		}
		
		return view('frontend.pages.user.message.index', compact('messages', 'total', 'items'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
		'' => '',
		]);
		$data = $request->except(['_token']);
		QueryHelper::simpleInsert('Message', $data);
		session()->flash('add_message', 'Added');
		return redirect()->route('admin.message.index');
	}

	public function update(Request $request, $id)
	{
		$message_notification = Message::where('id', $id)->first();
		$this->validate($request, [
		'' => '',
		]);
		$data = $request->except(['_token']);
		$message_notification->update($data);
		session()->flash('update_message', 'Added');
		return redirect()->route('admin.message.index');
	}

	public function delete($id)
	{
		$message_notification = Message::where('id', $id)->first();
		$data['status'] = 0;
		$message_notification->update($data);
		session()->flash('deactive_message', 'Deactived');
		return redirect()->route('admin.message.index');
	}
}
