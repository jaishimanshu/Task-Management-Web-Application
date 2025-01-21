<!doctype html>
<html lang="en">
    <head>
        <title> Task Manager App </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12 m-auto">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title">Update Task App <a href="{{url('/view')}}" class="btn btn-primary" style="float: right;"> Back</a></h4>
                                    
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label> Name </label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter the Name" value=" {{ $editdata->name }}">
                                </div>
                                <div class="form-group">
                                    <label> Title </label>
                                    <input type="text" class="form-control" id="title" placeholder="Enter the Title" value=" {{ $editdata->title }}">
                                </div>
                                <div class="form-group">
                                    <label> Description </label>
                                    <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="description"> {{ $editdata->description }} </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" class="form-control" id="due_date" id="due_date" placeholder="Select the Due Date" value="{{ \Carbon\Carbon::parse($editdata->due_date)->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success" onclick="updatedata({{ $editdata->id }})"> Update </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <script>
            ClassicEditor.create( document.querySelector( '#content' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
        <script>
    var $jq = jQuery.noConflict(); 
        function updatedata(value) {
            var date = document.getElementById("due_date").value;
            var name = document.getElementById("name").value;
            var title = document.getElementById("title").value;
            var description = document.getElementById("content").value;
            $jq.ajax({
                url: '/update-data', 
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',  
                    date: date,
                    name : name,
                    title : title,
                    description : description,
                    id : value
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Task updated');
                        location.reload();
                    } else {
                        console.log('Error updating status');
                    }
                },
                error: function() {
                    console.log('An error occurred');
                }
            });
        }
    </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
