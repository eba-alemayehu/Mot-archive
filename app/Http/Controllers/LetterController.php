<?php

namespace App\Http\Controllers;

use App\Department;
use App\Letter;
use App\Letter_user;
use App\LetterImage;
use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        if(Auth::user()->role_id() == 1){
            $letters = Letter::orderby("created_at", "DESC"); 
        }else{
            $letters = Auth::user()->letters()->orderby("created_at", "DESC"); 
        }
        if(isset($request->type)){
            switch($request->type){
                case 1:
                    $letters->where("organization_id", $request->organization); 
                break; 
                case 2: 
                    $letters->where("created_at", ">=", $request->from)->where("created_at", "<=", $request->to); 
                break; 
                case 3: 
                   $user_id = Department::find($request->department)->director_id; 
                   $letters = \App\User::find($user_id)->letters()->orderby("created_at", "DESC"); 
                break; 
            }
        }
        $letters = $letters->get(); 
        foreach($letters as $letter){
            $letter_user = $letter->letter_users()->where("user_id", Auth::user()->id)->first(); 
            if($letter_user != null)
                $letter->status = $letter_user->status; 

            $letter->organization = $letter->organization()->first()->name; 
        }
        return view("letterList")
            ->with("letters", $letters)
            ->with("organizations", Organization::get())
            ->with("departemts", Department::get()); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("addLetter")->with("organizations", \App\Organization::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $letter_imgs = $request->file('letter_image');
        $letter = Letter::create($request->all());
        foreach($letter_imgs as $img){
            \App\LetterImage::create([
                "path" => $img->store('public/letter'),
                "letter_id" => $letter->id
            ]); 
        }
       
        return response()->redirectTo("/letter/".$letter->id); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Letter_user::where('user_id', Auth::user()->id)
                ->where("letter_id", $id)
                ->update(["status" => 1]); 
    
        $images = LetterImage::where("letter_id", $id)->get();
        foreach($images as $image){
            $image->path = str_replace("public/", "", $image->path);
        }

        $letter_users = Letter_user::where("letter_id", $id)->get(); 
        foreach($letter_users as $letter_user){
            $letter_user->user = $letter_user->user()->first(); 
        }
        return view("letter")
            ->with("letter", Letter::find($id))
            ->with("images", $images)
            ->with("letter_users", $letter_users)
            ->with("departments" , Department::get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Search letters 
     * 
     * @param  string key
     * @return \Illuminate\Http\Response
     */
    public function search($key){
        if(Auth::user()->role_id() == 1){
            $letters = Letter::search($key)->take(7)->get();
        }else{
            $letters = Letter::search()->get()->filter(function($letter){
                return (Letter_user::where("letter_id", $letter->id)->where("user_id", Auth::user()->id)->first() != null); 
            }); 
        }
        $_letters = []; 
        foreach($letters as $letter){
            $letter->organization = $letter->organization()->first()->name; 
            array_push($_letters, $letter); 
        }
        // return $letters; 
        return \response()->json($_letters); 
    }

    public function forward($letter_id, $dep_id){
        $department = Department::find($dep_id);
        
        if(count(Letter_user::where("letter_id", $letter_id)->where("user_id", $department->director()->first()->id)->get())){
            return 'false'; 
        }
        
        Letter_user::create([
            "letter_id" => $letter_id, 
            "user_id" => $department->director()->first()->id
        ]); 
        return $department->director()->first(); 
    }
}
