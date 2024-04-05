@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('users.index')}}"
        class="bred">Usuários ></a> <a href="{{route('users.edit', $user->id)}}" class="bred">Editar</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Edição de usuário de novo avião'}}</h1>
</div>
<div class="content-din">

    @include('panel.layouts.alerts')

    <form class="form form-search form-ds" action="{{route('users.update', $user->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="Nome:" class="form-control" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Nome:" class="form-control" value="{{$user->email}}">
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Nova senha:" class="form-control">
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="is_admin" {{$user->is_admin == 1 ? 'checked' : ''}}>
            <label class="form-check-label" for="flexCheckDefault">
                É admin?
            </label>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Salvar</button>
        </div>
    </form>

</div>
<!--Content Dinâmico-->
@endsection