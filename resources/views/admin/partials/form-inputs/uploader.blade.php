<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    {!! Form::label($name, $label, ['class' => 'control-label']) !!}
    <div>
        {!! Form::button(trans('messages.select_files'), array_merge([
            'class' => 'btn btn-default',
            'id' => $name,
            'data-toggle' => 'modal',
            'data-target' => '#modal-upload',
        ], $attributes)) !!}
        @if ($errors->has($name))
            <span class="help-block error-help-block">{{ $errors->first($name) }}</span>
        @endif
        <div class="row form-medias">
            @if (isset($entry->{$name}))
                @foreach($entry->{$name} as $entry)
                    @include('admin.partials.medias.form-media')
                @endforeach
            @endif
        </div>
    </div>
</div>
