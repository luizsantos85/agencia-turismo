@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a>
    <a href="{{route('airports.index',$city->id)}}" class="bred">Aeroportos</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$title ?? "Aeroportos da Cidade de: $city->name"}}</h1>
    <div class="both"></div>
    <small style="margin-left: 10px;">
        Total de aeroportos: <strong>({{ $airports->total() }})</strong>
    </small>
</div>

<div class="content-din">
    <div class="class-btn-insert">
        <a href="{{route('airports.create',$city->id)}}" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span>
            Cadastrar
        </a>
    </div>
</div>

@include('panel.layouts.alerts')

<div class="content-din">

    <div class="content-din bg-white">
        <div class="form-search">
            {!! Form::open(['route' => ['airports.search',$city->id],'class' => 'form form-inline']) !!}
                {!! Form::text('name', null, ['class'=> 'form-control', 'placeholder' => 'Nome do aeroporto...'])!!}
                <button class="btn btn-default">Pesquisar</button>
            {!! Form::close() !!}
        </div>



        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>Endereço</th>
                <th style="width:150px;">Ações</th>
            </tr>

            @forelse ($airports as $airport)
            <tr>
                <td>{{ $airport->name }}</td>
                <td>{{ $airport->address }}</td>
                <td>
                    <a href="{{route('airports.edit', [$city->id,$airport->id])}}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <a href="{{route('airports.show', [$city->id,$airport->id])}}"
                        class="btn btn-sm btn-info">Detalhes</a>
                </td>

            </tr>
            @empty
                <tr>
                    @if(isset($dataForm))
                        <td colspan="4"><strong>Nenhum Aeroporto encontrado com esse nome.</strong> </td>
                    @else
                        <td colspan="4"><strong>Nenhum Aeroporto cadastrado.</strong> </td>
                    @endif
                </tr>
            @endforelse

        </table>
        @if (isset($dataForm))
            {!! $airports->appends($dataForm)->links('pagination::bootstrap-4') !!}
        @else
            {!! $airports->links('pagination::bootstrap-4') !!}
        @endif
    </div>
    <!--Content Dinâmico-->

</div>
<!--Content Dinâmico-->
@endsection