@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('brands.index')}}" class="bred">Marcas</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Gestão de Aviões'}}</h1>
</div>

<div class="content-din">

    <a href="{{route('brands.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar novo </a>

</div>
<!--Content Dinâmico-->
@endsection