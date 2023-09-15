@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a>
    <a href="{{route('states.index')}}" class="bred">Estados ></a>
    <a href="{{route('cities.index',$state->initials)}}" class="bred">{{$state->name}} </a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$title ?? "Cidades do estado: $state->name"}}</h1>
    <div class="both"></div>
    <small style="margin-left: 10px;">
        Total de cidades: <strong>({{ $cities->total() }})</strong>
    </small>
</div>

<div class="content-din">

    {{-- @include('panel.layouts.alerts') --}}

    <div class="content-din bg-white">
        <div class="form-search">
            {!! Form::open(['route' => ['cities.search',$state->initials],'class' => 'form form-inline']) !!}
            {!! Form::text('keySearch', null, ['class'=> 'form-control', 'placeholder' => 'Digite a pesquisa...'])!!}
            <button class="btn btn-default">Pesquisar</button>
            {!! Form::close() !!}
        </div>



        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th style="width:150px;">Ações</th>
            </tr>

            @forelse ($cities as $city)
            <tr>
                <td>{{ $city->name }}</td>
                <td>
                    Ações
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4"><strong>Nenhum estado cadastrado.</strong> </td>
            </tr>
            @endforelse

        </table>
        @if (isset($dataForm))
        {!! $cities->appends($dataForm)->links('pagination::bootstrap-4') !!}
        @else
        {!! $cities->links('pagination::bootstrap-4') !!}
        @endif
    </div>
    <!--Content Dinâmico-->

</div>
<!--Content Dinâmico-->
@endsection