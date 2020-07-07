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

use App\Models\Upazila;
use App\Models\District;

use Auth, DB, Hash;

class AuthAxiosController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin');
    $this->shortMessageLimit = 10;
    $this->initalShortMessageItems = 10;
    $this->initalMessageItems = 10;
    $this->initalShortNotificationItems = 20;
    $this->initalNotificationItems = 20;
  }

  public function upazila($id)
  {
    return Upazila::orderBy(check_locale('bn') ? 'bn_name':'name', 'asc')->where('district_id', $id)->get();
  }

  public function delete_book($base64_id)
  {
    if (Auth::guard('admin')->check()) {
    	$id = decode_base64($base64_id);
    	$admin_id = Auth::guard('admin')->user()->id;
    	$book = Book::where('id', $id);
    	
      if (is_null($book->first())) abort(404);

    	if ($book->first()->admin_id == $admin_id) {
    		return $book->delete();
    	} else {
    		return 0;
    	}
    } else {
      return 0;
    }
  }

  public function report_book($base64_id)
  {
    if (Auth::guard('admin')->check()) {
      $admin_id = Auth::guard('admin')->user()->id;
      $id = decode_base64($base64_id);

      $report = BookReport::firstOrNew(['admin_id' => $admin_id, 'book_id' => $id]);
      // $report->foo = $request->foo;
      $report->save();
      return 1;

    } else {
      return 0;
    }
  }

  public function bell_book($base64_id)
  {
    if(Auth::guard('admin')->check()){
      $id = decode_base64($base64_id);
      $row = Book::where('id', $id)->first();

      $data['admin_id'] = Auth::guard('admin')->user()->id;
      $data['book_id'] = $row->id;
      $data['status'] = 1;

      $admin_row = Admin::where('id', $data['admin_id'])->first();

      $book = BookAcceptHistory::where('admin_id', $data['admin_id'])
        ->where('book_id', $data['book_id'])
        ->first();

      function send_message_notification($admin_row, $row, $data, $book_history_id){
        $data_message['message_subject'] = $row->title;
        $data_message['message_body'] = $admin_row->name.' is interested for the book: <strong><a href="/book/view/'.$row->slug.'">'.$row->title.'</a></strong>.<br> <code class="text-primary">-BoiNaw Team</code>';
        $data_message['admin_id'] = $row->admin_id;
        $data_message['message_type'] = 2;
        $data_message['book_id'] = $row->id;
        $data_message['book_accept_history_id'] = $book_history_id;
        $data_message['status'] = 1;

        QueryHelper::simpleInsert('Message', $data_message);
      }

      if ($book) {
        return 2;
        
        $book_history_id = $book->id;
        send_message_notification($admin_row, $row, $data, $book_history_id);
      }
      else {
        $book_history_id = QueryHelper::simpleInsert('BookAcceptHistory', $data);
        send_message_notification($admin_row, $row, $data, $book_history_id);
      }
      return 1;
    } else {
      return 0;
    }
  }
  public function confirm_bell_book($id, $admin_id)
  {
    if(Auth::guard('admin')->check()){
      $id = decode_base64($id);

      $admin_id = decode_base64($admin_id);

      $row = Book::where('id', $id)->first();
      $book_history = BookAcceptHistory::where('book_id', $row->id)
        ->where('admin_id', $admin_id)
        ->first();

      $admin_row = Admin::where('id', $admin_id)->first();
      $giver = \Auth::guard('admin')->user();

      $data_history['status'] = 2;
      $data['status'] = 2;
      $data['taken_by_id'] = $admin_id;

      if (!$book_history) {
        return redirect()->route('errors.404');
      }

      $book_history_id = $book_history->id;

      $row_taken_by_id = $row->taken_by_id;
      $book_history->update($data_history);
      $row->update($data);

      function send_message_notification($giver, $admin_row, $row, $data, $book_history_id){
        $data_message['message_subject'] = $row->title;
        $data_message['message_body'] = 'Hi '.$admin_row->name.', '.$giver->name.' has selected you for the book: <strong><a href="/book/view/'.$row->slug.'">'.$row->title.'</a></strong>. Contact No.: '.$row->contact.'.<br> <code class="text-primary">-BoiNaw Team</code>';
        $data_message['admin_id'] = $data['taken_by_id'];
        $data_message['message_type'] = 2;
        $data_message['book_id'] = $row->id;
        $data_message['book_accept_history_id'] = $book_history_id;
        $data_message['status'] = 1;

        QueryHelper::simpleInsert('Message', $data_message);
      }
      if ($book_history) {
        if ($row_taken_by_id == 0) {
          send_message_notification($giver, $admin_row, $row, $data, $book_history_id);
        }
      }else{
        $book_history_id = QueryHelper::simpleInsert('BookAcceptHistory', $data);

        if ($row_taken_by_id == 0) {
          send_message_notification($giver, $admin_row, $row, $data, $book_history_id);
        }
      }
      return 1;
    } else {
      return 0;
    }
  }


  public function short_notification(Request $request)
  {

    $message_type = 3;

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalShortNotificationItems;
    }

    $admin_id = Auth::guard('admin')->user()->id;
    if ($request->readAll) {
      Message::where(['admin_id' => $admin_id, 'message_type' => $message_type])->update(['status' => 2, 'updated' => time()]);
    }
    $messages = DB::table('messages')
      ->whereIn('messages.admin_id', [$admin_id, 0])
      ->leftjoin('admins as senders', 'senders.id', '=', 'messages.sender_id')
      ->leftjoin('admins', 'admins.id', '=', 'messages.admin_id')
      ->where(
        [
          'messages.deleted_at' => NULL,
          'messages.admin_id' => $admin_id,
          'messages.message_type' => $message_type
        ]
      )
      // ->orWhere('messages.admin_id', '0')
      ->orderBy('messages.status')
      ->orderBy('messages.id', 'desc')
      ->select(
        'senders.name as admin_name',
        'senders.photo as admin_photo',
        'messages.*'
      )
      ->paginate($items);
      
    return [$messages, count(Message::where(['admin_id' => $admin_id, 'status' => 1, 'message_type' => $message_type])->get()->toArray())];
    $id = decode_base64($base64_id);
    
    if ($book->first()->admin_id == $admin_id) {
      return $book->delete();
    } else {
      return 0;
    }
  }

  public function short_inbox(Request $request)
  {

    $message_type = 2;

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalShortMessageItems;
    }

    $admin_id = Auth::guard('admin')->user()->id;
    if ($request->readAll) {
      Message::where(['admin_id' => $admin_id, 'message_type' => $message_type])->update(['status' => 2, 'updated' => time()]);
    }
    $messages = DB::table('messages')
      // ->leftjoin('admins', 'admins.id', '=', 'messages.admin_id')
      ->whereIn('messages.admin_id', [$admin_id, 0])
      ->leftjoin('admins as senders', 'senders.id', '=', 'messages.sender_id')
      ->leftjoin('admins', 'admins.id', '=', 'messages.admin_id')
      ->where(
        [
          'messages.deleted_at' => NULL,
          'messages.admin_id' => $admin_id,
          'messages.message_type' => $message_type
        ]
      )
      // ->orWhere('messages.admin_id', '0')
      ->orderBy('messages.status')
      ->orderBy('messages.id', 'desc')
      ->select(
        'senders.name as admin_name',
        'senders.photo as admin_photo',
        'messages.*'
      )
      ->paginate($items);
      
    // $messages = Message::where('admin_id', $admin_id)->orderBy('id')->limit($this->shortMessageLimit)->get();
    return [$messages, count(Message::where(['admin_id' => $admin_id, 'status' => 1, 'message_type' => $message_type])->get()->toArray())];
    $id = decode_base64($base64_id);
    
    if ($book->first()->admin_id == $admin_id) {
      return $book->delete();
    } else {
      return 0;
    }
  }

  public function read_this_message(Request $request, $id, $status)
  {
    $id = decode_base64($id);
    $status = decode_base64($status);
    $message_type = 2;

    $admin_id = Auth::guard('admin')->user()->id;

    return Message::where(['admin_id' => $admin_id, 'id' => $id])->update(['status' => $status, 'updated' => time()]);
  }

  public function read_this_notification(Request $request, $id, $status)
  {
    $id = decode_base64($id);
    $status = decode_base64($status);
    $message_type = 3;

    $admin_id = Auth::guard('admin')->user()->id;

    return Message::where(['admin_id' => $admin_id, 'id' => $id])->update(['status' => $status, 'updated' => time()]);
  }


  public function read_all_message()
  {
    
    $message_type = 2;

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalMessageItems;
    }
    $admin_id = Auth::guard('admin')->user()->id;

    Message::where(['admin_id' => $admin_id, 'message_type' => $message_type])->update(['status' => 2, 'updated' => time()]);

    $messages = DB::table('messages')
      ->whereIn('messages.admin_id', [$admin_id, 0])
      ->leftjoin('admins as admins', 'admins.id', '=', 'messages.admin_id')
      ->leftjoin('admins as senders', 'senders.id', '=', 'messages.sender_id')
      ->where(
        [
          'messages.deleted_at' => NULL,
          'messages.admin_id' => $admin_id,
          'messages.message_type' => $message_type
        ]
      )
      // ->orWhere('messages.admin_id', '0')
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

  public function read_all_notification()
  {
    
    $message_type = 3;

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalMessageItems;
    }
    $admin_id = Auth::guard('admin')->user()->id;

    Message::where(['admin_id' => $admin_id, 'message_type' => $message_type])->update(['status' => 2, 'updated' => time()]);

    $messages = DB::table('messages')
      ->whereIn('messages.admin_id', [$admin_id, 0])
      ->leftjoin('admins as admins', 'admins.id', '=', 'messages.admin_id')
      ->leftjoin('admins as senders', 'senders.id', '=', 'messages.sender_id')
      ->where(
        [
          'messages.deleted_at' => NULL,
          'messages.admin_id' => $admin_id,
          'messages.message_type' => $message_type
        ]
      )
      // ->orWhere('messages.admin_id', '0')
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

  public function message_search(Request $request)
  {
    $message_type = 2;
    $q = $request->q;

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalMessageItems;
    }
    $admin_id = Auth::guard('admin')->user()->id;

    $messages = DB::table('messages')
      ->whereIn('messages.admin_id', [$admin_id, 0])
      ->where(
        [
          'messages.deleted_at' => NULL,
          'messages.message_type' => $message_type
        ]
      )
      // DB::table('users')->where(fn($query) => $query->where('activated', '=', $activated))->get()
      ->leftjoin('admins as admins', 'admins.id', '=', 'messages.admin_id')
      ->leftjoin('admins as senders', 'senders.id', '=', 'messages.sender_id')
      ->where(function($w) use ($q) {
        $w->where('messages.message_subject', 'like', '%'.$q.'%')
          ->orWhere('messages.message_body', 'like', '%'.$q.'%')
          ->orWhere('senders.name', 'like', $q.'%');
      })
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

  public function notification_search(Request $request)
  {
    $message_type = 3;
    $q = $request->q;

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalNotificationItems;
    }
    $admin_id = Auth::guard('admin')->user()->id;

    $messages = DB::table('messages')
      ->whereIn('messages.admin_id', [$admin_id, 0])
      ->where(
        [
          'messages.deleted_at' => NULL,
          'messages.message_type' => $message_type
        ]
      )
      // DB::table('users')->where(fn($query) => $query->where('activated', '=', $activated))->get()
      ->leftjoin('admins as admins', 'admins.id', '=', 'messages.admin_id')
      ->leftjoin('admins as senders', 'senders.id', '=', 'messages.sender_id')
      ->where(function($w) use ($q) {
        $w->where('messages.message_subject', 'like', '%'.$q.'%')
          ->orWhere('messages.message_body', 'like', '%'.$q.'%')
          ->orWhere('senders.name', 'like', $q.'%');
      })
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

  public function inbox()
  {
    $message_type = 2;

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalMessageItems;
    }
    $admin_id = Auth::guard('admin')->user()->id;

    $messages = DB::table('messages')
      ->whereIn('messages.admin_id', [$admin_id, 0])
      ->leftjoin('admins as admins', 'admins.id', '=', 'messages.admin_id')
      ->leftjoin('admins as senders', 'senders.id', '=', 'messages.sender_id')
      ->where(
        [
          'messages.deleted_at' => NULL,
          'messages.admin_id' => $admin_id,
          'messages.message_type' => $message_type
        ]
      )
      // ->orWhere('messages.admin_id', '0')
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

  public function history()
  {
    $message_type = 3;

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalMessageItems;
    }
    $admin_id = Auth::guard('admin')->user()->id;

    $messages = DB::table('messages')
      ->whereIn('messages.admin_id', [$admin_id, 0])
      ->leftjoin('admins as admins', 'admins.id', '=', 'messages.admin_id')
      ->leftjoin('admins as senders', 'senders.id', '=', 'messages.sender_id')
      ->where(
        [
          'messages.deleted_at' => NULL,
          'messages.admin_id' => $admin_id,
          'messages.message_type' => $message_type
        ]
      )
      // ->orWhere('messages.admin_id', '0')
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

  public function delete_this_message(Request $request)
  {
    $id = decode_base64($request->base64_id);
    $admin_id = Auth::guard('admin')->user()->id;

    $message = Message::where('id', $id);
    if ($message->first()->admin_id == $admin_id) {
      $message->delete();

      $message_type = 2;

      if (request()->filled('items')) {
        $items = request()->items;
      }else{
        $items = $this->initalMessageItems;
      }

      $messages = DB::table('messages')
      ->whereIn('messages.admin_id', [$admin_id, 0])
      ->leftjoin('admins as admins', 'admins.id', '=', 'messages.admin_id')
      ->leftjoin('admins as senders', 'senders.id', '=', 'messages.sender_id')
      ->where(
        [
          'messages.deleted_at' => NULL,
          'messages.admin_id' => $admin_id,
          'messages.message_type' => $message_type
        ]
      )
      // ->orWhere('messages.admin_id', '0')
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

    } else {
      return 0;
    }
  }

  public function store_wish(Request $request)
  {
    if (Auth()->guard('admin')->check()) {
      $admin_id = Auth()->guard('admin')->user()->id;
      $wished = WishList::where(['title' => $request->title, 'admin_id' => $admin_id ])->first();
      if (!$wished) {
        $request->validate([
          "contact"         => 'required|min:4',
          "grade_id"        => 'required',
          "district_id"     => 'required',
          "upazila_id"      => 'required',
          'title'           => 'required|min:4',
          'edition'         => 'required',
          'writer'          => 'required|min:4',
          "cost"            => 'required|numeric',
          "location"        => 'required',
          "description"     => 'required'
        ]);

        $data = $request->except(['_token']);
        $data['admin_id'] = $admin_id;

        $wish = QueryHelper::simpleInsert('WishList', $data);
        
        if ($wish) {
          return 1;
        }
        return 0;
      }
      return $wished;
    }
    return 0;
  }

  public function get_profile(Request $request)
  {
    if (Auth::guard('admin')->check()) {
      return Auth::guard('admin')->user();
    } else {
      return 0;
    }
  }

  public function upload_profile_image(Request $request)
  {
    return $request;
    if (Auth::guard('admin')->check()) {
      return Auth::guard('admin')->user();
    } else {
      return 0;
    }
  }


  public function profile_password_change(Request $request)
  {
    $admin = Auth::guard('admin');
    if (!$admin->check()) return abort(401);

    $admin = $admin->user();

    if (Hash::check($request->pass_old, $admin->password)) {

      if ($request->pass_new == $request->pass_conf) {

        $data = [
          'password'=> Hash::make($request->pass_new)
        ];

        $request->validate([
          'pass_new'=> 'required|min:6|same:pass_conf'
        ]);
        Auth::guard('admin')->logout();
        return Admin::where('id', $admin->id)->update($data);

      } else {
        return 2;
      }
    } else {
      return 0;
    }

  }
  public function profile_photo_update(Request $request)
  {

    try {
      $admin = Auth::guard('admin')->user();
      $id = $admin->id;
      $username = $admin->username;

      $this->validate(
        $request,
        [
          'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1200',
          'old_image'=> 'required'
        ],
        [],
        [
          'image'=> __('backend/default.photo'),
          'old_image'=> __('backend/default.old_photo')
        ]
      );

      $target_location = 'public/images/admins/';
      $input_name = 'image';
      $photo = ImageUploadHelper::profilePhotoUpdate($request, $target_location, $input_name, $username);
      $photo = $target_location.'low/'.$photo;

      Admin::where('id', $id)->update(['photo'=> $photo]);
      return $photo;

    }
    catch (ValidationException $exception) {
      return response()->json([
        'status'    => 'error',
        'message'   => 'Error',
        'errors'    => $exception->errors(),
      ], 422);
    }
  }
  public function profile_update(Request $request)
  {
    try {
      $admin = Auth::guard('admin')->user();
      $id = $admin->id;
      
      $this->validate($request, [
        'user_name'=> 'required|min:4|max:191',
        'user_email'=> 'required|email|max:191|unique:admins,email,'.$id,
        'user_mobile'=> 'required|min:11|unique:admins,mobile,'.$id,
      ], [], [
        'user_name'     => __('backend/default.name'),
        'user_email'    => __('backend/default.email'),
        'user_mobile'   => __('backend/default.mobile')
      ]);

      $data = [
        'email'=> $request->user_email,
        'mobile'=> $request->user_mobile,
        'name'=> $request->user_name
      ];


      if ($admin->id != decode_base64($request->ref)) return abort(401);
      else return Admin::where('id', $admin->id)->update($data);

    }
    catch (ValidationException $exception) {
      return response()->json([
        'status'    => 'error',
        'message'   => 'Error',
        'errors'    => $exception->errors(),
      ], 422);
    }
  }
  public function personal_profile_update(Request $request)
  {
    try {
      $admin = Auth::guard('admin')->user();
      $id = $admin->id;
      
      $this->validate($request, [
        'profession'          => 'required',
        'institution_name_id' => 'required',
        'district_id'         => 'nullable|numeric|min:1',
        'upazila_id'          => 'nullable|numeric|min:1',
        'union_id'            => 'nullable|numeric|min:1',
        'address'             => 'required',
      ], [], [
        'profession'              => __('backend/default.profession'),
        'institution_name_id'     => __('backend/default.institution'),
        'district_id'             => __('backend/default.district'),
        'upazila_id'              => __('backend/default.upazila'),
        'union_id'                => __('backend/default.union'),
        'address'                 => __('backend/default.address')
      ]);

      $data = [
        'profession'=> $request->profession,
        'institution_name_id'=> $request->institution_name_id,
        'district_id'=> $request->district_id,
        'upazila_id'=> $request->upazila_id,
        'union_id'=> $request->union_id,
        'address'=> $request->address
      ];


      if ($admin->id != decode_base64($request->ref)) return abort(401);
      else return Admin::where('id', $admin->id)->update($data);

    }
    catch (ValidationException $exception) {
      return response()->json([
        'status'    => 'error',
        'message'   => 'Error',
        'errors'    => $exception->errors(),
      ], 422);
    }
  }

  public function profile_validate(Request $request)
  {
    $admin = Auth::guard('admin')->user();

    if ($request->field == 'mobile') {

      $mobile = Admin::where([
          ['mobile', $request->data],
          ['mobile', '!=', $admin->mobile]
        ])
        ->first();

      if ($mobile) {
        return 2;
      }

      return 0;
    }

    if ($request->field == 'email') {

      $email = Admin::where([
          ['email', $request->data],
          ['email', '!=', $admin->email]
        ])
        ->first();

      if ($email) {
        return 2;
      }

      return 0;
    }
    
    return -1;
  }

}
