@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 card">
                <table>
                    <tr>
                        <td>
                            <h3>Users</h3>
                        </td>
                        <td style="text-align: right">
                            <ul style="list-style: none; display: inline;text-align: right"> 
                                <li style="display: inline; margin-right: 1rem"><b>Filter by:</b></li>
                                <li style="display: inline;">
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#organization">Organization</button></li>
                                <li style="display: inline;">
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#date">Date</button></li>
                                <li style="display: inline;">
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#department">Department</button></li>
         
                            </ul>
                        </td>
                    </tr>
                </table>
                <table class="table table-striped table-hover">
                    <thead class="font-weight-bold">
                        <td>From</td>
                        <td>About</td>
                        <td>Organization</td>
                        <td></td>
                    </thead>
                    @foreach($letters as $letter)
                        <tr onclick="window.location.href = '/letter/{{$letter->id}}'">
                            <td>{{$letter->from}}
                                @if(isset($letter->status) && $letter->status == 0)
                                    <span class="badge badge-danger">New</span>
                                @endif
                            </td>
                            <td>{{$letter->about}}</td>
                            <td>{{$letter->organization}}</td>
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
<div id="organization" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Filter by organization
            </div>
            <div class="modal-body">
                <form action="/letter" method="get">
                    <input type="hidden" name="type" value="1">
                    <select name="organization" id="" class="form-control">
                        @foreach($organizations as $organization)
                            <option value="{{$organization->id}}">{{$organization->name}}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Filter" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>

<div id="date" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Filter by data 
            </div>
            <div class="modal-body">
                <form action="/letter" method="get">
                    <input type="hidden" name="type" value="2">
                    <div class="form-group">
                        <lable for="from" class="label-form">From</lable>
                        <input type="date" name="from" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <lable for="to" class="label-form">To</lable>
                        <input type="date" name="to" id="" class="form-control">
                    </div>
                    <input type="submit" value="Filter" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>

<div id="department" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Filter by Department
            </div>
            <div class="modal-body">
                <form action="/letter" method="get">
                    <div class="form-grop">
                        <input type="hidden" name="type" value="3"/>
                        <select name="department" id="" class="form-control">
                            @foreach($departemts as $dep)
                                <option value="{{$dep->id}}">{{$dep->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <input type="submit" value="Filter" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>