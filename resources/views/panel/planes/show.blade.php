@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('planes.index')}}"
        class="bred">Aviões ></a> <a href="" class="bred">Detalhes</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? ""}}</h1>
</div>
<div class="content-din">

    {!! Form::open(['route' => ['planes.destroy', $plane->id], 'class' => 'form form-search form-ds', 'method' =>
    'DELETE']) !!}
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">ID:</label>
            <input type="text" value="{{$plane->id}}" disabled class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="">Quantidade de passageiros:</label>
            <input type="text" value="{{$plane->qtd_passengers}}" disabled class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label for="">Classe:</label>
            <input type="text" value="{{$plane->classes_planes($plane->class)}}" disabled class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="">Companhia aérea:</label>
            <input type="text" value="{{$plane->brand->name}}" disabled class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <button class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir o avião?')">Deletar</button>
            <a href="{{route('planes.index')}}" class="btn btn-sm btn-link">Voltar</a>
        </div>
    </div>
    {!! Form::close() !!}

</div>
<!--Content Dinâmico-->
@endsection