@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a>
    <a href="#" class="bred">Estados</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Gestão de Estados Brasileiros'}}</h1>
</div>

<div class="content-din">

    {{-- @include('panel.layouts.alerts') --}}

    <div class="content-din bg-white">
        <div class="form-search">
            {!! Form::open(['route' => 'states.search','class' => 'form form-inline']) !!}
            {!! Form::text('keySearch', null, ['class'=> 'form-control', 'placeholder' => 'Digite a pesquisa...'])!!}
            <button class="btn btn-default">Pesquisar</button>
            {!! Form::close() !!}
        </div>



        <table class="table table-striped">
            <tr>
                <th style="width:100px;">#</th>
                <th>Nome</th>
                <th>Sigla</th>
                <th style="width:150px;">Ações</th>
            </tr>

            @forelse ($states as $state)
            <tr>
                <td>{{ $state->id }}</td>
                <td>{{ $state->name }}</td>
                <td>{{ $state->initials }}</td>
                <td>
                    <a href="{{route('cities.index',$state->initials)}}" class="btn btn-sm btn-info"><i class="fa fa-map-marker" aria-hidden="true"></i> Cidades</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4"><strong>Nenhum estado cadastrado.</strong> </td>
            </tr>
            @endforelse

        </table>
        {{-- @if (isset($dataForm))
            {!! $planes->appends($dataForm)->links('pagination::bootstrap-4') !!}
        @else
            {!! $planes->links('pagination::bootstrap-4') !!}
        @endif --}}
    </div>
    <!--Content Dinâmico-->

</div>
<!--Content Dinâmico-->
@endsection