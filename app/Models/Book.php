<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Book extends Model
{
	use SoftDeletes;
    use SearchableTrait;


    protected $fillable = ['admin_id', 'taken_by_id', 'admin_x', 'taken_by_x', 'title', 'slug', 'writer', 'edition', 'grade_id', 'photo', 'book_condition', 'cost', 'contact', 'location', 'division_id', 'district_id', 'upazila_id', 'status'];
    
    protected $hidden = [
        'admin_id'
    ];
    
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
            'books.title' => 10,
            'books.writer' => 9,
            'grades.title' => 8,
        ],
        'joins' => [
            'grades' => ['books.grade_id', 'grades.id'],
        ],
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function comment()
    {
        return $this->hasMany(BookComment::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
    public function who_asked()
    {
        return $this->hasMany(BookAcceptHistory::class);
    }
}
