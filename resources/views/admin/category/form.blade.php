@if (isset($locale))
    {!! Form::hidden('locale', $locale) !!}
@endif

<?php $entry = isset($entry) ? $entry : null ?>

<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans("messages.content") }}</div>
            <div class="panel-body">
                @include('admin.partials.form-inputs.base', [
                    'type' => 'text',
                    'name' => 'title',
                    'translatable' => true,
                    'attributes' => [
                        'data-slug' => 'data-origin'
                    ]
                ])
                @include('admin.partials.form-inputs.base', [
                    'type' => 'text',
                    'name' => 'slug',
                    'translatable' => true,
                    'attributes' => [
                        'data-slug' => 'data-destination'
                    ],
                    'tooltip_text' => trans('messages.tooltip_slug')
                ])
                @include('admin.partials.form-inputs.base', [
                    'type' => 'select',
                    'name' => 'category_id',
                    'elems' => $categories
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
