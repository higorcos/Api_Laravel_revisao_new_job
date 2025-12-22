<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
         $users = User::paginate(3);

         return view('users.index',[
            'users'=>$users
         ]);
    }
     public function create(){
         return view('users.create');
    }
     public function store(Request $request){
        $input = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3',
            'avatar'=>'file'
        ]);
        if(!empty($input['avatar']) && $input['avatar']->isvalid()){
            $urlAvatar = $input['avatar']->store();
        }
        User::create($input);
        return redirect()->back();
    }
    public function show(User $user){ //abacaxi para funcionar o scoped
        return view('users.show', ['user'=>$user]);//abacaxi para funcionar o scoped
    }
    public function  destroy(User $user){
        return null;
    }
}
