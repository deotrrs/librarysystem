@extends('customlayouts.app')

@section('title', 'View')

@section('navbar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="app header">
                    <h1>Deleted books</h1>
                </div>                              
                <table class="table table-condensed table-bordered" id="bookTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Book Title</th>
                            <th>ISBN</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Year</th>
                            <th>Category</th>
                            <th>Deleted date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $b)
                        <tr>
                            <td><img src="{{asset("storage/images/books/".$b->image_path)}}" alt="" ></td>   
                            <td>{{$b->title}}</td>
                            <td>{{$b->isbn}}</td>
                            <td>{{$b->author}}</td>
                            <td>{{$b->publisher}}</td>
                            <td>{{$b->year}}</td>
                            <td>{{$b->category->name}}</td>
                            <td>{{$b->deleted_at}}</td>
                        </tr> 
                        @endforeach
                    </tbody>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                    @endif
                    
                </table>
            </div>
        </div>
    </div>
  
@endsection
@section('myjs')
    <script>
        $(document).ready(function() {
            $('#bookTable').DataTable();
        } );
    </script>
@endsection