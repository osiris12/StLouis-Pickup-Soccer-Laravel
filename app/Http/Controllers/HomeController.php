<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $fields = \App\Field::all();
        $images = array();
        foreach($fields as $field)
        {
            $user_ids = explode(',', $field->players);
            $field->player_images = collect();
            foreach($user_ids as $user_id)
            {
                $user = User::find($user_id);
                $default_image = $user->defaultImage($user_id);
                $field->player_images->push($default_image);
            }
            $images[$field->name] = $field->images;
        }
        return view('home', compact('fields', 'images'));
    }
}
