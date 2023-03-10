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
            <a href="{{route('brands.create')}}" class="btn btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>
    </div>

    @include('panel.layouts.alerts')

    <div class="content-din bg-white">
        <div class="form-search">
            <form class="form form-inline">
                <input type="text" name="nome" placeholder="Nome:" class="form-control">
                <input type="text" name="email" placeholder="E-mail:" class="form-control">
                <button class="btn btn-search">Pesquisar</button>
            </form>
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
                    <a href="{{route('brands.edit', $brand->id)}}" class="edit">Edit</a>
                    <a href="{{route('brands.destroy', $brand->id)}}" class="delete">Delete</a>
                </td>
            </tr>
            @empty
            <tr>
                <td>Nenhum avião cadastrado.</td>
            </tr>
            @endforelse

        </table>

        {!! $brands->links('pagination::bootstrap-4') !!}
    </div>
    <!--Content Dinâmico-->

</div>
<!--Content Dinâmico-->
@endsection