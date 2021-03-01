<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Book;
use App\Author;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Book::with('bookAuthor')->get();
        return view('home', compact('books'));
    }


    public function search(Request $request)
    {
        if ($request->input('query') != null) {
            $searchResults = (new Search())
                ->registerModel(Author::class, 'surname')
                ->registerModel(Book::class, 'title')
                ->perform($request->input('query'));

            return view('book.search', compact('searchResults'));
        } else {
            return back();
        }
    }
}
