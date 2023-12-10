@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('flights.index')}}"
        class="bred">Voos ></a> <a href="" class="bred">Cadastro</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? ""}}</h1>
</div>
<div class="content-din">

    @include('panel.layouts.alerts')

    {!! Form::open(['route' => 'flights.store', 'class' => 'form form-search form-ds', 'files' => true]) !!}
    @include('panel.flights.form')
    {!! Form::close() !!}

</div>
<!--Content Dinâmico-->
@endsection