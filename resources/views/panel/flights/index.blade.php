@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('flights.index')}}"
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
            {!! Form::number('code', null, ['class'=> 'form-control', 'placeholder' => 'Código do voo...'])!!}
            {!! Form::date('date', null, ['class'=> 'form-control'])!!}
            {!! Form::select('origin',$airports, null, ['class'=> 'form-control','placeholder' => 'Origem'])!!}
            {!! Form::select('destination',$airports, null, ['class'=> 'form-control', 'placeholder' => 'Destino'])!!}

            <button class="btn btn-default">Pesquisar</button>
            {!! Form::close() !!}
        </div>



        <table class="table table-striped">
            <tr>
                <th style="width:100px;">#</th>
                <th>Imagem</th>
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
                    @if ($flight->image)
                    <img src='{{url("storage/flights/$flight->image")}}' alt="{{$flight->id}}" style="width: 50px;">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="#">{{ $flight->origin->name }}</a>
                </td>
                <td>
                    <a href="#">{{ $flight->destination->name }}</a>
                </td>
                <td>{{ $flight->qtd_stops }}</td>
                <td>{{ formatDateAndTime($flight->date) }}</td>
                <td>{{ formatDateAndTime($flight->hour_output, 'H:i') }}</td>
                <td>
                    <a href="{{route('flights.edit', $flight->id)}}" class="btn btn-sm btn-warning">Editar</a>
                    <a href="{{route('flights.show', $flight->id)}}" class="btn btn-sm btn-default">Detalhes</a>
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