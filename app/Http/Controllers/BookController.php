<?php

namespace App\Http\Controllers;

use App\Book;
use App\Author;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Book_category;
use App\Category;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $authors = Author::all();
        $selectId = 0;
        $sort = '';

        if ($request->author_id) {
            if ($request->sort) {
                if ($request->sort == 'title') {
                    $books = Book::where('author_id', $request->author_id)->orderBy('title')->get();
                    $sort = 'title';
                } else {
                    $books = Book::all();
                }
            } else {
                $books = Book::where('author_id', $request->author_id)->get();
            }
            $selectId = $request->author_id;
        } else {
            if ($request->sort) {
                if ($request->sort == 'title') {
                    $books = Book::orderBy('title')->get();
                    $sort = 'title';
                } else {
                    $books = Book::all();
                }
            } else {
                $books = Book::all();
            }
        }

        return view('book.index', compact('books', 'authors', 'selectId', 'sort'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::orderBy('surname')->limit(29)->get();
        return view('book.create', ['authors' => $authors, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'book_title' => ['required', 'min:4', 'max:64',],
                'book_isbn' => ['required', 'min:13', 'max:13'],
                'book_pages' => ['required', 'min:1', 'max:4'],
            ]
        );

        $book = new Book;
        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->portret = '';


        if ($request->hasFile('portret')) {
            $image = $request->file('portret');
            $name = $request->file('portret')->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $book->portret = $name;
        } else {
            return redirect()->route('book.create')->with('info_message', 'Neįvedėte knygos nuotraukos');
        }


        $currentCats = $book->getCategory;
        $requestCat = $request->categories;


        if ($requestCat == null) {
            return redirect()->route('book.create')->with('info_message', 'Neįvedėte knygos žanro');
        } else {
            foreach ($currentCats as $currentCat) {
                $checked = false;
                foreach ($requestCat as $newCategory) {
                    if ($currentCat->id == $newCategory) {
                        $checked = true;
                    }
                }
                if ($checked == false) {
                    $currentCat->delete();
                }
            }

            //naujos pridejimas
            foreach ($requestCat as $newCategory) {
                $checked = false;
                foreach ($currentCats as $currentCat) {
                    if ($currentCat->id == $newCategory) {
                        $checked = true;
                    }
                }
                if ($checked == false) {
                    $bookCategory = new Book_category;
                    $bookCategory->book_id = $book->id;
                    $bookCategory->category_id = $newCategory;
                    $bookCategory->save();
                }
            }

            $book->save();
            return redirect()->route('book.index')->with('success_message', 'Sekmingai įrašytas.');
        }
    }

    // public function search(Request $request)
    // {
    //     // Get the search value from the request
    //     $search = $request->input('search');

    //     // // Search in the title and body columns from the posts table
    //     // $books = Book::query()
    //     //     ->where('title', 'LIKE', "%{$search}%")
    //     //     ->orWhere('pages', 'LIKE', "%{$search}%")
    //     //     ->get();

    //     $books = Book::join('books', 'book_id', '=', 'book_categories.book_id')
    //         ->join('categories', 'category_id', '=', 'book_categories.category_id')->where('category_id', 'LIKE', "%$search%")
    //         // ->select('book_id')
    //         ->get();
    //     // $books = DB::table('books')
    //     //     ->join('book_categories', 'book_id', '=', 'book_categories.book_id')
    //     //     ->where('title', 'LIKE', "%{$search}%")
    //     //     // ->join('orders', 'users.id', '=', 'orders.user_id')
    //     //     // ->select('users.*', 'contacts.phone', 'orders.price')
    //     //     ->get();

    //     // dd(DB::getQueryLog());

    //     // Return the search view with the resluts compacted
    //     return view('book.search', compact('books'));
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Category $category)
    {
        $authors = Author::orderBy('surname')->limit(29)->get();
        // $bookCat = $book->getCategory->categoryRelation->id;
        // $book->getCategory->categoryRelation->id;
        return view('book.show', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::orderBy('surname')->limit(29)->get();
        $categories = Category::all();
        return view('book.edit', ['book' => $book, 'authors' => $authors, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate(
            [
                'book_title' => ['required', 'min:4', 'max:64',],
                'book_isbn' => ['required', 'min:13', 'max:13'],
                'book_pages' => ['required', 'min:1', 'max:4'],
            ]
        );

        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;

        if ($request->hasFile('portret')) {
            $image = $request->file('portret');
            $name = $request->file('portret')->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $book->portret = $name;
        }
        $book->save();

        $currentCats = $book->getCategory;
        $requestCat = $request->categories;
        foreach ($currentCats as $currentCat) {
            $checked = false;
            foreach ($requestCat as $newCategory) {
                if ($currentCat->id == $newCategory) {
                    $checked = true;
                }
            }
            if ($checked == false) {
                $currentCat->delete();
            }
        }

        //naujos pridejimas
        foreach ($requestCat as $newCategory) {
            $checked = false;
            foreach ($currentCats as $currentCat) {
                if ($currentCat->id == $newCategory) {
                    $checked = true;
                }
            }
            if ($checked == false) {
                $bookCategory = new Book_category;
                $bookCategory->book_id = $book->id;
                $bookCategory->category_id = $newCategory;
                $bookCategory->save();
            }
        }
        return redirect()->route('book.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success_message', 'Sėkmingai ištrinta.');
    }
}
