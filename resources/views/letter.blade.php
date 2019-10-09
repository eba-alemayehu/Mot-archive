@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8">
                                 <h3>Letter</h3>
                            </div>
                            <div class="col-sm-4">
                                <small style="float: right"><em>Sent at:</em> {{ $letter->sent_at }} </small>
                                <small style="float: right"><em>Recived at:</em> {{ $letter->received_at}}</small>
                            </div>
                        </div>
                    </div>
                    <h5>Form</h5>
                    <p>{{ $letter->from}}</p>
                    <h5>About: </h5>
                    <p> {{ $letter->about }}</p>
                    <h5>Discription</h5>
                    <p><small>{{ $letter->description }}</small></p>
                    <p>
                        @if($letter->type == 0)
                            Comming in 
                        @else
                            Going out
                        @endif
                    </p>
                    <h5>Letter images</h5>
                    <div class="justify-content-center">
                        <div hidden class="viewer">
                            <img id="image" src="/storage/{{$images[0]->path}}" alt="Picture">
                        </div>

                        <div>
                            <ul id="images">
                                @foreach($images as $img)
                                    <li>
                                        <img class="img-thumbnail" src="/storage/{{$img->path}}" alt="Picture 1"/>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h3>Physical location</h3>
                    <p><b>Shelf:</b> {{$letter->shelf}}</p>
                    <p><b>Row:</b> {{$letter->row}}</p>
                    <p><b>Folder:</b> {{$letter->folder}}</p>
                </div>
            </div>
            @if(Auth::user()->role_id() == 1 or true)
            <div class="col-md-4">
                <div class="card">
                    <h3>Forwarded to</h3>
                    <ul class="list-group" id="forwarded-users">
                        @foreach($letter_users as $letter_user)
                            <li class="list-group-item">
                                {{$letter_user->user->first_name}} {{$letter_user->user->father_name}}
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </li>
                        @endforeach
                    </ul>
                    <div>
                        <label for="" class="label-control">Forward to departments</label>
                        <select onchange="dep_select(this)" class="form-control">
                            <option value=""></option>
                            @foreach($departments as $dep)
                                <option value="{{$dep->id}}">{{$dep->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
            </div>
            @endif
        </div>
    </div>
    <?="<script>"?>
        <?="var letter_id = ". $letter->id ?>
    <?="</script>"?>
    <script>
        // View an image
        const viewer = new Viewer(document.getElementById('image'), {
        inline: true,
        viewed() {
            viewer.zoomTo(1);
            $('.viewer').show(); 
        },
        });

        // View a list of images
        const gallery = new Viewer(document.getElementById('images'));

        function dep_select(e){
            let id = $(e).val();
            $.post("/letter/forward/"+letter_id+"/"+id)
            .done(function(res){
                if(res == "false"){
                    alert("The letter is already forwarded to the departmet!"); 
                    return; 
                }
                let ls = $("<li class='list-group-item'></li>").text(res.first_name+" "+res.father_name); 
                $('#forwarded-users').append(ls);
            });
        }
    </script>
@endsection
