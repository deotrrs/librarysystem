@extends('customlayouts.app')

@section('title', 'Books')

@section('navbar')

@section('content')
<div class="container">
    <div class="row ">
        @foreach ($books as $b)
        <div class="col-12 col-md-4 col-sm-6 col-lg-4 col-xl-3 py-lg-3 pb-5">           
            <div class="card">
                <div class="item_image">
                <img class="card-img-top img-fluid" src="{{asset("storage/images/books/".$b->image_path)}}" alt="Book Image">
                </div>                
                <div class="card-block">
                    <div class="card-title">
                        <h4>Book Title:</h4>
                        <h5>{{$b->title}}</h5>
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Author:</b> {{$b->author}}</li>
                        <li class="list-group-item"><b>Published by:</b> {{$b->publisher}}</li>
                        <li class="list-group-item"><b>Year published:</b> {{$b->year}}</li>
                        <li class="list-group-item"><b>Category:</b> {{$b->category->name}}</li>
                    </ul>
                </div>
            </div>     
    </div> 
        @endforeach        
    </div>
</div>
@endsection