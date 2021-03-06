<div class="form-group">
    {!! Form::label($name, $label, ['class' => 'control-label']) !!}

    @if (isset($tooltip_text))
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" data-html="true" title="{{ $tooltip_text }}" aria-hidden="true"></i>
    @endif

    {!! Form::date(
        $name,
        $old_input,
        array_merge(['class' => 'form-control', 'id' => $name], $attributes))
    !!}
</div>
