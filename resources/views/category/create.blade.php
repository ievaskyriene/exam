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
               <div class="card-header">Sukurkite naują kategoriją</div>
            
               <div class="card-body">
                <form method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Pavadinimas</label>
                        <input type="text" class="form-control" name="category_title" value = "{{old('category_title')}}">
                        <small class="form-text text-muted">Įveskite kategorijos pavadinimą</small>
                    </div>
                    {{-- <div class="form-group">
                        <label>Kategorijos aprašymas</label>
                        <textarea name="category_about" id="summernote"></textarea>
                        <small class="form-text text-muted">Įveskite trumpą kategorijos aprašymą</small>
                    </div> --}}
                    @csrf
                    <button type="submit" class="btn btn-primary">ADD</button>
                 </form>
               </div>
           </div>
       </div>
   </div>

   <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kategorijų sąrašas</div>
                <div class="card-body">
                {{-- <div class="form-group"> --}}
                        {{-- <img src="{{asset('images/'.$book->portret)}}" style="width: 250px; height: 300px;"><br><br> --}}
                    {{-- </div> --}}
                    @foreach ($categories as $category)
                        <div class = "list" style = "display:flex; flex-direction:row; justify-content: space-between; padding-bottom: 10px;">
                        <h5>{{$category->title}}</h5>
                        <form action="{{route('category.destroy', [$category])}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-secondary">DELETE</button>
                        </form>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
  </div>


</div>




{{-- <script>
    $(document).ready(function() {
       $('#summernote').summernote();
     });
    </script> --}}
@endsection