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
            
                <form method="POST" action="{{route('book.update',[$book])}}" enctype="multipart/form-data">
                    <div class="form-group">
                    <label>Pavadinimas</label>
                    <input type="text" class="form-control" name="book_title" value = "{{$book->title}}">
                    <small class="form-text text-muted">Įveskite naują knygos pavadinimą</small>
                    </div>

                    <div class="form-group">
                        <label>IBSN</label>
                        <input type="text" class="form-control" name="book_isbn" value = "{{$book->isbn}}">
                        <small class="form-text text-muted">Įveskite naują ISBN</small>
                    </div>

                    <div class="form-group">
                        <label>Puslapių skaičius</label>
                        <input type="text" class="form-control" name="book_pages" value = "{{$book->pages}}">
                        <small class="form-text text-muted">Įveskite naują knygos puslapių skaičių</small>
                    </div>

                    <div class="form-group">
                        <label>Knygos aprašymas</label>
                        <textarea name="book_about" id="summernote">{{$book->about}}</textarea>
                        <small class="form-text text-muted">Įveskite naują knygos aprašymą</small>
                    </div>

                    <div class="form-group">
                        <select name="author_id">
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif>
                                    {{$author->name}} {{$author->surname}}
                                </option>
                            @endforeach
                        </select>
                 
                         <small class="form-text text-muted">Parinkite knygai kitą autorių</small>
                    </div>
                    <div class="form-group">
                        <img src="{{asset('images/'.$book->portret)}}" style="width: 250px; height: auto;">
                    </div>
                    <div class="form-group">
                        <input type="file" name="portret">
                        <small class="form-text text-muted">Pakeiskite knygos nuotrauka.</small>
                    </div>

                    <div class="form-group">
                        @foreach ($categories as $category)
                        <label>{{$category->title}}</label>
                            @php   
                                $turi=false;
                            @endphp
                            @foreach ($book->getCategory as $bookCat)
                                @if($bookCat->categoryRelation->id == $category->id)
                                    @php
                                        $turi = true;
                                    @endphp
                                @endif 
                            @endforeach
                                <input type="checkbox" name="categories[]" value="{{$category->id}}"
                                {{$turi?'checked':''}}>
                        @endforeach
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-secondary">EDIT</button>
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