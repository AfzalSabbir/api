<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class WishList extends Model
{
	use SoftDeletes;
    use SearchableTrait;

    protected $fillable = ['admin_id', 'title', 'writer', 'edition', 'grade', 'cost', 'contact', 'location', 'division_id', 'district_id', 'upazila_id', 'description', 'visits', 'status'];

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
            'wish_lists.title' => 10,
            'wish_lists.writer' => 9,
            'grades.title' => 8,
        ],
        'joins' => [
            'grades' => ['wish_lists.grade_id', 'grades.id'],
        ],
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
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
