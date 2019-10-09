@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3>Users</h3>
                <table class="table table-striped table-hover">
                    <thead class="font-weight-bold">
                        <td>Worker ID</td>
                        <td>Name</td>
                        <td>Phone</td>
                        <td>Email</td>
                        <td></td>
                    </thead>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->worker_id}}</td>
                            <td>{{$user->first_name}} {{$user->father_name}} {{$user->g_father_name}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <span class="">Edit</span>
                                <span class="" onclick="delete_user('{{$user->first_name}}', {{$user->id}})">Delete</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script>
        function delete_user(name, id){
            if( confirm("Do you want to delete "+name)){
                window.location.href = "/user/delete/"+id+"/";
            }
        }
    </script>
@endsection
