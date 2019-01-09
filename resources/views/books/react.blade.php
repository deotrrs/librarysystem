@extends('customlayouts.app')

@section('title', 'View')

@section('navbar')

@section('content')
    <div class="container">
        <div id="react"></div>
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