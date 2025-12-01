<?php

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
