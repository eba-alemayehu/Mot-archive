@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3>Add letter</h3>
                <form class="form" action="/letter" method="POST" name="add_letter" id="add_letter" enctype="multipart/form-data">
                    
                        <div class="form-group">
                            <label for="from" class="label-control">From</label><br>
                            <input type="text" name="from" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="about" class="label-control">About</label>
                            <input type="text" name="about" class="form-control">
                        </div>
                        <div class="form-group">
                            <table style="width:100%">
                                <tr>
                                    <td>
                                        <label for="sent_at" class="label-control">Sent date</label>
                                        <input type="date" name="sent_at" class="form-control">
                                    </td>
                                    <td>
                                        <label for="received_at" class="label-control">Received date</label>
                                        <input type="date" name="received_at" class="form-control">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="" class="label-control">Letter images</label>
                            <input type="file" name="letter_image[]" class="form-control" multiple/>
                        </div>
                        <div class="form-group">
                            <label for="description" class="label-control">Discription</label>
                            <textarea name="description" class="form-control" form="add_letter">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="type" class="label-control">Letter type</label>
                            <select name="type" id="" class="form-control">
                               <option value="0">Comming in</option>
                               <option value="1">Going out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="organization_id" class="label-control">Organization</label>
                            <select name="organization_id" id="" class="form-control">
                                @foreach($organizations as $organization)
                                    <option value="{{$organization->id}}">{{$organization->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <table>
                                <tr>
                                    <td>
                                        <label for="shelf" class="label-form">shelf</label>
                                        <input type="text" class="form-control" name="shelf">
                                    </td>  
                                    <td>
                                        <label for="row" class="label-form">row</label>
                                        <input type="text" class="form-control" name="row">
                                    </td>  
                                    <td>
                                        <label for="folder" class="label-form">folder</label>
                                        <input type="text" class="form-control" name="folder">
                                    </td>  
                                </tr>
                            </table>
                        <div class="form-group">
                            <input type="submit" value="Submit" class="btn btn-success">
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    </script>
@endsection
