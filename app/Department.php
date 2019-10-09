<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ["name", "director_id"]; 

    public function director(){
        return $this->belongsTo("\App\User", "director_id"); 
    }
}
