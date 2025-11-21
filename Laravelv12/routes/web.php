<?php

use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

Route::get('/', function () {
    
    $post = Post::create([ 
        'title'=>'Primeiro Costa', 
        'body' => 'Teste teste1-29471249587149587134-598127508713460/*-***!@#$%*()_' 
    ]);

    dd($post);

    return 'hafargq5etg5ge word';
    
})->name('post');

Route::get('/posts', function () {
    $post = Post::all();

    dd($post);
});
Route::get('/posts/', function (Request $postr) {
    print($postr);
    $post = Post::find(3);
    ///$post = Post::where('title','LIKE','primeiro%')->get();


    dd($post);
});
Route::get('/posts/updated', function () {
    $inputSimula = [
         'title'=>'titulo atualização', 
        'body' => '28305@@#!#4-598127508713460/*-***!@#$%*()_',
    ];
    
    $post = Post::find(3);
    $post->fill($inputSimula);
    $post->save();
    
    return $post;
});
Route::get('/posts/deleted', function () {
    $inputSimula = [
         'title'=>'titulo atualização', 
        'body' => '28305@@#!#4-598127508713460/*-***!@#$%*()_',
    ];
    $post = Post::find(5);
    
    if($post != null){
        $post->delete();
        return 'deletado';
    }else{
        return 'Post não encotrado ';
    };
    
});
Route::get('/users/relacao', function () {
    $user = User::with('profile')->find(1);
/* 
    $user->profile()->create([
        'type'=>'PJ',
        'document_number'=>'1234567890'   
    ]);  */

    return $user;
});

Route::get('/admin/usuarios', [UserController::class, 'index']);
Route::get('/admin/usuarios/{user}', [UserController::class, 'show']);