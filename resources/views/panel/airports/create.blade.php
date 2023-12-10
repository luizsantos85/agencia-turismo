@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a>
    <a href="{{route('airports.index',$city->id)}}" class="bred">Aeroportos ></a>
    <a href="" class="bred">Cadastro</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? ""}}</h1>
</div>
<div class="content-din">

    @include('panel.layouts.alerts')

    {!! Form::open(['route' => ['airports.store', $city->id], 'class' => 'form form-search form-ds', 'files' => true]) !!}
        @include('panel.airports.form')
    {!! Form::close() !!}

</div>
<!--Content Dinâmico-->
@endsection