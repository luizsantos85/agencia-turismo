@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel.index')}}" class="bred">Dashboard ></a>
    <a href="{{route('reserves.index')}}" class="bred">Reservas ></a>
    <a href="{{route('reserves.create')}}" class="bred">Cadastrar</a>
</div>


<div class="title-pg">
    <h1 class="title-pg">{{$title ?? 'Cadastro de nova reserva'}}</h1>
</div>
<div class="content-din">

    @include('panel.layouts.alerts')

    <form class="form form-search form-ds" action="{{route('reserves.store')}}" method="POST">
        @csrf

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="">Data da reserva</label>
                    <input type="date" name="date_reserved" class="form-control" value="{{old('date_reserved')}}"
                        onchange="buscarVoo()">
                </div>

                <div class="form-group mb-3">
                    <label for="">Status</label>
                    <select name="status" id="" class="form-control">
                        <option value="" disabled selected>Selecione...</option>
                        @foreach ($status as $mode => $name)
                        <option value="{{$mode}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="">Usuário</label>
                    <select name="user_id" id="" class="form-control">
                        <option value="" disabled selected>Selecione...</option>
                        @foreach ($users as $id => $user)
                        <option value="{{$id}}">{{$user}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- O voo de destino deve ser assincrono, sendo possivel puxar o voo de acordo com a data selecionada,
                se não tiver voo nesse dia, mostrar no option que não há voo no dia informado. --}}
                <div class="form-group mb-3">
                    <label for="">Voo de destino</label>
                    <select name="flight_id" id="" class="form-control">
                        <option value="" disabled selected>Selecione...</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="input-group justify-content-start"> <button class="btn btn-primary">Salvar</button>
        </div>
    </form>

</div>
<!--Content Dinâmico-->


@push('scripts')
<script>
    async function buscarVoo(){
            let dataVoo = document.querySelector('input[name="date_reserved"]').value;
            let url = "{{route('obterVoo')}}"
            let token = document.querySelector('input[name="_token"]').value;

            try {
                let req = await fetch(url,{
                    method: 'post',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ dataVoo: dataVoo })
                });

                let json = await req.json();

                montarOpcoesCampoSelect(json)
            } catch (error) {
                console.error(error);
            }
        }

    function montarOpcoesCampoSelect(voos){
        let select = document.querySelector('select[name="flight_id"]');
        select.innerHTML = '';
        let defaultOption = document.createElement('option');
        defaultOption.value = '';

        if(voos.length == 0){
            defaultOption.text = 'Nenhum voo disponível para esta data';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            select.appendChild(defaultOption);
        }else{
            defaultOption.text = 'Selecione...';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            select.appendChild(defaultOption);

            voos.forEach(voo => {
                let option = document.createElement('option');
                option.value = voo.id;
                option.text = voo.destination.name;
                select.appendChild(option);
            });
        }
    }
</script>
@endpush
@endsection