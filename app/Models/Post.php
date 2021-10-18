<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    public function getFormattedDate($column, $format = 'd-m-Y H:h:s') {
        return Carbon::create($this->$column)->format($format);
    }
}
