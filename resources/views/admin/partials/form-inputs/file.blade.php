<div class="form-group">
    {!! Form::label($name, $label, ['class' => 'control-label']) !!}
    {!! Form::file($name, null, ['class' => 'form-control', 'id' => $name]) !!}
</div>