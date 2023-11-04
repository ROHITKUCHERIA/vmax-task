<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showRegistrationForm(){
        return view('registration');
    }
    public function registerStore(Request $request){

        $data = $request->toArray();
        
        $user = new User();
        $user->name = $data['first_name'].$data['last_name'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];
        $user->password = bcrypt($data['password']);
        $user->fav_color = implode(',',$data['color']);
        $user->save();
        if($request->hasFile('images')){
            $imagepath = [];
            foreach($request->file('images') as $image){
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('images'),$imageName);
                $imagepath[] = 'images/'.$imageName;
            }
            $user->images = implode(',',$imagepath);
            $user->save();
        }
        



    }
}
