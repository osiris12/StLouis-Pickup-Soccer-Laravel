<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function userImages()
    {
        return $this->hasMany('App\UsersImages');
    }
    
    
    public function defaultImage($user_id = null)
    {
        if($user_id != null)
        {
            $user = $user_id;
        }
        else
        {
           $user = Auth::user()->id;
        }
        $image = \App\UsersImages::where('user_id', '=', $user)
                ->where('default_image', '=', 1)->first();
        return $image;
    }
    
    public function standardImage()
    {
        $image = \App\UsersImages::where('image_name', '=', 'standard_image.png')->first();
        return $image;
    }
    
    public function getUserInfo($user_id)
    {
        $user_info = DB::table('user_info')->where('user_id', '=', $user_id)->first();
        return $user_info;
    }
}
  