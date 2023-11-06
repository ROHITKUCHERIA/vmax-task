<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function showRegistrationForm(){
        return view('registration');
    }
    public function registerStore(Request $request){
        
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|in:male,female',
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|same:password',
            'color' => 'required|array|min:1',
            'color.*' => 'in:Yellow,Orange,Brown',
        ];

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return back()->with('fail', 'Email already exists');
        }
        $validatedData = $request->validate($rules);
    
        $user = new User();
        $user->name = $validatedData['first_name'] . $validatedData['last_name'];
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->gender = $validatedData['gender'];
        $user->password = bcrypt($validatedData['password']);
        $user->fav_color = implode(',', $validatedData['color']);
        $user->save();

        if($files=$request->file('images')){
            foreach($files as $file){
                $imageName = time() . '_'.Str::random(6);
                $file->move(public_path('images'), $imageName);
                $image[] = 'images/' . $imageName;
            }
            $user->images = implode(',', $image);
            $user->save();
            if ($user->save()) {
                return back()->with('success', 'Register successfully');
            }else{
                return back()->with('fail', 'Action Failed');
            }
        }else{
            return back()->with('fail', 'Image Not Found');
        }
        
    }

    public function allRecord(){
        $user = User::get();
        if(!empty($user)){
            $data['users'] = $user->toArray();
        }
        return view('showRecords', $data);
    }

    public function view( $id = 0){
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            abort(401);
        }
        $user = User::findOrFail($id);
        if(!empty($user)){
            $viewData['users'] = $user->toArray();
        }
        return view('view', $viewData);
    }

    public function edit($id = 0){
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            abort(401);
        }
        $user = User::findOrFail($id);
        if(!empty($user)){
            $editData['users'] = $user->toArray();
        }
        return view('edit', $editData);
    }
    public function update(Request $request){
        $id = $request->input('id');
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'gender' => 'required|in:male,female',
            'password' => 'nullable|string|min:6',
            'password_confirm' => 'nullable|same:password',
            'color' => 'required|array|min:1',
            'color.*' => 'in:Yellow,Orange,Brown',
        ];
    
        $validatedData = $request->validate($rules);
    
        $user = User::find($id);
    
        $user->name = $validatedData['first_name'] . $validatedData['last_name'];
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->gender = $validatedData['gender'];
    
        if($validatedData['password']){
            $user->password = bcrypt($validatedData['password']);
        }
    
        $user->fav_color = implode(',', $validatedData['color']);
        
        if($files = $request->file('images')){
            $imagePaths = [];
            foreach($files as $file){
                $imageName = time() . '_' . Str::random(6);
                $file->move(public_path('images'), $imageName);
                $imagePaths[] = 'images/' . $imageName;
            }
            $user->images = implode(',', $imagePaths);
        }
    
        $user->save();
        if ($user->save()) {
            return back()->with('success', 'Register successfully');
        }else{
            return back()->with('fail', 'Action Failed');
        }
    }
    public function delete($id = 0){
        try {

            $id = Crypt::decryptString($id);
            $user = User::find($id);
            if ($user) {
                $user->delete();
            }
            return back()->with('success', 'Action done successfully');
        } catch (DecryptException $e) {
            abort(401, 'Invalid or expired link');
        }
    }
}
