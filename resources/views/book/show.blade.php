@extends('layouts.app')
@section('content')


<div class="container">
   <div class="row justify-content-center">
    <div class="col-sm">
    <img src="{{asset('images/'.$book->portret)}}" style="width: 250px; height: auto;"><br><br>
    <div class="card" style="width: 250px;">
    Autorius: {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}<br>
    Puslapiai: {{$book->pages}}<br>
    ISBN: {{$book->isbn}}<br>
    {{-- {{dd($bookCat)}}
    Žanras: {{}}<br> --}}
    </div> 
  
</div>
       <div class="col-md-8">
           <div class="card">
               <div class="card-header"><h2>{{$book->title}}</h2></div>
               <div class="card-body">
                    {{-- <div class="form-group">
                        <label>Knygos pavadinimas</label>
                        <div class="form-control" name="book_title" value = "">{{$book->title}}</div>
                    </div> --}}
                    <div class="form-group">
                        {{-- <label>Knygos autorius</label> --}}
                        {{-- <div class="form-control" name="book_title" value = "">{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</div> --}}
                        <a href="{{route('author.show', [$book->bookAuthor->id])}}">{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</a>
                    </div>

                    {{-- <div class="form-group">
                        <label>Knygoje yra puslapių</label>
                        <div class="form-control" name="book_title" value = "">{{$book->pages}}</div>
                    </div> --}}

                    <div class="form-group">
                        <div  name="book_title" value = ""> {!!$book->about!!}
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>
@endsection