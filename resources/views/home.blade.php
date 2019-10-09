@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="align-content-center" style="margin-top: 10%">
                <h1 style="text-align: center">Search letter</h1>
                <br>
                <div class="form-group">
   
                                <input onkeyup="search(this)" id="search" type="search" class="form-control" placeholder="Search Letter" style="padding: 1em 2em;height: 2.5em; font-size: 1.25rem"/>
                                <ul id='autocomlet' class="autocomplit" style="">
                                </ul>

                    <datalist id="autocomlet">
                    </datalist>
                </div>
            </div>
        </div>
    </div>
    <script>
        function select(letter_id){
            window.location.href = "/letter/"+letter_id; 
        }
        function search(input){
            $.getJSON("/letter/search/"+input.value, function(letters){
                $("#autocomlet").find("li").remove(); 
                // letters = JSON.parse(letters); 
                letters.forEach(function(letter){
                    $li = $("<li></li>"); 
                    $from = $("<span style='display:block'></span>").text(letter.from+" ("+letter.organization+")"); 
                    $about = $("<small style='display:block'></small>").text(letter.about); 
                    $li.append($from); 
                    $li.append($about); 
                    $li.click(function(){
                        window.location.href = "/letter/"+letter.id; 
                    }); 
                    $("#autocomlet").append($li); 
                });
            });
        }

       
    </script>
</div>

@endsection
