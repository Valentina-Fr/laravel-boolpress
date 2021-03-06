<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = ['title', 'article', 'category_id', 'user_id', 'image'];
    
    public function getFormattedDate($column, $format = 'd-m-Y H:i:s') {
        return Carbon::create($this->$column)->format($format);
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }
}
