<!doctype html>
<html lang="en">
    <head>
        <title> User Task Updadte</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <style>
            table td p {
                word-break: break-all;
            }
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <div class="row">
                <div class="col-xl-8">
                    <h3 class="text-right"><b>User Task Updadte</b></h3>
                </div>
               
            </div>
                <div class="row">
                    <div class="col-md-8 form-group">
                        <form action="{{ url('view') }}" method="GET">
                            <div class="col-md-2">
                                <input type="radio" id="ALL" name="data_sel" value="ALL" 
                                       @if(request('data_sel') == 'ALL') checked @endif>
                                <label for="ALL">ALL</label><br>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" id="Completed" name="data_sel" value="Completed"
                                       @if(request('data_sel') == 'Completed') checked @endif>
                                <label for="Completed">Completed</label><br>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" id="not_completed" name="data_sel" value="not_completed"
                                       @if(request('data_sel') == 'not_completed') checked @endif>
                                <label for="not_completed">Not Completed</label><br>
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                        <div class="col-xl-4 text-right">
                            <a href="{{url('/')}}" class="btn btn-primary"> Back</a>
                        </div>
                </div>

            <div class="table-responsive mt-4">
                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th> Name </th>
                            <th style="width:30%;"> Title </th>
                            <th style="width:30%;"> Description </th>
                            <th> Due Date </th>
                            <th> Task Status </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td> {{ $task->id }} </td>
                                <td> {{ $task->name }} </td>
                                <td> {{ $task->title }} </td>
                                <td> {!! html_entity_decode($task->description) !!} </td>
                                <td> 
                                    <input type="date" value="{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}">
                                </td>
                                
                                <td>
                                    <input type="hidden" id="taskId" name="taskId" value="{{$task->id}}">
                                    <input type="checkbox" id="task_status_{{$task->id}}" name="task_status_{{$task->id}}" 
                                    onclick="updateTaskStatus({{ $task->id }})" {{ $task->status ? 'checked' : '' }}>
                                </td>

                                <td ><a href="{{ url('/edit/' . $task->id) }}" title="Click here to edit the task" style="cursor: pointer;font-size: 22px;color: green;">
                                    <i class="fa fa-edit"></i></a>

                                <a onclick="deleteTaskStatus({{ $task->id }})"  title="Click here to delete the task" style="cursor: pointer;float: right;font-size: 22px;color: red;"><i class="fa fa-trash"></i></a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $tasks->links() }}
        </div>
        <script type="text/javascript">
    var $jq = jQuery.noConflict(); 

            $jq(document).ready(function() {
                $('#myTable').DataTable();
            });
            </script>
<script>
    var $jq = jQuery.noConflict(); 
    function updateTaskStatus(value) {
        const taskId = $jq("#task_status_" + value).prop('checked');  
        $jq.ajax({
            url: '/update-status', 
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',  
                id: value,
                status: taskId
            },
            success: function(response) {
                if (response.success) {
                    console.log('Task status updated');
                } else {
                    console.log('Error updating status');
                }
            },
            error: function() {
                console.log('An error occurred');
            }
        });
    }

    function deleteTaskStatus(value) {
        $jq.ajax({
            url: '/delete-status', 
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',  
                id: value,
            },
            success: function(response) {
                if (response.success) {
                    console.log('Task status deleted');
                    location.reload();
                } else {
                    console.log('Error deleted status');
                }
            },
            error: function() {
                console.log('An error occurred');
            }
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>