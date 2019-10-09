<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LetterImage extends Model
{
    protected $fillable = ['path', 'letter_id']; 
}
