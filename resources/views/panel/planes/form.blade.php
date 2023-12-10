
<div class="form-group">
    <label for="qtd_passengers">Quantidade de passageiros:</label>
    {!! Form::number('qtd_passengers', null, ['class'=> 'form-control'])!!}
</div>
<div class="form-group">
    <label for="class">Classe:</label>
    {!! Form::select('class', $classes_planes, null, ['class'=> 'form-control'])!!}
</div>
<div class="form-group">
    <label for="brand_id">Companhia aérea:</label>
    {!! Form::select('brand_id', $brands, null, ['class'=> 'form-control'])!!}
</div>


<div class="form-group">
    <button class="btn btn-sm btn-primary">Salvar</button>
    <a href="{{route('planes.index')}}" class="btn btn-sm btn-link">Voltar</a>
</div>