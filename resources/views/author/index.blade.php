@extends('layouts.app')

@section('content')

<div class="container">

<div class="row justify-content-center">
  @foreach ($authors as $author)
      <div class="col-3">
          <div class="card">
              <div class="card-body">
                  <div class="form-group">
                    <div class = "authorImage" style="height: 200px;  text-align:center;">
                      <img src="{{asset('images/'.$author->portret)}}" style="max-width: 100%; max-height:200px"><br><br>
                    </div>
                  {{-- </div> --}}
                      <div style = "height:45px; padding-top:10px; text-align:center;"><h5>{{$author->name}} {{$author->surname}}</h5></div><br>
                      Šio autoriaus turime knygų: {{$author->authorBooks->count()}} 
                      <br>
                      <a href="{{route('author.show', [$author])}}">Parodyti šio autoriaus knygas</a>
                      {{-- <label>{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</label><br> --}}
                      {{-- <a href="{{route('book.edit', [$book])}}">Koreguoti knygos duomenis</a><br>
                      <a href="{{route('book.show', [$book])}}">Parodyti informaciją apie knygą</a><br> --}}
                      <form method="POST" action="{{route('author.destroy', [$author])}}">
                        @csrf
                          <button type="submit" style="margin-top: 20px;"  class="btn btn-danger">DELETE</button>
                       </form>
                  </div>
              </div>
          </div>
      </div>
  @endforeach
</div>
</div>

{{-- @foreach ($authors as $author)
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label>Vardas</label>
                  <a href="{{route('author.edit',[$author])}}" class="form-control">{{$author->name}}</a>
                  <small class="form-text text-muted">Autoriaus vardas</small>
                </div>
                <div class="form-group">
                  <label>Pavardė</label>
                  <a href="{{route('author.edit',[$author])}}" class="form-control">{{$author->surname}}</a>
                  <small class="form-text text-muted">Autoriaus pavardė</small>
                </div>
                <form method="POST" action="{{route('author.destroy', [$author])}}">
                 @csrf
                   <button type="submit" class="btn btn-danger">DELETE</button>
                </form>
                  <br><br>
                  <img src="{{asset('images/'.$author->portret)}}" style="width: 250px; height: auto;">
                  <br><br>
                  Šis autorius yra parašęs {{$author->authorBooks->count()}} knygas: 
                  <br>
                  <a href="{{route('author.show', [$author])}}">Parodyti šio autoriaus knygas</a>
              </div>
          </div>
      </div>
  </div>
</div>
@endforeach --}}

@endsection