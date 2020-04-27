<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  public function uploadAvatar(Request $request){
    if($request->hasFile('image')){
      User::uploadAvatar($request->image);
      return redirect()->back()->with('message', 'Image successfully uploaded');
    }
      return redirect()->back()->with('error', 'Unable to upload file');
}


  public function index(){

    $user = new User();
    $user->name = 'billy';
    $user->email = 'billy@gmail.com';
    $user->password = 'password';
    $user->save();

    $user1 = new User();
    $user->name = 'John';
    $user->email = 'john@gmail.com';
    $user->password = 'password';
    $user->save();


    return $user;
  }
}
