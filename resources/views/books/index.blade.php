@extends('customlayouts.app')

@section('title', 'View')

@section('navbar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-2">
                <div class="app header">
                    <h1>Published Books</h1>
                </div> 
                <div class="app add-button">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                        Add new Book
                    </button> 
                </div>                      
                <table class="table table-condensed table-bordered" id="bookTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Book Title</th>
                            <th>ISBN</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Year published</th>
                            <th>Category</th>
                            <th>Date Added</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $b)
                        <tr>
                         <td>
                             <div class="table item_image">
                                 @if($b->image_path)
                                <img src="{{asset("storage/images/books/".$b->image_path)}}" alt="published books" >
                                @else
                                <img src="..." alt="no image" > No Image
                                @endif
                             </div>                            
                        </td>   
                        <td>{{$b->title}}</td>
                            <td>{{$b->isbn}}</td>
                            <td>{{$b->author}}</td>
                            <td>{{$b->publisher}}</td>
                            <td>{{$b->year}}</td>
                            <td>{{$b->category->name}}</td>
                            <td>{{$b->created_at}}</td>
                            <td>{{$b->updated_at}}</td>
                            <td>
                                <button class="btn btn-block btn-info" data-toggle="modal" data-target="#editModal" onclick="edit({{$b->id}})">Edit</button>
                                <button type="button" id="deletebtn" class="btn btn-block btn-danger" onclick="remove({{$b->id}})">Delete</button>
                            </td>
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
    <!--Add modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                    @endif
                <form class="addBooks">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="name">Book Title:</label>
                            <input type="text" name="title" id="title validationCustom03" class="form-control" required>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <label for="isbn">ISBN:</label>
                            <input type="text" name="isbn" id="isbn" class="form-control" required>
                        </div>              
                    </div>
                    <div class="form-row">                        
                        <div class="col-md-3">
                            <label for="year">Year Published:</label>
                            <input type="number" class="form-control" max="<?=date('Y',strtotime("now"))-1?>" min="1970" name="year" id="year" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="author">Author: </label>
                        <input type="text" class="form-control" name="author" id="author" required>
                        <label for="author">Publisher: </label>
                        <input type="text" class="form-control" name="publisher" id="publisher" required>
                    </div>
                    <div class="form-group">
                            <select name="category" id="category" class="form-control" required>
                                <option value="" selected disabled> Select Category </option>
                                @foreach ($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach                        
                            </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!--Edit modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Book Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                    @endif
                <form class="editBooks" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="editid">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="name">Book Title:</label>
                            <input type="text" name="title" id="edittitle" class="form-control" required>
                                
                        </div>
                        <div class="col-md-6">
                            <label for="isbn">ISBN:</label>
                            <input type="text" name="isbn" id="editisbn" class="form-control" required>
                        </div>              
                    </div>
                    <div class="form-row">                        
                        <div class="col-md-3">
                            <label for="year">Year Published:</label>
                            <input type="number" class="form-control" max="<?=date('Y',strtotime("now"))-1?>" min="1970" name="year" id="edityear">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="author">Author: </label>
                        <input type="text" class="form-control" name="author" id="editauthor" required>
                        <label for="author">Publisher: </label>
                        <input type="text" class="form-control" name="publisher" id="editpublisher" required>
                    </div>
                    <div class="form-group">
                            <select name="category" id="editcategory" class="form-control" required>
                                <option value="" selected disabled> Select Category </option>
                                @foreach ($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach                        
                            </select>
                    </div>
                    <div class="item_image">
                        <img src="" id="modalImage" alt="image" height="100" width="100">
                    </div>
                    <div class="form-group">                              
                            <label for="exampleInputEmail1">File</label>
                            <input type="file" name="filename" class="form" id="filename">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('myjs')
    <script>
        $(document).ready(function() {
            $('#bookTable').DataTable();
        } );
        $('.addBooks').on('submit',function(event){
            event.preventDefault();
            $.ajax({
                type:'POST',
                url:'{{route("insert")}}',
                data: $(this).serialize(),
                success: function(result){
                    console.log(result.errors);
                    if(result['type'] == 'success'){
                        swal({
                            title: "Create",
                            text: "Successfuly Added",
                            icon: "success",
                        }).then(function(){
                                location.reload();
                            });
                    }
                    else if(result['type'] == 'error'){
                        swal({
                            title: "Invalid",
                            text: "Some are empty fields",
                            icon: "error",
                        })
                    }                    
                }
            });
        });
        function edit(id){
            var _token = $("input[name='_token']").val();
            $.ajax({
                type:'POST',
                url:'{{route("edit")}}',
                dataType:"json",
                data: {
                    _token:_token,
                    'id':id,
                },                
                success: function(response){
                    img = "{{URL::asset('storage/images/books/')}}/"+response.image_path
                    $("#editid").val(response.id);
                    $("#edittitle").val(response.title);
                    $("#editisbn").val(response.isbn);
                    $("#edityear").val(response.year);
                    $("#editauthor").val(response.author);
                    $("#editpublisher").val(response.publisher);
                    $("#editcategory").val(response.category.id);
                    $('#modalImage').attr('src',img);
                }
            })
        }
        $('.editBooks').on('submit',function(event){
            event.preventDefault();
            var data = new FormData(this);
            $.ajax({
                type:'POST',
                url:'{{route("save")}}',
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                    if(result['type'] == 'success'){
                        swal({
                            title: "Updated",
                            text: "Successfuly Added",
                            icon: "success",
                        }).then(function(){
                                location.reload();
                            });
                    }
                    else if(result['type'] == 'error'){
                        swal({
                            title: "Error Update",
                            text: "Some are empty fields",
                            icon: "error",
                        })
                    }    
                    console.log($result);                         
                }
            });           
        });
        function remove(id){
            var _token = $("input[name='_token']").val();
            swal({
            title: "Are you sure?",
            text: "Your book will be delete",
            icon: "warning",
            buttons: true,
            closeModal: false
            },).then(function(isConfirm) {
            if (isConfirm) {
                swal({
                title: 'Deleted!',
                text: 'Succesfully deleted',
                icon: 'success'
                }).then(function() {
                    $.ajax({
                        type:'POST',
                        url:'{{route("delete")}}',
                        dataType:"json",
                        data: {
                            _token:_token,
                            'id':id,
                        },                
                        success: function(response){
                            
                        }
                    });
                    location.reload();                    
                });
                
            } else {
                swal("Cancelled", "Book not deleted :)", "error");
            }
            })
                                
        }
    </script>
@endsection