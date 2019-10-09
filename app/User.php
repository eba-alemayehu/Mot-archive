<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "worker_id"
        ,"department_id"
        ,'first_name'
        ,'father_name'
        ,'g_father_name'
        ,'email'
        ,"phone"
        ,'email_verified_at'
        ,'password'
        ,'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department(){
        return $this->belongsTo("\App\Department"); 
    }

    public function role_id(){
        return $this->belongsTo("\App\Role", "role_id")->first()->id; 
    }

    public function letters(){
        return $this->belongsToMany("\App\Letter",'letter_users'); 
    }

    public function letter_users(){
        return $this->hasMany("\App\Letter_user"); 
    }

    public function newLettersCount(){
        return count($this->letter_users()->where("status", 0)->get()); 
    }
}
