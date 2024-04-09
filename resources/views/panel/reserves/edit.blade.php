@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a>
    <a href="{{route('reserves.index')}}" class="bred">Reservas ></a>
    <a href="{{route('reserves.create')}}" class="bred">Editar</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Edição de reserva de novo avião'}}</h1>
</div>
<div class="content-din">

    @include('panel.layouts.alerts')

    <form class="form form-search form-ds" action="{{route('reserves.update', $reserve->id)}}" method="POST">
        @method('PUT')
        @csrf

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="">Data da reserva</label>
                    <input type="text" name="date_reserved" class="form-control" value="{{ formatDateAndTime($reserve->date_reserved) }}" disabled>
                </div>

                <div class="form-group mb-3">
                    <label for="">Status</label>
                    <select name="status" id="" class="form-control">
                        <option value="" disabled selected>Selecione...</option>
                        @foreach ($status as $mode => $name)
                        <option value="{{$mode}}" @if (isset($reserve) && $reserve->status === $mode) selected @endif>{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="">Usuário</label>
                    <input type="text" disabled value="{{$user->name}}" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="">Voo de destino</label>
                    <input type="text" disabled value="{{$flight->destination->name}}" class="form-control">
                </div>
            </div>
        </div>

        <div class="input-group justify-content-start"> <button class="btn btn-primary">Salvar</button>
        </div>
    </form>

</div>
<!--Content Dinâmico-->
@endsection