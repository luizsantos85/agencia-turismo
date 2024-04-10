@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('reserves.index')}}"
        class="bred">Reservas</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Gestão de reservas'}}</h1>
</div>

<div class="content-din">
    <div class="content-din">
        <div class="class-btn-insert">
            <a href="{{route('reserves.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>
    </div>

    @include('panel.layouts.alerts')

    <div class="content-din bg-white">
        <div class="form-search">
            <form action="{{route('reserves.search')}}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="name_user" class="form-control" placeholder="Nome de usuário...">
                <input type="text" name="id_voo" class="form-control ml-1" placeholder="Id do voo...">
                <input type="date" name="date_flight" class="form-control ml-1" placeholder="Data de partida...">
                <select name="status" id="" class="form-control ml-1">
                    <option value="" disabled selected>Selecione...</option>
                    @foreach ($status as $mode => $name)
                        <option value="{{$mode}}">{{$name}}</option>
                    @endforeach
                </select>
                <button class="btn btn-default">Pesquisar</button>
            </form>
        </div>

        <table class="table table-striped ">
            <tr>
                <th>Usuário</th>
                <th>Voo</th>
                <th>Destino</th>
                <th>Data</th>
                <th>Status</th>
                <th width="200">Ações</th>
            </tr>

            @forelse ($reserves as $reserve)
            <tr>
                <td>{{$reserve->user->name}}</td>
                <td>{{$reserve->flight->id}}</td>
                <td>{{$reserve->flight->destination->name}}</td>
                {{-- <td>{{ date('d/m/Y', strtotime($reserve->date_reserved))}}</td> --}}
                <td>{{ formatDateAndTime($reserve->date_reserved) }}</td>
                <td>{{$reserve->status($reserve->status)}}</td>
                <td>
                    <a href="{{route('reserves.edit', $reserve->id)}}" class="btn btn-sm btn-warning">Editar</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Nenhuma reserva cadastrada.</td>
            </tr>
            @endforelse

        </table>
        @if (isset($dataForm))
        {!! $reserves->appends($dataForm)->links('pagination::bootstrap-4') !!}
        @else
        {!! $reserves->links('pagination::bootstrap-4') !!}
        @endif
    </div>
    <!--Content Dinâmico-->

</div>
<!--Content Dinâmico-->
@endsection