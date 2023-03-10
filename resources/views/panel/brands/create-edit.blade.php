@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('brands.index')}}"
        class="bred">Marcas ></a> <a href="" class="bred">Gestão</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? ""}}</h1>
</div>
<div class="content-din">

    @include('panel.layouts.alerts')

    @if (isset($brand))
        {{-- <form class="form form-search form-ds" action="{{route('brands.update', $brand->id)}}" method="POST"> --}}
        {{-- @method('PUT') --}}
        {!! Form::model($brand,['route' => ['brands.update', $brand->id], 'class' => 'form form-search form-ds', 'method' => 'PUT']) !!}
    @else
        {{-- <form class="form form-search form-ds" action="{{route('brands.store')}}" method="POST"> --}}
        {!! Form::open(['route' => 'brands.store', 'class' => 'form form-search form-ds']) !!}
    @endif
            <div class="form-group">
                {{-- <input type="text" name="name" placeholder="Nome:" class="form-control" value="{{$brand->name ?? old('name')}}"> --}}
                {!! Form::text('name', null, ['class'=> 'form-control', 'placeholder' => 'Nome...'])!!}
            </div>

            <div class="form-group">
                <button class="btn btn-sm btn-primary">Salvar</button>
                <a href="{{route('brands.index')}}" class="btn btn-sm btn-link">Voltar</a>
            </div>
        {!! Form::close() !!}

</div>
<!--Content Dinâmico-->
@endsection