@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a> <a href="{{route('planes.index')}}"
        class="bred">Aviões</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Gestão de Aviões'}}</h1>
</div>

<div class="content-din">
    <div class="content-din">
        <div class="class-btn-insert">
            <a href="{{route('planes.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>
    </div>

    @include('panel.layouts.alerts')

    <div class="content-din bg-white">
        <div class="form-search">
            {{-- {!! Form::open(['route' => 'planes.search','class' => 'form form-inline']) !!}
            {!! Form::text('name', null, ['class'=> 'form-control', 'placeholder' => 'Nome...'])!!}
            <button class="btn btn-default">Pesquisar</button>
            {!! Form::close() !!} --}}
        </div>



        <table class="table table-striped">
            <tr>
                <th style="width:100px;">#</th>
                <th>Classe</th>
                <th>Companhia Aérea</th>
                <th>Total de passageiros</th>
                <th style="width:150px;">Ações</th>
            </tr>

            @forelse ($planes as $plane)
            <tr>
                <td>{{$plane->id}}</td>
                <td>{{$plane->classes_planes($plane->class)}}</td>
                <td>{{$plane->brand->name}}</td>
                <td>{{$plane->qtd_passengers}}</td>
                <td>
                    <a href="{{route('planes.edit', $plane->id)}}" class="btn btn-warning">Edit</a>
                    <a href="{{route('planes.show', $plane->id)}}" class="btn btn-default">Detalhes</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4"><strong>Nenhum avião cadastrado.</strong> </td>
            </tr>
            @endforelse

        </table>
        @if (isset($dataForm))
            {!! $planes->appends($dataForm)->links('pagination::bootstrap-4') !!}
        @else
            {!! $planes->links('pagination::bootstrap-4') !!}
        @endif
    </div>
    <!--Content Dinâmico-->

</div>
<!--Content Dinâmico-->
@endsection