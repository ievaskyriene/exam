<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function books()
    {
        return $this->hasMany('App\Book');
    }

    public function getBooks()
    {
        return $this->hasMany('App\Book_category', 'category_id', 'id');
    }
}
