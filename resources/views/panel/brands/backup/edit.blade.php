@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('brands.index')}}"
        class="bred">Marcas ></a> <a href="{{route('brands.edit', $brand->id)}}" class="bred">Editar</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Cadastro de novo avião'}}</h1>
</div>
<div class="content-din">

    @include('panel.layouts.alerts')

    <form class="form form-search form-ds" action="{{route('brands.update', $brand->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="Nome:" class="form-control" value="{{$brand->name}}">
            {{-- <input type="hidden" name="id" value="{{$brand->id}}"> --}}
        </div>

        <div class="form-group">
            <button class="btn btn-search">Salvar</button>
        </div>
    </form>

</div>
<!--Content Dinâmico-->
@endsection