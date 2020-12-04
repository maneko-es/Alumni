<div class="form-group">
    <div class="switch">
        {!! Form::label($name, $label, ['class' => 'show']) !!}
        {!! Form::checkbox($name, 1, $old_input, ['id' => $name]) !!}
        <label for="{{$name}}"></label>
    </div>
</div>
