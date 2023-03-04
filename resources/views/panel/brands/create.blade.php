@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('brands.index')}}"
        class="bred">Marcas ></a> <a href="{{route('brands.create')}}" class="bred">Cadastrar</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Cadastro de novo avião'}}</h1>
</div>
<div class="content-din">

    <form class="form form-search form-ds" action="{{route('brands.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="Nome:" class="form-control">
        </div>

        <div class="form-group">
            <button class="btn btn-search">Salvar</button>
        </div>
    </form>

</div>
<!--Content Dinâmico-->
@endsection