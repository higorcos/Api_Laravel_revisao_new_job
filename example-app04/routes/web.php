<?php

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $users = DB::table('users')->get(); // traz todos 


    //forma de pegar mais de um objeto
    $user = DB::table('users')->find(5);  //ID
    $user = DB::table('users')->where('email', 'higorCosta@gmail.com')->first(); // pegar o ultimo adicionado  

    //verificar se um dado existe
    $user = DB::table('users')->where('email', 'higorCosta@gmail.com')->exists(); //se existir
    $user = DB::table('users')->where('email', 'higorCosta@gmail.com')->doesntExist(); // se não existir 

    // selecionar coluna da tabela
    $users = DB::table('users')->select('name','email')->get(); // apenas a coluna vai ser trazida
    $users = DB::table('users')->select('name','email as email2')->get(); // alterando o nome da table com sql

    //ordenar resultado
    $users = DB::table('users')->orderBy('name','desc')->get(); 
    $users = DB::table('users')->orderByDesc('name')->get(); 
    $users = DB::table('users')->inRandomOrder()->get();  //de forma aleatoria 
    $users = DB::table('users')->latest()->get();  //mais novos 
    $users = DB::table('users')->oldest()->get();  //mais antigos 
    

    //limitar resultados
    $users = DB::table('users')->limit(2)->skip(3)->get();  // os dois mais recentes === ->take(2)
    //->skip(3) // Pular os 3 dentre o resultado  ==  ->offset(1)
    // usado para paginação 



    //Trabalhando com where 
    $users = DB::table('users')->where('name','=','Cordie Ortiz')->first(); // parametros (coluna, operador, valor)
    // first = faz fazer diretamente o objeto com os dados do unico objeto 
    // pode usar mais de um where
    // ultiliza-se o mesmos operadores do sql
    //quando omete o operador ele entende que é o operador de "=" ->where('name','Cordie Ortiz')
    // arrray de where 
    $users = DB::table('users')->where([['id','=',1], ['name','like','higor%']])->first();
    //SELECT * FROM users WHERE name='x' or name='y'
    $users = DB::table('users')->where('name','higor')->orwhere('name','costa')->get();//->where()->orWhere() ou um ou outro
    // ou ---- MELHOR
    //SELECT * FROM users WHERE name='x' or (name = 'y' and id='1')
    $users = DB::table('users')
        ->where('name','higor')
        ->orwhere(function($query){
            $query->where('name','costa');
            //$query->where('name','costa'); pode adicionar outras query
        })
        ->get();


    
    $users = DB::table('users')->whereNot('name','higor')->get();//whereNot mesmo sentindo do operador != (deferente de)
    //->orwhereNot
    //->toSql(); //para mostrar o sql;



    $users = DB::table('users')->where('name','like','higor%')->get();
    $users = DB::table('users')->whereLike('name','higor%')->get();
    $users = DB::table('users')->whereLike('name','higor%', caseSensitive:true)->get();
    //->whereNotLike();
    //=>orWhereLike();
    //=>orWhereNotLike();


    //consulta com intervalo de valores
    $users = DB::table('users')->whereBetween('id',[3,6])->get();
    $users = DB::table('users')->whereBetween('created_at',['2025-12-01','2025-12-30'])->get();
    //->whereNotBetween()
    //->orWhereBetween()

    //where com columas com os valores indicados
    $users = DB::table('users')->whereIn('id',[3,6, 10])->get();
    //->whereNotIn()
    //->orWhereIn()


    $users = DB::table('users')->whereNull('name',null)->get();// null
    //->whereNotNull()
    //->orWhereNull()

    //pesquisa pela data
    $users = DB::table('users')->whereDate('created_at','=','2025-12-02' )->get();
    //whereDay()
    //whereMonthy()
    //whereYear()

    //parara columa de um mesma tabela 
    $users = DB::table('users')->whereColumn('created_at','updated_at' )->get(); //se tiver igualdade entre ambas

    //Combinar where - whereall
    //Combinar where com orWhere - wherAny -----negação whereNone
    
    
    



    dd($users);
    return view('welcome');
});
///FILTRO-
Route::get('/query/', function (Request $request ) {
    $name = $request->name;

    $users = DB::table('users')
        ->when(!empty($name), function($query) use ($name){ /// quando a variavel name existir
            $query->whereLike('name', '%'. $name .'%');
        })
        ->get(); 
    return $users;
});

Route::get('/join', function () {
    $users = DB::table('users')->join('posts', 'users.id', '=', 'posts.user_id')->get(); 

});



Route::get('/car', function () {
    $car = Car::create([
        'seller_name'=> 'higor',
        'seller_email'=> 'higor@gmail.com',
        'make'=> 'fiat',
        'year'=> '2000',
        'model'=> 'fiat 500',
        'user_id' => '1',
    ]);
    return [$car ];
});

Route::get('/cars', function () {
    $cars = Car::all();
    return $cars ;
});

Route::get('/car/{id}', function ($id) {
    $cars = Car::find($id);
    return $cars ;
}); 

