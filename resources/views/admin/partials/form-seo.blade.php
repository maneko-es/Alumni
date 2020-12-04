<div class="panel panel-default">
    <div class="panel-heading">{{ trans("messages.seo") }}</div>
    <div class="panel-body">
        @include('admin.partials.form-inputs.base', [
            'type' => 'text',
            'name' => 'seo_title',
            'translatable' => true,
            'tooltip_text' => trans('messages.tooltip_seo_title')
        ])
        @include('admin.partials.form-inputs.base', [
            'type' => 'textarea',
            'name' => 'seo_description',
            'translatable' => true,
            'tooltip_text' => trans('messages.tooltip_seo_description'),
            'attributes' => [
                'rows' => '3',
            ]
        ])
        @include('admin.partials.form-inputs.base', [
            'type' => 'select',
            'name' => 'robots_id',
            'translatable' => true,
            'label' => trans('messages.robots'),
            'elems' => $robots,
            'tooltip_text' => trans('messages.tooltip_robots')
        ])
    </div>
</div>