<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter_user extends Model
{
    protected $fillable = ["user_id", "letter_id"]; 

    public function user(){
        return $this->belongsTo("\App\User"); 
    }

    public function letter(){
        return $this->belongsTo("\App\Letter"); 
    }
}
