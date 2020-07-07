<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\ImageUploadHelper;
use App\Helpers\NumberHelper;
use App\Helpers\StringHelper;
use App\Helpers\QueryHelper;
use App\Helpers\BookHelper;

use App\Models\Book;
use App\Models\BookVisit;
use App\Models\Grade;
use App\Models\WishList;

use App\Models\Upazila;
use App\Models\District;

use DB;
use Schema;

class BookController extends Controller
{
  public function __construct()
  {
      $this->middleware('admin')->only(['add', 'store']);
      $this->initalBookItems = 24;
      $this->initalGradeItems = 24;
      $this->initalWishListItems = 24;
  }

  public function index()
  {

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalBookItems;
    }

    $where = [
      'status'=>1
    ];
    $books = Book::orderBy('id', 'desc')
      ->where($where)
      ->paginate($items);
    $total = $books->total();

    $carousel = BookHelper::getRightSideGrade();

    return view('frontend.pages.book.index', compact('books', 'total', 'items', 'carousel'));
  }


  public function free()
  {
    if (request()->filled('items')) {
        $items = request()->items;
    }else{
        $items = $this->initalBookItems;
    }

    $where = [
      'status'=>1
    ];
    $books = Book::orderBy('id', 'desc')
      ->where('cost', '<=', 0)
      ->where($where)
      ->paginate($items);
    $total = $books->total();

    $carousel = BookHelper::getRightSideGrade();
      
    return view('frontend.pages.book.index', compact('books', 'total', 'items', 'carousel'));
  }


  public function add()
  {
    $carousel = BookHelper::getRightSideGrade();
    $grades = Grade::get();
    $districts = District::orderBy(check_locale('bn') ? 'bn_name':'name', 'asc')->get();
    return view('frontend.pages.book.add', compact('grades', 'districts', 'carousel'));
  }


  public function store(Request $request)
  {

    $request->validate([
      'title'           => 'required|min:4',
      "book_condition"  => 'required',
      "district_id"     => 'required',
      "upazila_id"      => 'required',
      "grade_id"        => 'required',
      "photo"           => 'required',
      "contact"         => 'required|min:4',
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
      Session::set('add-book', true);
    }

    session()->flash('add_message', 'Book Successfully Saved!');

    return redirect()->route('profile.my_books');
  }

  /*
    |
    | @param $slug is District slug
    | 
   */
  public function district_book($slug)
  {

    $district = District::where('slug', $slug)->first();

    if (is_null($district)) abort(404);

    if (request()->filled('items')) {
        $items = request()->items;
    }else{
        $items = $this->initalBookItems;
    }

    $where = [
      'status'=>1,
      'district_id'=>$district->id
    ];
    $books = Book::orderBy('id', 'desc')
      ->where($where)
      ->paginate($items);
    $total = $books->total();

    $carousel = BookHelper::getRightSideGrade();

    $location = 'district';

    $locations = DB::table('books')
      ->leftjoin('districts as districts', 'districts.id', '=', 'books.district_id')
      ->leftjoin('upazilas as upazilas', 'upazilas.id', '=', 'books.upazila_id')
      ->where('books.upazila_id', '>', 0)
      ->where(['books.status'=>1, 'books.deleted_at'=>NULL])
      ->where('districts.slug', $slug)
      ->select(
        'books.upazila_id as id',
        'upazilas.name as name',
        'upazilas.bn_name as name_bn',
        'upazilas.slug as slug',
        DB::raw('count(books.upazila_id) as total')
      );
    if (check_lang('bn')) {
      $locations->orderBy('name_bn', 'asc');
    } else {
      $locations->orderBy('name', 'asc');
    }

    $locations = $locations->groupBy('books.upazila_id')->get();

    return view('frontend.pages.book.location.district-view', compact('books', 'total', 'items', 'carousel', 'locations','location', 'district'));
  }

  /*
    |
    | @param $slug is Upazila slug
    | 
   */
  public function upazila_book($slug)
  {
    $upazila = Upazila::where('slug', $slug)->first();

    if (is_null($upazila)) abort(404);

    if (request()->filled('items')) {
        $items = request()->items;
    }else{
        $items = $this->initalBookItems;
    }

    $where = [
      'status'=>1,
      'upazila_id'=>$upazila->id
    ];
    $books = Book::orderBy('id', 'desc')
      ->where($where)
      ->paginate($items);
    $total = $books->total();

    $carousel = BookHelper::getRightSideGrade();

    $location = 'upazila';

    $locations = DB::table('books')
      ->leftjoin('districts as districts', 'districts.id', '=', 'books.district_id')
      ->leftjoin('upazilas as upazilas', 'upazilas.id', '=', 'books.upazila_id')
      ->where('books.upazila_id', '>', 0)
      ->where(['books.status'=>1, 'books.deleted_at'=>NULL])
      ->where('districts.slug', $slug)
      ->select(
        'books.upazila_id as id',
        'upazilas.name as name',
        'upazilas.bn_name as name_bn',
        'upazilas.slug as slug',
        DB::raw('count(books.upazila_id) as total')
      );
    if (check_lang('bn')) {
      $locations->orderBy('name_bn', 'asc');
    } else {
      $locations->orderBy('name', 'asc');
    }

    $locations = $locations->groupBy('books.upazila_id')->get();

    return view('frontend.pages.book.location.upazila-view', compact('books', 'total', 'items', 'carousel', 'locations','location', 'upazila'));
  }

  public function location_browse($location)
  {
    $table = $location.'s';

    if(!Schema::hasTable($table)) abort(404);

    $carousel = BookHelper::getRightSideGrade();

    $locations = DB::table('books')
      ->leftjoin($table.' as '.$table, $table.'.id', '=', 'books.'.$location.'_id')
      ->where('books.'.$location.'_id', '>', 0)
      ->where(['books.status'=>1, 'books.deleted_at'=>NULL])
      ->select(
        'books.'.$location.'_id as id',
        $table.'.name as name',
        $table.'.bn_name as name_bn',
        $table.'.slug as slug',
        DB::raw('count(books.'.$location.'_id) as total')
      );
    if (check_lang('bn')) {
      $locations->orderBy('name_bn', 'asc');
    } else {
      $locations->orderBy('name', 'asc');
    }

    $locations = $locations->groupBy('books.'.$location.'_id')->get();

    return view('frontend.pages.book.location.'.$location, compact('carousel', 'locations', 'location'));
  }

  public function district_2_upazila($slug)
  {
    $location = 'upazila';

    dd($slug);

    $carousel = BookHelper::getRightSideGrade();

    $locations = DB::table('books')
      ->leftjoin('districts as districts', 'districts.id', '=', 'books.district_id')
      ->leftjoin('upazilas as upazilas', 'upazilas.id', '=', 'books.upazila_id')
      ->where('books.upazila_id', '>', 0)
      ->where(['books.status'=>1, 'books.deleted_at'=>NULL])
      ->where('districts.slug', $slug)
      ->select(
        'books.upazila_id as id',
        'upazilas.name as name',
        'upazilas.bn_name as name_bn',
        'upazilas.slug as slug',
        DB::raw('count(books.upazila_id) as total')
      );
    if (check_lang('bn')) {
      $locations->orderBy('name_bn', 'asc');
    } else {
      $locations->orderBy('name', 'asc');
    }

    $locations = $locations->groupBy('books.upazila_id')->get();

    return view('frontend.pages.book.location.upazila', compact('carousel', 'locations', 'location'));
  }

  public function view($slug)
  {

    $book = Book::where('slug', $slug)->first();

    if(!$book) abort(404);

    $mac_or_ip = get_mac_or_ip();
    $admin_id = Auth()->guard('admin')->check() ? Auth()->guard('admin')->user()->id:0;

    if ($admin_id > 0) {
      $where = [
        'book_id' => $book->id,
        'admin_id' => $admin_id
      ];
    }
    else {
      $where = [
        'admin_id' => $admin_id,
        'book_id' => $book->id,
        'mac_or_ip' => $mac_or_ip
      ];
    }

    $book_visit = BookVisit::where($where)->first();

    if (is_null($book_visit)) {
      $data = [
        'book_id' => $book->id,
        'admin_id' => $admin_id,
        'mac_or_ip' => $mac_or_ip
      ];

      BookVisit::create($data);
    }

    $visits = BookVisit::where('book_id', $book->id)->get()->count();

    $carousel = BookHelper::getRightSideGrade();

    $comments = DB::table('book_comments')
      ->leftJoin('admins as admins', 'admins.id', '=', 'book_comments.admin_id')
      ->select(
        'admins.photo as photo',
        'admins.name as name',
        'admins.username as username',

        'book_comments.*'
      )
      ->where('book_comments.book_id', $book->id)
      ->where('book_comments.deleted_at', null)
      ->orderBy('book_comments.id', 'desc')
      ->get();

    // $comments = NumberHelper::diffForHumans($comments);

    return view('frontend.pages.book.view', compact('book', 'comments', 'carousel', 'visits'));
  }

  public function grade_browse($slug)
  {

    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->initalGradeItems;
    }

    $grade = Grade::where('slug', $slug)->first();
    if (!$grade) abort(404);

    $where = [
      'status'=>1,
      'grade_id'=>$grade->id
    ];
    $books = Book::orderBy('id', 'desc')
      ->where($where)
      ->paginate($items);
    $total = $books->total();

    $carousel = BookHelper::getRightSideGrade();

    return view('frontend.pages.book.grade', compact('books', 'total', 'items', 'carousel'));
  }

  public function wish_list()
  {

    if (request()->filled('items')) {
        $items = request()->items;
    }else{
        $items = $this->initalWishListItems;
    }

    $carousel = BookHelper::getRightSideGrade();

    $where = [
      'status'=>1,
    ];
    $wish_list = WishList::orderBy('id', 'desc')->where($where)->paginate($items);
    $total = $wish_list->total();

    $grades = Grade::get();
    $districts = District::orderBy(check_locale('bn') ? 'bn_name':'name', 'asc')->get();

    return view('frontend.pages.book.wish_list', compact('wish_list', 'total', 'items', 'carousel', 'grades', 'districts'));
  }

}
