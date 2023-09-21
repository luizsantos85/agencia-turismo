{{--
<div class="form-group">
    <label for="brand_id">Companhia aérea:</label>
    {!! Form::select('brand_id', $brands , null, ['class'=> 'form-control'])!!}
</div> --}}

<div class="form-group">
    <label for="plane_id">Escolha o avião:</label>
    {!! Form::select('plane_id', $planes, null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="airport_origin">Origem:</label>
    {!! Form::select('airport_origin', $airports , null, ['class'=> 'form-control'])!!}
</div>
<div class="form-group">
    <label for="airport_destination">Destino:</label>
    {!! Form::select('airport_destination', $airports , null, ['class'=> 'form-control'])!!}
</div>

<div class="form-group">
    <label for="date">Data do voo:</label>
    {!! Form::date('date', \Carbon\Carbon::now(), ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="time_duration">Duração:</label>
    {!! Form::time('time_duration', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="hour_output">Hora saída:</label>
    {!! Form::time('hour_output', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="arrival_time">Hora chegada:</label>
    {!! Form::time('arrival_time', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="old_price">Preço anterior:</label>
    {!! Form::text('old_price', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="price">Preço:</label>
    {!! Form::text('price', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="total_plots">Total parcelas:</label>
    {!! Form::number('total_plots', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::checkbox('is_promotion', null, ['id'=> 'is_promotion']) !!}
    <label for="is_promotion">É promoção?</label>
</div>

<div class="form-group">
    <label for="image">Foto:</label>
    {!! Form::file('image',['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="qtd_stops">Quantidade de paradas:</label>
    {!! Form::number('qtd_stops', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="description">Descrição:</label>
    {!! Form::textarea('description', null, ['class'=> 'form-control']) !!}
</div>


<div class="form-group">
    <button class="btn btn-sm btn-primary">Salvar</button>
    <a href="{{route('planes.index')}}" class="btn btn-sm btn-link">Voltar</a>
</div>
