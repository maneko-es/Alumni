@if (isset($locale))
    {!! Form::hidden('locale', $locale) !!}
@endif

<?php $entry = isset($entry) ? $entry : null ?>

<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans("messages.content") }}</div>
            <div class="panel-body">
                 <div class="row" >
                    <div class="col-sm-6">
                        @include('admin.partials.form-inputs.base', [
                            'type' => 'text',
                            'name' => 'title',
                            'translatable' => true,
                            'attributes' => [
                                'data-slug' => 'data-origin'
                            ]
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('admin.partials.form-inputs.base', [
                            'type' => 'text',
                            'name' => 'slug',
                            'translatable' => true,
                            'attributes' => [
                                'data-slug' => 'data-destination'
                            ],
                            'tooltip_text' => trans('messages.tooltip_slug')
                        ])
                    </div>
                </div>
                @include('admin.partials.form-inputs.base', [
                    'type' => 'textarea',
                    'wysiwyg' => true,
                    'translatable' => true,
                    'name' => 'body',
                ])
                @include('admin.partials.form-inputs.base', [
                    'type' => 'select',
                    'name' => 'school_id',
                    'elems' => $schools
                ])
            </div>
        </div>
    </div>
    <div class="col-sm-4">


        @include('admin.partials.form-settings', [
            'locale_selector' => true,
            'published' => true,
        ])
    </div>
</div>
