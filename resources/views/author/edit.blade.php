@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">PAVADINIMAS</div>
               <div class="card-body">
                <form method="POST" action="{{route('author.update',[$author->id])}}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Vardas</label>
                       <input type="text" name="author_name" class="form-control" value="{{$author->name}}">
                        <small class="form-text text-muted">Įveskite naują autoriaus vardą.</small>
                    </div>
                    <div class="form-group">
                        <label>Pavardė</label>
                        <input type="text" name="author_surname" class="form-control" value="{{$author->surname}}">
                        <small class="form-text text-muted">Įveskite naują autoriaus pavardę.</small>
                    </div>
                    <div class="form-group">
                        <img src="{{asset('images/'.$author->portret)}}" style="width: 250px; height: auto;">
                    </div>
                    <div class="form-group">
                        <input type="file" name="portret">
                        <small class="form-text text-muted">Pakeiskite autoriaus nuotrauka.</small>
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