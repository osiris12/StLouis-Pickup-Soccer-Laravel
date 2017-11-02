<?php

namespace App\Http\Controllers;

use App\UsersImages;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class UserController extends Controller
{
    public function index()
    {
        if(!Auth::user()) { return redirect('/'); }
        $user = User::find(Auth::user()->id);
        $images = empty($user->userImages) ? '' : $user->userImages;
        $default_image = $user->defaultImage() == '' ? $user->standardImage() : $user->defaultImage();
        $user_info = DB::table('user_info')->where('user_id', '=', $user->id)->first();
        return view(
                'user_account', 
                [
                    'user' => $user, 
                    'images' => $images, 
                    'default_image' => $default_image,
                    'user_info' => $user_info
                ]
            );
    }
    public function store_image(Request $request)
    {
        $new_image = new UsersImages;
        $image = $request->file('featured_image');
        $default_image = $request->get('default');
        $file_name = time() .'.'.$image->getClientOriginalExtension();
        $location = public_path('user_images/'.$file_name);
        Image::make($image)->fit(300, 300, function ($constraint){
            $constraint->upsize();
        })->save($location);
        
        if($default_image)
        {
            $user = User::find(Auth::user()->id);
            $d_image = $user->defaultImage();
            if($d_image != '')
            {
                $d_image->default_image = 0;
                $d_image->timestamps = false;
                $d_image->save();
            }
            $new_image->default_image = 1;
        }
        else
        {
            $new_image->default_image = 0;
        }
        $new_image->image_name = $file_name;
        $new_image->description = $request->get('description');
        $new_image->user_id = Auth::user()->id;
        $new_image->timestamps = false;
        $new_image->save(); 
    }
    
    public function addUserInfo(Request $request)
    {
        if(Auth::user()->id != $request->get('xwd'))
        {
            return route('/');
        }
        $user_id = Auth::user()->id;
        $age = $request->get('age') != '' ? $request->get('age') : '';
        $position = $request->get('position') != '' ? $request->get('position') : '';
        $level = $request->get('level') != '' ? $request->get('level') : '';
        $area = $request->get('area') != '' ? $request->get('area') : '';
        
        if(DB::table('user_info')->where('user_id', '=', $user_id))
        {
            DB::table('user_info')
                    ->where('user_id', '=', $user_id)
                    ->update(
                        [
                            'user_id' => $request->get('xwd'),
                            'age' => $age,
                            'position' => $position,
                            'level' => $level,
                            'area' => $area
                        ]
                    );
        }
        else
        {
            DB::table('user_info')->insert(
                [
                    'user_id' => $request->get('xwd'),
                    'age' => $age,
                    'position' => $position,
                    'level' => $level,
                    'area' => $area
                ]
            );
        }
       
        return back()->with('message', 'Account info update!');
    }
}
