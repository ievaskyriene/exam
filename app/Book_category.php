<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_category extends Model
{
    public function bookRelation()
    {
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }

    public function categoryRelation()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }
}
