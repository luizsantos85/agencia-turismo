@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('planes.index')}}"
        class="bred">Voos</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Gestão de Voos'}}</h1>
</div>

<div class="content-din">
    <div class="content-din">
        <div class="class-btn-insert">
            <a href="{{route('flights.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>
    </div>

    @include('panel.layouts.alerts')

    <div class="content-din bg-white">
        <div class="form-search">
            {!! Form::open(['route' => 'flights.search','class' => 'form form-inline']) !!}
            {!! Form::text('keySearch', null, ['class'=> 'form-control', 'placeholder' => 'Digite a pesquisa...'])!!}
            <button class="btn btn-default">Pesquisar</button>
            {!! Form::close() !!}
        </div>



        <table class="table table-striped">
            <tr>
                <th style="width:100px;">#</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Paradas</th>
                <th>Data</th>
                <th>Saída</th>
                <th style="width:150px;">Ações</th>
            </tr>

            @forelse ($flights as $flight)
            <tr>
                <td>{{ $flight->id }}</td>
                <td>
                    <a href="#">{{ $flight->origin->name }}</a>
                </td>
                <td>
                    <a href="#">{{ $flight->destination->name }}</a>
                </td>
                <td>{{ $flight->qtd_stops }}</td>
                <td>{{ $flight->date }}</td>
                <td>{{ $flight->hour_output }}</td>
                <td>
                    <a href="{{route('flights.edit', $flight->id)}}" class="btn btn-sm btn-warning">Editar</a>
                    <a href="{{route('flights.destroy', $flight->id)}}" class="btn btn-sm btn-default">Deletar</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7"><strong>Nenhum voo cadastrado.</strong> </td>
            </tr>
            @endforelse

        </table>
        @if (isset($dataForm))
            {!! $flights->appends($dataForm)->links('pagination::bootstrap-4') !!}
        @else
            {!! $flights->links('pagination::bootstrap-4') !!}
        @endif
    </div>
    <!--Content Dinâmico-->

</div>
<!--Content Dinâmico-->
@endsection