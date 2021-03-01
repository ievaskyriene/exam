@extends('layouts.app')

@section('content')

<div class="container">
   
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header"><h1>Knygų sąrašas</h1>
                    <a href="{{route('book.index')}}">RESET</a>
                    <form action="{{route('book.index')}}" method="get">
                    <select name="author_id">
                        <option value="0">Show All</option>
                        @foreach ($authors as $author)
                            <option value="{{$author->id}}" @if($selectId == $author->id) selected @endif>{{$author->name}} {{$author->surname}}</option>
                        @endforeach
                    </select><br>
                    <small class="form-text text-muted">Pasirinkti autorių</small><br>
                        Rūšiuoti knygas pagal: <br>
                        Pavadinimą: <input type="radio" name="sort" value="title" @if('title' == $sort) checked @endif><br>
                        <button type="submit">Vykdyti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  <div class="row justify-content-center" >
    @foreach ($books as $book)
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class = "authorImage" style="height: 200px; text-align:center;">
                        <img src="{{asset('images/'.$book->portret)}}" style="max-width: 100%; max-height:200px; "><br><br>
                    </div>
                        <div style = "height:45px; padding-top:10px; text-align:center;"><h5>{{$book->title}}</h5></div><br>
                        <label>{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</label><br>
                        <a href="{{route('book.edit', [$book])}}">Koreguoti knygos duomenis</a><br>
                        <a href="{{route('book.show', [$book])}}">Parodyti informaciją apie knygą</a><br>
                        <form action="{{route('book.destroy', [$book])}}" method="post">
                            @csrf
                            <button type="submit" style="margin-top: 20px;" class="btn btn-secondary">DELETE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
  </div>
</div>

@endsection