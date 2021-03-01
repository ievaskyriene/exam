@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">PAVADINIMAS</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('author.store')}}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label> Vardas:</label>
                                <input type="text" class="form-control" name="author_name">
                                <small class="form-text text-muted">Įveskite autoriaus vardą.</small>
                           </div>
                           <div class="form-group">
                                <label>Pavardė:</label>
                                <input type="text" class="form-control" name="author_surname">
                                <small class="form-text text-muted">Įveskite autoriaus pavardę.</small>
                            </div>
                            <div class="form-group">
                                Autoriaus nuotrauka <input type="file" name="portret">
                                <small class="form-text text-muted">Parinkite autoriaus nuotrauką.</small>
                            </div>
                            @csrf
                            <button type="submit" class = "btn btn-primary">ADD</button>
                         </form>
                    </div>
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