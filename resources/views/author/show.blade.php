@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{$author->name}} {{$author->surname}} yra parašęs šias knygas</div>
               <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($author->authorBooks as $book)
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                       
                                        <img src="{{asset('images/'.$book->portret)}}" style="width: 250px; height: 300px;"><br><br>
                                    {{-- </div> --}}
                                        <label><h5>{{$book->title}}</h5></label><br>
                                        <label>{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</label><br>
                                        <a href="{{route('book.edit', [$book])}}">Koreguoti knygos duomenis</a><br>
                                        <a href="{{route('book.show', [$book])}}">Parodyti informaciją apie knygą</a><br>
                                        <form action="{{route('book.destroy', [$book])}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary">DELETE</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                  </div>
                {{-- @foreach ($author->authorBooks as $book)
                    <div class="form-group">
                        <label>Knygos pavadinimas</label>
                        <div name="author_weight" class="form-control" value=""><h3>{{$book->title}}</h3></div>
                    </div>
                    <div class="form-group">
                        <label>Knygos ISBN</label>
                        <div name="author_weight" class="form-control" value="">{{$book->isbn}} </div>
                    </div>
                    <div class="form-group">
                        <label>Knygoje yra puslapių</label>
                        <div name="author_weight" class="form-control" value="">{{$book->pages}} </div>
                    </div>
                    <div class="form-group">
                        <label>Knygos aprašymas</label>
                        <div name="author_weight" class="form-control" value="">{!!$book->about!!} </div>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </div>
</div>
</div>
@endsection