<?php
namespace App\Helpers;

use App\Models\Book;
use DB;

class BookHelper
{

  public static function getRightSideGrade()
  {
    return Book::orderBy('grade_id', 'desc')
      ->orderBy('id', 'desc')
      ->where(
        [
          ['grade_id', '!=', NULL],
          ['status', 1]
        ]
      )
      ->get()
      ->groupBy('grade_id');
  }
}
