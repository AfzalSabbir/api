<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\NumberHelper;

use App\Models\Book;
use App\Models\Grade;
use App\Models\WishList;

use App\Models\Upazila;
use App\Models\District;

use DB, stdClass;

class SearchController extends Controller
{
  public function __construct()
  {
      $this->bookLimit = 24;
      $this->bookItems = 24;
  }


  public function index(Request $request)
  {
    if (request()->filled('items')) {
      $items = request()->items;
    }else{
      $items = $this->bookItems;
    }

    if (request()->filled('q')) {
      $query = request()->q;
    }else{
      $query = null;
    }

    if (request()->filled('f')) {
      $filter = request()->f;
    }else{
      $filter = null;
    }

    if (request()->filled('t')) {
      $type = request()->t;
    }else{
      $type = null;
    }


    $carousel = Book::orderBy('grade_id', 'desc')
      ->orderBy('id', 'desc')
      ->where('grade_id', '!=', NULL)
      ->where('status', 1)
      ->get()
      ->groupBy('grade_id');

    /*if (strlen($query) > 0) {
      if ($type == 'new') {
        $search = Book::orderBy('id', 'desc')
          ->search($query)
          ->with('comment')
          ->with('grade')
          ->with('admin')
          ->paginate($items)
          ->toArray();
      } elseif ($type == 'free'){
        $search = Book::orderBy('title', 'asc')->where('cost', 0)
          ->search($query)
          ->with('comment')
          ->with('grade')
          ->with('admin')
          ->paginate($items)
          ->toArray();
      } else {
        $search = Book::search($query)
          ->with('comment')
          ->with('grade')
          ->with('admin')
          ->paginate($items)
          ->toArray();
      }
    }
    else {
      $search['data'] = [];
    }*/

    
    if (strlen($query) > 0 && ($filter =='books' || $filter == null)) {
      // dd($query, $filter);
      if ($type == 'new') {
        $search = Book::orderBy('id', 'desc')
          ->search($query)
          ->with('comment')
          ->with('grade')
          ->with('admin')
          ->paginate($items)
          ->toArray();
      } elseif ($type == 'free'){
        $search = Book::orderBy('title', 'asc')->where('cost', 0)
          ->search($query)
          ->with('comment')
          ->with('grade')
          ->with('admin')
          ->paginate($items)
          ->toArray();
      } else {
        $search = Book::search($query)
          ->with('comment')
          ->with('grade')
          ->with('admin')
          ->paginate($items)
          ->toArray();
      }
    }
    else if (strlen($query) > 0 && $filter =='wishes') {
      if ($type == 'new') {
        $search = WishList::orderBy('id', 'desc')
          ->search($query)
          // ->with('comment')
          ->with('grade')
          ->with('upazila')
          ->with('district')
          ->with('admin')
          ->paginate($items)
          ->toArray();
      } elseif ($type == 'free'){
        $search = WishList::orderBy('title', 'asc')->where('cost', 0)
          ->search($query)
          // ->with('comment')
          ->with('grade')
          ->with('upazila')
          ->with('district')
          ->with('admin')
          ->paginate($items)
          ->toArray();
      } else {
        $search = WishList::search($query)
          // ->with('comment')
          ->with('grade')
          ->with('upazila')
          ->with('district')
          ->with('admin')
          ->paginate($items)
          ->toArray();
      }
    }
    else {
      $search = new stdClass();
      $search->data = [];
    }

    // dd($search);

    return view('frontend.pages.search.book', compact('search', 'carousel'));
  }

}
