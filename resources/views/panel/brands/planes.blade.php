@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a>
    <a href="{{route('brands.index')}}" class="bred">Marcas ></a>
    <a href="{{route('brands.planes', $brand->id)}}"
        class="bred">Aviões</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Gestão de Aviões'}}</h1>
</div>

<div class="content-din">
    <div class="content-din bg-white">

        <table class="table table-striped">
            <tr>
                <th style="width:100px;">#</th>
                <th>Classe</th>
                <th>Total de passageiros</th>
            </tr>

            @forelse ($planes as $plane)
            <tr>
                <td>{{$plane->id}}</td>
                <td>{{$plane->classes_planes($plane->class)}}</td>
                <td>{{$plane->qtd_passengers}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4"><strong>Nenhum avião cadastrado.</strong> </td>
            </tr>
            @endforelse

        </table>
        <a href="{{route('brands.index')}}" class="btn btn-link">Voltar</a>
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