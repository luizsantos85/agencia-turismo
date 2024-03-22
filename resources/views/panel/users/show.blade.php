@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('users.index')}}"
        class="bred">Usuários ></a> <a href="" class="bred">Detalhes</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? ""}}</h1>
</div>
<div class="content-din">

    {!! Form::open(['route' => ['users.destroy', $user->id], 'class' => 'form form-search form-ds', 'method' =>
    'DELETE']) !!}
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">Nome:</label>
            <input type="text" value="{{$user->name}}" disabled class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="">E-mail:</label>
            <input type="text" value="{{$user->email}}" disabled class="form-control">
        </div>
        <div class="form-group col-md-6">
            <strong>
                Admin?
            </strong>
             {{$user->is_admin == 1 ? 'Sim' : 'Não'}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if ($user->image)
            <img src="{{url("storage/users/{$user->image}")}}" alt="image_{{$user->id}}" style="width: 50px;">
            @else
            <img src="{{url("assets/panel/imgs/no-image.png")}}" alt="image" style="width: 50px;">
            @endif
        </div>
    </div>

    <div class="mt-3">
        <button class="btn btn-sm btn-danger"
            onclick="return confirm('Deseja realmente excluir a companhia aérea?')">Deletar</button>
        <a href="{{route('users.index')}}" class="btn btn-sm btn-link">Voltar</a>
    </div>
    {!! Form::close() !!}

</div>
<!--Content Dinâmico-->
@endsection