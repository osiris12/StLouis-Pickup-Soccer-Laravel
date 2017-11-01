<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
