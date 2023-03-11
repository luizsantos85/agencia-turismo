@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('brands.index')}}"
        class="bred">Marcas</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Gestão de Aviões'}}</h1>
</div>

<div class="content-din">
    <div class="content-din">
        <div class="class-btn-insert">
            <a href="{{route('brands.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>
    </div>

    @include('panel.layouts.alerts')

    <div class="content-din bg-white">
        <div class="form-search">
            {!! Form::open(['route' => 'brands.search','class' => 'form form-inline']) !!}
            {!! Form::text('name', null, ['class'=> 'form-control', 'placeholder' => 'Nome...'])!!}
            <button class="btn btn-default">Pesquisar</button>
            {!! Form::close() !!}
        </div>



        <table class="table table-striped">
            <tr>
                <th style="width:100px;">#</th>
                <th>Nome</th>
                <th width="150">Ações</th>
            </tr>

            @forelse ($brands as $brand)
            <tr>
                <td>{{$brand->id}}</td>
                <td>{{$brand->name}}</td>
                <td>
                    <a href="{{route('brands.edit', $brand->id)}}" class="btn btn-warning">Edit</a>
                    <a href="{{route('brands.show', $brand->id)}}" class="btn btn-default">Detalhes</a>
                </td>
            </tr>
            @empty
            <tr>
                <td>Nenhum avião cadastrado.</td>
            </tr>
            @endforelse

        </table>
        @if (isset($dataForm))
            {!! $brands->appends($dataForm)->links('pagination::bootstrap-4') !!}
        @else
            {!! $brands->links('pagination::bootstrap-4') !!}
        @endif
    </div>
    <!--Content Dinâmico-->

</div>
<!--Content Dinâmico-->
@endsection