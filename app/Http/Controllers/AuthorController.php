<?php

namespace App\Http\Controllers;

use App\Author;
use Validator;
use Illuminate\Http\Request;

class AuthorController extends Controller
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
    public function index()
    {
        // $authors = Author::all();
        $authors = Author::orderBy('surname')->limit(29)->get();
        return view('author.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
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
                'author_name' => ['required', 'min:4', 'max:64'],
                'author_surname' => ['required', 'min:3', 'max:64'],
            ],
        );

        $author = new Author;
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;

        $author->portret = '';

        if ($request->hasFile('portret')) {
            $image = $request->file('portret');
            $name = $request->file('portret')->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $author->portret = $name;
        }
        $author->save();
        return redirect()->route('author.index')->with('success_message', 'Sėkmingai sukurtas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('author.show', ['author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $request->validate(
            [
                'author_name' => ['required', 'min:4', 'max:64'],
                'author_surname' => ['required', 'min:3', 'max:64'],
            ],
        );


        $author->name = $request->author_name;
        $author->surname = $request->author_surname;

        if ($request->hasFile('portret')) {
            $image = $request->file('portret');
            $name = $request->file('portret')->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $author->portret = $name;
        } else {
            return redirect()->route('author.index')->with('success_message', 'Sėkmingai pakeistas.');
        }

        $author->save();
        return redirect()->route('author.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if ($author->authorBooks->count()) {
            return redirect()->route('author.index')->with('info_message', 'Turi knygų, trinti negalima');
        }
        $author->delete();
        return redirect()->route('author.index');
    }
}
