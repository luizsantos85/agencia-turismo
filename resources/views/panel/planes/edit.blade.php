@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('planes.index')}}"
        class="bred">Aviões ></a> <a href="" class="bred">Editar</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? ""}}</h1>
</div>
<div class="content-din">

    @include('panel.layouts.alerts')

    {!! Form::model($plane, ['route' => ['planes.update',$plane->id], 'class' => 'form form-search form-ds', 'method' =>
    'PUT']) !!}
        @include('panel.planes.form')
    {!! Form::close() !!}

</div>
<!--Content Dinâmico-->
@endsection