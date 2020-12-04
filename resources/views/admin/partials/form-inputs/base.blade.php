<?php 
    $old_input = isset($old_input) ? $old_input : null;

    $label = isset($label) ? $label : trans('messages.' . $name);

    $attributes = isset($attributes) ? $attributes : [];

    if (isset($translatable) && $translatable) {
        if (!isset($old_input)) {
            $old_input = getFormInput($entry, $name, $locale);
        }
        $name = "{$locale}[" . $name . "]";
    }
?>
@if ($type === 'text')
    @include('admin.partials.form-inputs.text')
@elseif ($type === 'date')
    @include('admin.partials.form-inputs.date')
@elseif ($type === 'password')
    @include('admin.partials.form-inputs.password')
@elseif ($type === 'select')
    @include('admin.partials.form-inputs.select')
@elseif ($type === 'select-links')
    @include('admin.partials.form-inputs.select-links')
@elseif ($type === 'textarea')
    @include('admin.partials.form-inputs.textarea')
@elseif ($type === 'switch')
    @include('admin.partials.form-inputs.switch')
@elseif ($type === 'file')
    @include('admin.partials.form-inputs.file')
@elseif ($type === 'uploader')
    @include('admin.partials.form-inputs.uploader')
@endif
