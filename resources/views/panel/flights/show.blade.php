@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('flights.index')}}"
        class="bred">Voos ></a> <a href="" class="bred">Detalhes</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? ""}}</h1>
</div>

<div class="content-din">
    <div class="col-md-9">
        <p class="text"><strong>ID:</strong> {{$flight->id}}</p>
        <p class="text"><strong>Origem:</strong> {{$flight->origin->name}}</p>
        <p class="text"><strong>Destino:</strong> {{$flight->destination->name}}</p>
        <p class="text"><strong>Data:</strong> {{formatDateAndTime($flight->date)}}</p>
        <p class="text"><strong>Duração:</strong> {{formatDateAndTime($flight->time_duration,'H:i')}}</p>
        <p class="text"><strong>Saída:</strong> {{formatDateAndTime($flight->hour_output,'H:i')}}</p>
        <p class="text"><strong>Chegada:</strong> {{formatDateAndTime($flight->arrival_time,'H:i')}}</p>
        <p class="text"><strong>Valor anterior: R$</strong> {{number_format($flight->old_price,2, ',','.')}}</p>
        <p class="text"><strong>Valor atual: R$</strong> {{number_format($flight->price,2, ',','.')}}</p>
        <p class="text"><strong>Total de parcelas:</strong> {{$flight->total_plots}}</p>
        <p class="text"><strong>Promocional?</strong> {{$flight->is_promotion ? 'Sim' : 'Não'}}</p>
        <p class="text"><strong>Paradas:</strong> {{$flight->qtd_stops}}</p>
        <p class="text"><strong>Descrição:</strong> {{$flight->description}}</p>
    </div>

    <div class="col-md-6">
        <form action="{{route('flights.destroy', $flight->id)}}" method="post">
            @method('delete')
            @csrf
            <button class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir o avião?')">
                Deletar
            </button>
        </form>
        <a href="{{route('flights.index')}}" class="btn btn-sm btn-link">Voltar</a>
    </div>

</div>
<!--Content Dinâmico-->
@endsection