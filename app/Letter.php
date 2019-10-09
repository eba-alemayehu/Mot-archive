<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Letter extends Model
{
    use \Laravel\Scout\Searchable;
    protected $fillable = ['from', 'sent_at', 'received_at', 'description','organization_id','about']; 

    public function toSearchableArray()
    {
        $array =  $this->toArray(); 

        return $array;
    }

    public function organization(){
        return $this->belongsTo("\App\Organization"); 
    }

    public function letter_users(){
        return $this->hasMany("\App\Letter_user"); 
    }

}
