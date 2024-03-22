@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('users.index')}}"
        class="bred">Usuários</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Gestão de Aviões'}}</h1>
</div>

<div class="content-din">
    <div class="content-din">
        <div class="class-btn-insert">
            <a href="{{route('users.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>
    </div>

    @include('panel.layouts.alerts')

    <div class="content-din bg-white">
        <div class="form-search">
            <form action="{{route('users.search')}}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="name" id="name" class="form-control" placeholder="Nome...">
                <button class="btn btn-default">Pesquisar</button>
            </form>
        </div>

        <table class="table table-striped ">
            <tr>
                <th style="width:100px;">Imagem</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th width="200">Ações</th>
            </tr>

            @forelse ($users as $user)
            <tr>
                <td>
                    @if ($user->image)
                    <img src="{{url("storage/users/{$user->image}")}}" alt="image_{{$user->id}}" style="width: 50px;">
                    @else
                    <img src="{{url("assets/panel/imgs/no-image.png")}}" alt="image" style="width: 50px;">
                    @endif
                </td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-sm btn-warning">Editar</a>
                    <a href="{{route('users.show', $user->id)}}" class="btn btn-sm btn-info">Detalhes</a>
                </td>
            </tr>
            @empty
            <tr>
                <td>Nenhuma marca cadastrada.</td>
            </tr>
            @endforelse

        </table>
        @if (isset($dataForm))
        {!! $users->appends($dataForm)->links('pagination::bootstrap-4') !!}
        @else
        {!! $users->links('pagination::bootstrap-4') !!}
        @endif
    </div>
    <!--Content Dinâmico-->

</div>
<!--Content Dinâmico-->
@endsection