Route::get('/carr/{id}', function (Request $request,$id) {
    $newCar = [
        'seller_name'=> 'higor',
        'seller_email'=> 'higor@gmail.com',
        'make'=> 'fiat',
        'year'=> '2000',
        'model'=> 'fiat 500',
        ];
    //modo alternativo
    /*  $car = Car::find($id);
    $car->fill($newCar);
    $car->save(); 
    */


    $car = Car::where('id',$id)->update($newCar);


    return  $car;
});

Route::get('/car/del/{id}', function (Request $request,$id) {
    $car = Car::find($id)->delete();
    return  $car;
    

});


Route::get('/pesquisar-criar', function (Request $request) {
    $newCar = [
        'seller_name'=> 'higor02',
        'seller_email'=> 'higor@gmail.com', /// Está criando com esse email aqui 
        'make'=> 'fiat',
        'year'=> '2000',
        'model'=> 'fiat 500',
        'user_id' => '1'
    ];
    $car = Car::firstOrCreate(['seller_email'=> 'higor1@gmail.com'],$newCar); //Pesquisar ou criar se não encontrar
    //primeiro array de pesquisa segundo de criação


    $car = Car::firstOrNew(['seller_email'=> 'higor1@gmail.com'],$newCar); //Apenas Pesquisar 

    return  $car;
    

});

Route::get('/atualiza-ou-criar', function (Request $request) {
    $newCar = [
        'seller_name'=> 'higor02',
        'seller_email'=> 'higor@gmail.com',  
        'make'=> 'fiat',
        'year'=> '2025',// novo dado
        'model'=> 'fiat argo', //
        'user_id' => '1'
    ];
    //atualiza ou cria
    $car = Car::updateOrCreate(['seller_email'=> 'higor@gmail.com'],$newCar); 

    return  $car;
    

});


Route::get('/chunk-0', function (Request $request) {

    //atualiza todo o banco em bloco de 2 em 2 
    //chunk-Vai pesquisar e atualiza de 2 em dois
   Car::chunk(2,function($cars){
    $cars->each(function($car){
        $car->year = '2050';
        $car->save();
    });
   });

   //pode colar query

   Car::where('year','>','2001')->chunk(2,function($cars){});

    return ['chunk'=>'0'];
});


Route::get('/chunk-1', function (Request $request) {

    //lazyById-Vai realizar todas as pesquisas tbm de 2 em dois porém na hora de atualizar vai ser tudo junto
   Car::lazyById(2,'id')
   ->each->update(['year'=>'2000']);


    return ['lazyById-'=>'1'];
});


Route::get('/chunk-3', function (Request $request) {
    // Vai trazer todas que satisfazem a query porém
    //só vai trazer para a memoria o que estiver sendo interado
    Car::cursor()->each->update(['year'=>'2005']);


    return ['CURSOr-'=>'1'];
});

Route::get('/chunk-3', function (Request $request) {
    // Vai trazer todas que satisfazem a query porém
    //só vai trazer para a memoria o que estiver sendo interado
    Car::cursor()->each->update(['year'=>'2005']);


    return ['CURSOR-'=>'1'];
});

Route::get('/scope-local', function (Request $request) {
    $cars = Car::CarList()->get();
    //$cars = Car::CarList()->where()->get();

    //escorpo local para reutilizar query repetida - O NOME no model tem que começar com scope e na chamada é sem o scope
 
    return $cars;
});

Route::get('/relacionamento0', function (Request $request) {
    $car = Car::find(2);
    return $car->user; // vai trazer apenas o user sem dados do carro
});



Route::get('/relacionamento1', function (Request $request) {
    $car = Car::with(['user'])->find(2); //fazer pesquisa com relacionamento
    return $car;
});


Route::get('/relacionamento0-create', function (Request $request) {
      $newCar = [
        'seller_name'=> 'higor02',
        'seller_email'=> 'higor@gmail.com',  
        'make'=> 'fiat NEW create relacionamento',
        'year'=> '2025',// novo dado
        'model'=> 'fiat argo', //
        'user_id' => '1'
    ];
   
    $user = User::find(1);
    $user->cars()->create($newCar);
    //$user->cars()->update($newCar);
    //$user->cars()->delete();

    return $user;
});

Route::get('/relacionamento2', function (Request $request) {
    $user = User::with(['cars'])->find(1); //fazer pesquisa com relacionamento
    return $user;
});

Route::get('/relacionamento2-create', function (Request $request) {
       $newCar = [
        'seller_name'=> 'higor02',
        'seller_email'=> 'higor@gmail.com',  
        'make'=> 'fiat NEW create relacionamento',
        'year'=> '2025',// novo dado
        'model'=> 'fiat argo', //
        'user_id' => '1'
    ];
    $user = User::find(2);
    $user->cars()->create($newCar); //um registro
    $user->cars()->saveMany([
        new Car($newCar),
        new Car($newCar),
        new Car($newCar),
    ]); //muitos
    
    
    return $user;
});


