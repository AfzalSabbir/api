<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\BookHelper;

use App\Models\Book;
use App\Models\Grade;
use App\Models\WishList;

class LibraryController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
      $this->initalBookItems = 24;
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return abort(503);
  }

  public function privacy()
  {
    $carousel = BookHelper::getRightSideGrade();
    return view('frontend.pages.other.privacy', compact('carousel'));
  }

  public function terms()
  {
    $carousel = BookHelper::getRightSideGrade();
    return view('frontend.pages.other.terms', compact('carousel'));
  }

  public function cookies()
  {
    $carousel = BookHelper::getRightSideGrade();
    return view('frontend.pages.other.cookies', compact('carousel'));
  }

  public function home()
  {
    $take = $this->initalBookItems;

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

    $carousel = Book::orderBy('grade_id', 'desc')
      ->orderBy('id', 'desc')
      ->where('grade_id', '!=', NULL)
      ->where('status', 1)
      ->get()
      ->groupBy('grade_id')
      ->map(function($book) {
        return $book->take($this->initalBookItems);
      });

    $new = Book::orderBy('id', 'desc')
      ->where('status', 1)
      ->limit($take)
      ->get();

    $free = Book::orderBy('id', 'desc')
      ->where('status', 1)
      ->where('cost', 0)
      ->limit($take)
      ->get();

    return request()->dev == 1 ? view('frontend.pages.home', compact('books', 'total', 'items', 'carousel', 'new', 'free')):view('coming');
  }

  public function about()
  {
    $carousel = BookHelper::getRightSideGrade();
    return view('frontend.pages.about', compact('carousel'));
  }
}
