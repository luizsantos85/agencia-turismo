
<div class="form-group">
    {!! Form::number('qtd_passengers', null, ['class'=> 'form-control', 'placeholder' => 'Total de passageiros..'])!!}
</div>
<div class="form-group">
    {!! Form::select('class', $classes_planes, null, ['class'=> 'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::select('brand_id', $brands, null, ['class'=> 'form-control'])!!}
</div>


<div class="form-group">
    <button class="btn btn-sm btn-primary">Salvar</button>
    <a href="{{route('planes.index')}}" class="btn btn-sm btn-link">Voltar</a>
</div>