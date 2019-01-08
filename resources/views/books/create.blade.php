@extends('customlayouts.app')

@section('title', 'View')

@section('navbar')

@section('content')
<div class="container">
    <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif
        <div class="col-md-6">
            <form action="{{route('insert')}}" class="" method="post">
                @csrf
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="name">Book Title:</label>
                        <input type="text" name="title" id="title" class="form-control">
                            
                    </div>
                    <div class="col-md-6">
                        <label for="isbn">ISBN:</label>
                        <input type="text" name="isbn" id="isbn" class="form-control">
                    </div>              
                </div>
                <div class="form-row">                        
                    <div class="col-md-3">
                        <label for="year">Year Published:</label>
                        <input type="number" class="form-control" max="<?=date('Y',strtotime("now"))-1?>" min="1970" name="year" id="year">
                    </div>
                </div>
                <div class="form-group">
                    <label for="author">Author: </label>
                    <input type="text" class="form-control" name="author" id="author">
                    <label for="author">Publisher: </label>
                    <input type="text" class="form-control" name="publisher" id="publisher">
                </div>
                <div class="form-group">
                        <select name="category" id="category" class="form-control">
                            <option value="" selected disabled> Select Category </option>
                            @foreach ($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach                        
                        </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection