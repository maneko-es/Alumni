<div class="panel panel-default">
    <div class="panel-heading">{{ trans('messages.settings') }}</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4" >
                @if (isset($entry) && $locale_selector)
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'select-links',
                        'name' => $locale,
                        'label' => trans('messages.locale'),
                        'elems' => getMultilangRoutes(),
                    ])
                @endif
            </div>
            <div class="col-xs-4" >
                @if ($published)
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'switch',
                        'name' => 'published',
                        'old_input' => isset($entry) ? null : true,
                    ])
                @endif
            </div>
            <div class="col-xs-4" >
                @if (isset($preview))
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'switch',
                        'name' => 'preview',
                        'old_input' => isset($entry) ? null : false,
                    ])
                @endif
            </div>
        </div>
        @if(isset($order))
            @if(!isset($entry))
                <?php $c = App\Course::find($_GET['course_id']); $t = $c->modules()->count(); $o = $t + 1; ?>
            @else
                <?php $o = ''; ?>
            @endif

            @include('admin.partials.form-inputs.base', [
                'type' => 'text',
                'name' => 'order',
                'old_input' => isset($entry) ? null : $o,
            ])
        @endif
    </div>
</div>
