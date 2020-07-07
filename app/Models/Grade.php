<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Grade extends Model
{
	use SoftDeletes;
    use SearchableTrait;
	
    protected $fillable = ['title', 'title_bn', 'slug', 'status'];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'grades.title' => 10,
            'books.title' => 10,
            'books.writer' => 10,
        ],
        'joins' => [
            'books' => ['grades.id', 'books.grade_id'],
        ],
    ];

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
