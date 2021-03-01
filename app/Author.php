<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Author extends Model implements Searchable
{
    protected $fillable = ['name'];

    public function authorBooks()
    {
        return $this->hasMany('App\Book', 'author_id', 'id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('authors.show', $this->id);

        return new SearchResult(
            $this,
            $this->surname,
            $url
        );
    }
}
