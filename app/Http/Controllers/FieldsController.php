<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class FieldsController extends Controller
{
    public function getFields()
    {
        $fields = \App\Field::all();
        $images = array();
        foreach($fields as $field)
        {
            $user_ids = explode(',', $field->players);
            foreach($user_ids as $user_id)
            {
                $user = User::find($user_id);
                $default_image = $user->defaultImage();
                $field->player_images = array($default_image);
            }
            $images[$field->name] = $field->images;
        }
        $fields_and_images = array('fields' => $fields, 'images' => $images);
        return $fields_and_images;
    }
    
    public function vote(Request $request)
    {
        if($request->isMethod('post'))
        {
            $true_user_id = Auth::user()->id; 
            $field_id = $request->get('field_id');
            $user_id = $request->get('user_id');
            if($true_user_id != $user_id) { return "<h1>Bitch</h1>"; }
            $quantity = $request->get('quantity');
            $field = \App\Field::find($field_id);
            $players = explode(',', $field->players);
            if(in_array($user_id, $players) && $quantity < 0)
            {
                $key = array_search($user_id, $players);
                unset($players[$key]);
                $players = implode(',', $players);
                $field->votes += $quantity;
                $field->players = $players;
                $field->save();
                return response()->json($field);
            }
            elseif(!in_array($user_id, $players) && $quantity > 0)
            {
                if($field->players == '')
                {
                    $field->players = $user_id;
                }
                else
                {
                    $field->players .= ','.$user_id;
                }
                $field->votes += $quantity; 
                $field->save();
                return response()->json($field);
            }
            else
            {
                if($quantity > 0)
                {
                    return response()->json([
                        'code' => 401,
                        'error' => 'You already voted for this game']);
                }
            }
        }
        return response()->json(['response' => 'This was a get method']);
    }
}
