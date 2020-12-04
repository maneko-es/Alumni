@if (isset($locale))
    {!! Form::hidden('locale', $locale) !!}
@endif

<?php $entry = isset($entry) ? $entry : null ?>

<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans("messages.content") }}</div>
            <div class="panel-body">
                <img src="{{ url('galleries/medium/'.$entry->img) }}"><br><br>

                @include('admin.partials.form-inputs.base', [
                    'type' => 'text',
                    'name' => 'description',
                ])

                @include('admin.partials.form-inputs.base', [
                    'type' => 'select',
                    'name' => 'users_list',
                    'multiple' => true,
                    'elems' => $users
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
