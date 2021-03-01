@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">PAVADINIMAS</div>
            
               <div class="card-body">
                <form method="POST" action="{{route('book.store')}}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Pavadinimas</label>
                        <input type="text" class="form-control" name="book_title" value = "{{old('book_title')}}">
                        <small class="form-text text-muted">Įveskite knygos pavadinimą</small>
                    </div>
                    <div class="form-group">
                        <label>ISBN</label>
                        <input type="text" class="form-control" name="book_isbn" value = "{{old('book_isbn')}}">
                        <small class="form-text text-muted">Įveskite ISBN</small>
                    </div>
                    <div class="form-group">
                        <label>Puslapių skaičius</label>
                        <input type="number" class="form-control" name="book_pages" value = "{{old('book_pages')}}">
                        <small class="form-text text-muted">Įveskite puslapių skaičių</small>
                    </div>
                    <div class="form-group">
                        <label>Knygos aprašymas</label>
                        <textarea name="book_about" id="summernote"></textarea>
                        <small class="form-text text-muted">Įveskite trumpą knygos aprašymą</small>
                    </div>
                        <select name="author_id">
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Parinkite autorių</small>
                        <div class="form-group">
                            Knygos nuotrauka <input type="file" name="portret">
                            <small class="form-text text-muted">Parinkite knygos nuotrauką.</small>
                        </div>

                        <div class="form-group">
                            {{-- {{dd($categories)}} --}}
                            @foreach ($categories as $category)
                              <label>{{$category->title}}</label>
                              <input type="checkbox" name="categories[]" value="{{$category->id}}">
                            @endforeach
                            <small class="form-text text-muted">Priskirkite kategoriją</small>
                        </div>
                    @csrf
                    <button type="submit" class="btn btn-primary">ADD</button>
                 </form>
               </div>
           </div>
       </div>
   </div>
</div>


<script>
    $(document).ready(function() {
       $('#summernote').summernote();
     });
    </script>
@endsection