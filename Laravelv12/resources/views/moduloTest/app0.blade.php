@extends('layouts.app')

@section('title')
    Modulo Views
@endsection

@section('content')
    <h6>Nova rota</h6>
    
    
    {{$user = 30}}
    @if($user > 40)
       tem mais de 40
    @elseif($user < 40)
    menor que 40
    @else
        igual a 40
    @endif
    
        {{-- negação --}}
    {{-- @unless($person)
    não foi passado esse parametro 
    @endunless
    --}}


        {{-- Verifição --}} 
    @if(!empty($person))
        Variável Vazia
    @endif

    @if(isset($person))
        Variável Existe
    @endif


    </br>
    @for ($i = 0; $i < 10; $i++)
        {{$i}}
    @endfor


    @foreach ($collection as $item)
        {{-- {{dd($loop)}}  varias informações sobre o  foreach--}} 
        <p>{{$item['name']}} - {{$item['age']}}</</p>

    @endforeach


    </br> 
    @forelse ($users as $item)
        {{$item}}
    @empty
        Não encontrado variavel users
    @endforelse

    </br> 

    @switch(2)
        @case(1)
            número 1
            
            @break
        @case(2)
            número 2
            @break
        @default
            
    @endswitch


    <br>

    Sub views aqui >>  
    {{-- @include('..layouts.heading') --}}
    {{-- Mostra se a view existir --}}
    {{-- @includeIf('..layouts.heading') --}}
    {{-- Mostra se o primeira parametro for true --}}
    {{-- @includeWhen(true, '..layouts.heading')  --}}
    {{-- Mostra se o primeira parametro for false --}}
    {{-- @includeUnless(false, '..layouts.heading')  --}}
    {{-- Vai renderizar a primeira view que existir --}}
    {{-- @includeFirst('..layouts.heading2','..layouts.heading')  --}}

    {{-- TODAS OS METODOS ACEITÃO VARIÁVEIS --}}
    {{-- @include('name', ['title'=>'abcde']) --}}


    {{-- passar variavel para layout --}}
    {{-- @each('view.name', $collection, 'variable', 'view.empty') --}}
    
    @php
        $count = 0;
        
        foreach ($users as $key => $value) {
            # code...
        } 
    @endphp




@endsection