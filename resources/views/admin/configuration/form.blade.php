@if (isset($locale))
    {!! Form::hidden('locale', $locale) !!}
@endif

<?php $entry = isset($entry) ? $entry : null ?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans("messages.content") }}</div>
            <div class="panel-body">

                @include('admin.partials.form-inputs.base', [
                    'type' => 'text',
                    'name' => 'borsa_url',
                    'label' => 'Url borsa de treball'
                ])

                @include('admin.partials.form-inputs.base', [
                    'type' => 'text',
                    'name' => 'main_mail',
                    'label' => 'Email general'
                ])


            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-save"></i>
                {{ trans('messages.save') }}
            </button>
        </div>
    </div>
{{--     <div class="col-sm-4">


        @include('admin.partials.form-settings', [
            'locale_selector' => true,
            'published' => true,
        ])
    </div> --}}
</div>
