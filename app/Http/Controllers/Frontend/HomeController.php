<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\BookHelper;

use App\Models\Book;
use App\Models\Grade;
use App\Models\WishList;

use Auth;

class HomeController extends Controller
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
    return view('frontend.pages.index');
  }

  public function contact_us()
  {
    return 'Working on..';
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
    return redirect()->route('api.register');
    
  }

  public function api_logout()
  {
    Auth::guard('admin')->logout();
    return redirect()->route('register');

  }

  public function about()
  {
    $carousel = BookHelper::getRightSideGrade();
    return view('frontend.pages.about', compact('carousel'));
  }
}
