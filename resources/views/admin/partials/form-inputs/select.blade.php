<div class="form-group">
    <div class="input-group jsvalidation-input-group">
        {!! Form::label($name, $label, ['class' => 'control-label']) !!}

        <?php $multiple = isset($multiple) ? $multiple : false ?>

        @if (isset($tooltip_text))
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" data-html="true" title="{{ $tooltip_text }}" aria-hidden="true"></i>
        @endif

        {!! Form::select(
            $multiple ? $name . '[]' : $name,
            $elems,
            $old_input,
            array_merge([
                'class' => 'form-control',
                'id' => $name,
                'data-chosen',
                $multiple ? 'multiple' : ''
            ]), $attributes)
        !!}
    </div>
</div>
