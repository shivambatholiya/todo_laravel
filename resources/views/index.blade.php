<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ToDo List</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4 m-auto">
                <h3>To Do List</h3>
                <form action="{{url('add_task')}}" method="post">
                    @csrf
                    <div class="my-2">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-center gap-3">
                        <input type="text" class="form-control w-75" name="task_name" placeholder="Add an Item">
                        <button type="submit" class="btn btn-primary">Add task</button>
                    </div>
                </form>
            </div>
            <div class="row my-5">
                <div class="col-md-6 m-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Task</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pagedata as $key => $data)
                            @php
                            $key++;
                            @endphp
                            <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$data->task_name}}</td>
                                <td>
                                    @if($data->status)<span class="text-success">Done</span>@else<span class="text-danger">Not Done</span>@endif
                                </td>
                                <td>{{$data->created_at}}</td>
                                <td class="d-flex gap-3">
                                    <form action="{{url('update_task_status', $data->id)}}" method="post">
                                    {{ csrf_field() }} 
                                        @if($data->status != 1)<button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2-square"></i></button>@endif
                                    </form>

                                    <form action="{{url('delete_task', $data->id)}}" method="post">
                                        {{ csrf_field() }} 
                                        <button type="submit" onclick="return confirm('Are you sure to delete this task?')" class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i></button>
                                    </form>

                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#items').html("");

            $('#add_task').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{url('add_task')}}",
                    data: form.serialize(), // serializes the form's elements.
                    success: function(response) {
                        let count = JSON.stringify(response.length);
                        let i = 0;

                        for (i = 0; i < count; i++) {
                            // alert(JSON.stringify(response));
                            items = '<tr><th scope="row">' + (i + 1) + '</th><td>' + response[i].item_name + '</td><td>' + response[i].created_at + '</td><td><span class="btn btn-sm btn-danger"><i class="bi bi-check2-square"></i></span><span class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i></span></td></tr>';
                            $('#items').append(items);
                        }
                    }
                });
            })
        })
    </script>
</body>

</html>