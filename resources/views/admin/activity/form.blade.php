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
                    'type' => 'uploader',
                    'name' => 'medias',
                ])
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
                    'translatable' => true,
                    'name' => 'body',
                    'wysiwyg' => true
                ])
                <div id="meeting_toggle" >
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'switch',
                        'name' => 'is_meeting',
                    ])
                </div>
                @if(isset($entry) && $entry->is_meeting) <div id="meeting" class="row">
                @else <div id="meeting" class="row"  style="display: none;"> @endif
                    <div class="col-sm-6">
                        @include('admin.partials.form-inputs.base', [
                            'type' => 'text',
                            'name' => 'date',
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('admin.partials.form-inputs.base', [
                            'type' => 'text',
                            'name' => 'place',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">Característiques</div>
            <div class="panel-body">
                @include('admin.partials.form-inputs.base', [
                    'type' => 'select',
                    'name' => 'category_id',
                    'elems' => $categories
                ])
                @include('admin.partials.form-inputs.base', [
                    'type' => 'select',
                    'name' => 'school_id',
                    'elems' => $schools
                ])
            </div>
        </div>

        @include('admin.partials.form-settings', [
            'locale_selector' => true,
            'published' => true,
        ])
    </div>
</div>

@push('scripts')
<script type="text/javascript">
$('#meeting_toggle input').change(function(){
    $('#meeting').toggle();
})
</script>
@endpush