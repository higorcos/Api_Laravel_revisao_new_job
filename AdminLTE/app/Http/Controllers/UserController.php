<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index',compact('users'));
    }  
    public function create(){
        
        return view('users.create');
    }   
    public function store(Request $request){
        
        $input = $request->validate([
            'name'=> 'required',    
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|min:8 ',
            ]);

            
           
        $user = User::create($input); 
        
        return redirect()->route('users.index')->with('status','Usuário adicionado');
    }
    public function show($id){

    }
    public function edit(User $user){
        $user = User::find($user);
        return view('users.edit',compact('user'));
    }
    public function update(Request $request,User $user){
    
        $input = $request->validate([
            'name'=> 'required',    
            'email' => 'required|email|unique:users,email,' . $user->id, // edição email unique 
            'password'=> 'exclude_if:password,null|min:8',
            ]);
        $user->fill($input);
        $user->save();
        
        return redirect()->route('users.index')->with('status','Usuário Atualizado');
    }
    public function destroy(User $user){    
        $user->delete();
        return back()->with('status','Usuário deletado com sucesso');
    }

}
 