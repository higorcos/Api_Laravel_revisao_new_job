<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Teste1Middleware;
use App\Http\Middleware\TesteMiddleware;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;



Route::domain('{user}.api-laravel.teste')->group(function(){
    Route::get('', function ($user) {
    return 'Bem-Vindo '. $user ;
    });
});
Route::prefix('/admin/users')->name('admin.users.')->middleware([TesteMiddleware::class])->group(function(){

    Route::get('relacao', function () {
        $user = User::with('profile')->find(1);

        $user->profile()->create([
            'type'=>'PJ',
            'document_number'=>'1234567890'   
        ]);  

        return $user;
    })->name('relacao');
    Route::get('posts', function () {
        $user = User::with('post')->find(1);


        return $user;
    })->name('post');
    Route::get('role', function () {
        $user = User::find(1);
        $user->roles()->attach(2);

        return $user;
    })->name('role');
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/cadastrar', [UserController::class, 'create'])->name('create');
    Route::post('/cadastrar', [UserController::class, 'store'])->name('store');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
});

Route::prefix('/posts')->name('posts.')->group(function(){
    Route::get('/', function () {
        $post = Post::all();

        dd($post);
    })->name('show');
    Route::get('{id}', function ($id) {
        $post = Post::find($id);
        return [$post];
    })->name('findId');
    Route::put('updated', function () {
        $inputSimula = [
            'title'=>'titulo atualização', 
            'body' => '28305@@#!#4-598127508713460/*-***!@#$%*()_',
        ];
        
        $post = Post::find(3);
        $post->fill($inputSimula);
        $post->save();
        
        return $post;
    })->name('updated');
    Route::delete('delete', function () {
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
        
    })->name('delete');
});

Route::get('/', function () {
    
    $post = Post::create([ 
        'title'=>'Primeiro Costa', 
        'body' => 'Teste teste1-29471249587149587134-598127508713460/*-***!@#$%*()_' 
    ]);

    return 'home';    
})->name('home');

Route::get('/proto/{id}', function ($id=null) {
    
    return 'parametro'. $id;
});

Route::get('/proto/{id}/{name}', function ($id=null,$name=null) {
    
    return 'parametro'. $id . ' nome: '.$name;
})->where('id','[0-9]+')->where('name','[A-Za-z]+');
/* ->where([
    'id'=>'[0-9]+',
    'name'=>'[A-Za-z]+'
]);
 */

Route::get('/token/{token}', function ($token) {
    
    return 'token do user '. $token;
})->middleware([TesteMiddleware::class, Teste1Middleware::class]);
//Route::pattern FOI DEFINIDO NO AppServiceProvider.php '[\da-fA-F]{8}-[\da-fA-F]{4}-[\da-fA-F]{4}-[\da-fA-F]{4}-[\
///-----------
//->whereNumber('token');
//->whereAlpha('token');
//->whereAlphaNumeric('token');
//>whereUuid('token');

Route::get('/token00/{token}', function ($token) {
    
    return 'token do user '. $token;
})->middleware(['teste00', 'teste01']);


//middleware em grupo de rotas
Route::middleware(['groupMiddlewareTest'])->group(function(){
    Route::get('/token2/{token}', function ($token) {
    
    return 'Grupo com middleware - token do user '. $token;
    });

    Route::get('/token3/{token}', function ($token) {
    
    return 'Grupo com middleware - token do user '. $token;
    });

    Route::get('/token4/{token}', function ($token) {
    
    return 'Grupo com middleware mais tirando um - token do user '. $token;
    })->withoutMiddleware([TesteMiddleware::class]); //uma rota sem 
    //ou grupo de rotas sem middleware

    Route::withoutMiddleware([Teste1Middleware::class])->group(function(){
        Route::get('/token5/{token}', function ($token) {
            
            return 'Grupo do grupo sem um middleware  - token do user '. $token;
        });
         Route::get('/token6/{token}', function ($token) {
            
            return 'Grupo do grupo sem um middleware - token do user '. $token;
        });
    });
});
// o certo deveria ser token mas o token está sendo validado para ser uuid
Route::get('/checkout/{id}',CheckoutController::class);

//Gerar rotas para controller
Route::resource('users', UserController::class)->only(['destroy']); // apenas para destroy
Route::resource('users2', UserController::class)->except(['destroy']); // menos para destroy

//Mutiplos resources
Route::resources([ // não é possivel colocar o only ou except
    'users3' => UserController::class,
    'users4' => UserController::class,
]);

//Resource API
Route::apiResource('api/usersAPI', UserController::class)->except(['destroy']); // menos para destroy
//Mutiplos resources API
Route::apiResources([
    'api/users3' => UserController::class,
    'api/users4' => UserController::class,
]);

//Usado para manipular os comentários de um usuário sem a necessidade de passar os usuário logo o larvel cria rotas para manupular diretamente os comentarios
Route::resource('usersS.comentarios', UserController::class)->shallow();
/* 
  GET|HEAD        comentarios/{comentario} ........................................ comentarios.show › UserController@show
  PUT|PATCH       comentarios/{comentario} .................................... comentarios.update › UserController@update
  DELETE          comentarios/{comentario} .................................. comentarios.destroy › UserController@destroy
  GET|HEAD        comentarios/{comentario}/edit ..............................omentarios.edit › UserController@edit


  e tbm mantém as rotas para mudar os datos atraves do usuário - as manipulações de comentario não está atrelada AO user APENAS DE LISTAGEM

  GET|HEAD        usersS/{usersS}/comentarios ............................ usersS.comentarios.index › UserController@index
  POST            usersS/{usersS}/comentarios ............................ usersS.comentarios.store › UserController@store
  GET|HEAD        usersS/{usersS}/comentarios/create ................... usersS.comentarios.create › UserController@create

*/


Route::resource('posts2.comments', PostController::class)->parameters([
    'posts2'=> 'admin_post', // vai alterar o nome padrão dos parametros da url
    'comments' => 'admin_comments'
]); 



Route::fallback(function(){
    return redirect()->route('home');
});




/* 
criar controller resorce

php artisan make: controller UserController --resource


criar controller resorce + model 

php artisan make: controller UserController --resource --model=User


*/

