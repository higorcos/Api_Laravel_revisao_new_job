<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\UserInterest;
use App\Models\UserProfile;
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

    public function edit(User $user){
        $user->load(['profile', 'interests']);
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
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
    public function updateProfile(Request $request,User $user){
        $input = $request->validate([
            'type'=> 'required',    
            'address'=> 'nullable',
            ]);
        UserProfile::updateOrCreate(
            ['user_id' => $user->id], //usa para verificar se já existe
            $input
        );

        return back()->with('status','Perfil criado com sucesso');
    }
    public function updateInterests(Request $request,User $user){
        $input = $request->validate([
            'interests'=> 'nullable|array',
            ]);
        $user->interests()->delete();
        if(!empty($input['interests'])) {
            $user->interests()->createMany($input['interests']);
        }
        
        return back()->with('status','Interesses criados com sucesso');
    }

        public function updateRoles(Request $request,User $user){
        $input = $request->validate([
            'roles'=> 'required|array',
            ]);

        $user->roles()->sync($input['roles']);
       
        return back()->with('status','Cargo criado com sucesso');
    }


    public function destroy(User $user){    
        $user->delete();
        return back()->with('status','Usuário deletado com sucesso');
    }

}
 