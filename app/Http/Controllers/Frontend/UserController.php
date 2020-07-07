<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\ImageUploadHelper;
use App\Helpers\QueryHelper;
use App\Helpers\BookHelper;
use App\Helpers\StringHelper;
use App\Helpers\NumberHelper;

use App\Models\District;
use App\Models\Upazila;
use App\Models\Grade;
use App\Models\Book;
use App\Models\BookAcceptHistory;
use App\Models\Admin;
use App\Models\WishList;

use Session;
use Auth;
use DB;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin');
    $this->initalBookItems = 24;
    $this->initalWishListItems = 24;
  }

  public function profile()
  {
    return view('frontend.pages.user.profile.view');
  }

  public function my_books()
  {
    if (request()->filled('items')) {
        $items = request()->items;
    }else{
        $items = $this->initalBookItems;
    }

    $admin_id = Auth::guard('admin')->user()->id;

    $books = Book::orderBy('id', 'desc')
              ->where('admin_id', $admin_id)
              ->paginate($items);
    $total = $books->total();

    return view('frontend.pages.user.book.my_books', compact('books', 'items', 'total'));
  }

  public function add_book()
  {
    $grades = Grade::get();
    $districts = District::orderBy(check_locale('bn') ? 'bn_name':'name', 'asc')->get();

    return view('frontend.pages.user.book.add_book', compact('grades', 'districts'));
  }

  public function store_book(Request $request)
  {
    $request->validate([
      'title'           => 'required|min:4',
      "book_condition"  => 'required',
      "district_id"     => 'required',
      "upazila_id"      => 'required',
      "grade_id"        => 'required',
      "photo"           => 'required',
      "contact"         => 'required|min:11',
      "location"        => 'required'
    ]);

    $data = $request->except(['_token', 'photo']);
    $data['admin_id'] = Auth()->guard('admin')->user()->id;
    $data['slug'] = StringHelper::createSlug($request->title, 'Book', 'slug');

    $target_location = 'public/images/books/';
    $input_name = 'photo';
    $photo = ImageUploadHelper::smartSingleImageUpload($request, $target_location, $input_name, $data['slug']);
    $data['photo'] = $target_location.'low/'.$photo;

    $book = QueryHelper::simpleInsert('Book', $data);

    if ($book) {
      Session::put('add-book', true);
    }

    session()->flash('add_message', 'Book Successfully Saved!');

    return redirect()->route('profile.my_books');
  }

  public function edit_book($slug)
  {
    $admin_id = Auth::guard('admin')->user()->id;
    $book = Book::where(['slug' => $slug])->first();

    if(!$book) abort(404);
    else if(!($book->admin_id == $admin_id)) abort(401);

    $grades = Grade::get();
    $districts = District::orderBy(check_locale('bn') ? 'bn_name':'name', 'asc')->get();
    $upazilas = Upazila::orderBy(check_locale('bn') ? 'bn_name':'name', 'asc')->where('district_id', $book->district_id)->get();

    return view('frontend.pages.user.book.edit_book', compact('book', 'grades', 'districts', 'upazilas'));
  }

  public function update_book(Request $request, $slug)
  {
    $request->validate([
      'title'           => 'required|min:4',
      "book_condition"  => 'required',
      "district_id"     => 'required',
      "upazila_id"      => 'required',
      "grade_id"        => 'required',
      "contact"         => 'required|min:11',
      "location"        => 'required'
    ]);

    $data = $request->except(['_token', 'photo']);
    $data['admin_id'] = Auth()->guard('admin')->user()->id;
    $data['slug'] = StringHelper::createSlug($request->title, 'Book', 'slug');

    // $target_location = 'public/images/books/';
    // $input_name = 'photo';
    // $photo = ImageUploadHelper::smartSingleImageUpload($request, $target_location, $input_name, $data['slug']);
    // $data['photo'] = $target_location.'low/'.$photo;

    QueryHelper::simpleUpdate('Book', $data, ['slug' => $slug]);

    session()->flash('update_message', 'Book Successfully Updated!');

    return redirect()->route('profile.my_books');
  }


  public function bell_list($slug)
  {
    $admin_id = Auth::guard('admin')->user()->id;

    $book = Book::where(['admin_id' => $admin_id, 'slug' => $slug])->first();
    if ($book) {
      // $accept_history = BookAcceptHistory::where('book_id', $book->id)->get();
      $accept_history = DB::table('book_accept_histories as histories')
        ->leftJoin('admins', 'admins.id', '=', 'histories.admin_id')
        // ->leftJoin('books', 'books.id', '=', 'histories.book_id')
        ->where(['histories.book_id' => $book->id])
        ->orderBy('histories.id', 'asc')
        ->select(
          'admins.id as admin_id',
          'admins.name as name',
          'admins.photo as photo',
          'histories.*'
        )
        ->get();
    }
    else {
      abort(401);
    }
    return view('frontend.pages.user.book.bell_book', compact('book', 'accept_history'));
  }

  public function my_wish_list()
  {
    $admin_id = Auth()->guard('admin')->user()->id;
    if (request()->filled('items')) {
        $items = request()->items;
    }else{
        $items = $this->initalWishListItems;
    }

    $carousel = BookHelper::getRightSideGrade();

    $wish_list = WishList::orderBy('id', 'desc')->where('admin_id', $admin_id)->paginate($items);
    $total = $wish_list->total();

    $grades = Grade::get();
    $districts = District::orderBy(check_locale('bn') ? 'bn_name':'name', 'asc')->get();

    return view('frontend.pages.book.wish_list', compact('wish_list', 'total', 'items', 'carousel', 'grades', 'districts'));
  }

  public function profile_setting()
  {
    return view('frontend.pages.user.profile.setting');
  }

  public function account_setting()
  {
    return view('frontend.pages.user.account.setting');
  }
}