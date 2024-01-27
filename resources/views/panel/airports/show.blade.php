@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a>
    <a href="{{route('airports.index',$city->id)}}" class="bred">Aeroportos ></a>
    <a href="" class="bred">Detalhes</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? ""}}</h1>
</div>

<div class="content-din">
    {!! Form::open(['route' => ['airports.destroy', [$city->id, $airport->id]], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Cidade:</label>
                <input type="text" value="{{$city->name}}" disabled class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="">Nome do Aeroporto:</label>
                <input type="text" value="{{$airport->name}}" disabled class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="">Latitude:</label>
                <input type="text" value="{{$airport->latitude}}" disabled class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="">Longitude:</label>
                <input type="text" value="{{$airport->longitude}}" disabled class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="">Endereço:</label>
                <input type="text" value="{{$airport->address}}" disabled class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="">Número:</label>
                <input type="text" value="{{$airport->number}}" disabled class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="">Código Postal:</label>
                <input type="text" value="{{$airport->zip_code}}" disabled class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="">Complemento:</label>
                <input type="text" value="{{$airport->complement}}" disabled class="form-control">
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-sm btn-danger"
                onclick="return confirm('Deseja realmente excluir a companhia aérea?')">Deletar</button>
            <a href="{{route('airports.index',$city->id)}}" class="btn btn-sm btn-link">Voltar</a>
        </div>
    {!! Form::close() !!}

</div>
<!--Content Dinâmico-->
@endsection