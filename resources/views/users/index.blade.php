@extends('customlayouts.app')

@section('title', 'View')

@section('navbar')

@section('content')
<div class="container">
    <div class="row ">
        @foreach ($books as $b)
        <div class="col-md-3 col-xl-4 col-sm-2 pb-5">           
            <div class="card">
                <div class="item_image">
                <img class="card-img-top img-fluid" src="{{asset("storage/images/books/".$b->image_path)}}" alt="Card image cap">
                </div>                
                <div class="card-block">
                    <h4 class="card-title">Book Title:</h4>
                    <p>{{$b->title}}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Author: {{$b->author}}</li>
                        <li class="list-group-item">Published by: {{$b->publisher}}</li>
                        <li class="list-group-item">Year published: {{$b->year}}</li>
                        <li class="list-group-item">Category: {{$b->category->name}}</li>
                    </ul>
                </div>
            </div>     
    </div> 
        @endforeach        
    </div>
</div>
@endsection