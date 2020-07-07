<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Book;
use App\Models\Grade;
use App\Models\District;
use App\Models\Upazila;

class SitemapController extends Controller
{
  public function __construct()
  {
    app('debugbar')->disable();
  }

  public function index()
  {
    $sitemaps = ['sitemap1.xml', 'sitemap2.xml'];

    return response()
      ->view('frontend.pages.sitemap', compact('sitemaps'))
      ->header('Content-Type', 'text/xml');
  }


  public function all()
  {
    $grades     = Grade::get();
    $districts  = District::orderBy('slug', 'asc')->get();
    $upazilas   = Upazila::orderBy('slug', 'asc')->get();

    return response()
      ->view('frontend.pages.sitemap1', compact('grades', 'districts', 'upazilas'))
      ->header('Content-Type', 'text/xml');
  }


  public function book_view()
  {
    $books = Book::orderBy('title', 'asc')->get();
    return response()
      ->view('frontend.pages.sitemap2', compact('books'))
      ->header('Content-Type', 'text/xml');
  }
}
