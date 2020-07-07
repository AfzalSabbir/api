<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\QueryHelper;

use App\Models\Book;
use App\Models\BookReport;
use App\Models\BookAcceptHistory;
use App\Models\Grade;
use App\Models\Admin;
use App\Models\WishList;
use App\Models\Message;
use App\Models\SystemMessage;

use App\Models\Upazila;
use App\Models\District;

use Auth;
use DB;

class LiveController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin');
    $this->shortMessageLimit = 10;
    $this->initalShortMessageItems = 10;
    $this->initalMessageItems = 10;
  }

  public function search()
  {
    dd(12);
    $message_type = 2;

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalMessageItems;
    }
    $admin_id = Auth::guard('admin')->user()->id;

    $messages = DB::table('messages')
      ->leftjoin('admins as admins', 'admins.id', '=', 'messages.admin_id')
      ->leftjoin('admins as senders', 'senders.id', '=', 'messages.sender_id')
      ->where(
        [
          'messages.deleted_at' => NULL,
          'messages.admin_id' => $admin_id,
          'messages.message_type' => $message_type
        ]
      )
      ->orWhere('admin_id', '0')
      ->orderBy('messages.status')
      ->orderBy('messages.id', 'desc')
      ->select(
        'admins.name as admin_name',
        'admins.photo as admin_photo',
        'senders.name as sender_name',
        'senders.photo as sender_photo',
        'messages.*'
      )
      ->paginate($items);

    return [$messages, count(Message::where(['admin_id' => $admin_id, 'status' => 1, 'message_type' => $message_type])->get()->toArray())];
  }
