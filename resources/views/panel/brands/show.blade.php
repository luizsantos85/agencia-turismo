@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('brands.index')}}"
        class="bred">Marcas ></a> <a href="" class="bred">Detalhes</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? ""}}</h1>
</div>
<div class="content-din">

        {!! Form::open(['route' => ['brands.destroy', $brand->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
            <div class="form-group">
                <input type="text" value="{{$brand->name}}" disabled class="form-control">
            </div>

            <div class="form-group">
                <button class="btn btn-sm btn-danger">Deletar</button>
                <a href="{{route('brands.index')}}" class="btn btn-sm btn-link">Voltar</a>
            </div>
        {!! Form::close() !!}

</div>
<!--Content Dinâmico-->
@endsection