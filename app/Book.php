<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Book extends Model implements Searchable
{
    protected $fillable = ['name'];

    public function bookAuthor()
    {
        return $this->belongsTo('App\Author', 'author_id', 'id');
    }

    public function getCategory()
    {
        return $this->hasMany('App\Book_category', 'book_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('books.show', $this->id);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}
