<div class="form-group">
    <label for="name">Nome:</label>
    {!! Form::text('name', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="latitude">Latitude:</label>
    {!! Form::text('latitude', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="longitude">Longitude:</label>
    {!! Form::text('longitude', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="address">Endereço:</label>
    {!! Form::text('address', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="number">Número:</label>
    {!! Form::number('number', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="zip_code">Código postal:</label>
    {!! Form::text('zip_code', null, ['class'=> 'form-control']) !!}
</div>

<div class="form-group">
    <label for="complement">Complemento:</label>
    {!! Form::text('complement', null, ['class'=> 'form-control']) !!}
</div>

<input type="hidden" name="city_id" value="{{$city->id}}">

<div class="form-group">
    <button class="btn btn-sm btn-primary">Salvar</button>
    <a href="{{route('airports.index',$city->id)}}" class="btn btn-sm btn-link">Voltar</a>
</div>
