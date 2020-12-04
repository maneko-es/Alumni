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
            </div>
        </div>

        @if(isset($entry) && $entry->blocks)
        <div class="panel panel-default">
            <div class="panel-heading">Bloques</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered dataTable no-footer dtr-inline" id="dataTableBuilder" data-sort-table="" role="grid" aria-describedby="dataTableBuilder_info">
                    <tbody>
                        <?php App::setLocale($locale); ?>
                        @foreach($entry->blocks as $block)
                            @if($block->id != 283)
                            <tr role="row" class="odd">
                                <td tabindex="0">
                                    <a href="{{ url('admin/block/'.$block->id.'/edit?locale='.$locale) }}">{{ $block->title }}</a>
                                </td>
                                <td style="text-transform: uppercase;">
                                    <?php echo getMultilanguageEditButtons('block',$block->id,$block); ?>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                   </tbody>
                </table>
            </div>
        </div>
            @foreach($entry->blocks as $block)
                @if($block->id == 283)
                 <div class="panel panel-default">
                    <div class="panel-heading">Banner</div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered dataTable no-footer dtr-inline" id="dataTableBuilder" data-sort-table="" role="grid" aria-describedby="dataTableBuilder_info">
                            <tbody>
                            <tr role="row" class="odd">
                                <td tabindex="0">
                                    <a href="{{ url('admin/block/'.$block->id.'/edit?locale='.$locale) }}">{{ $block->title }}</a>
                                </td>
                                <td style="text-transform: uppercase;">
                                    <?php echo getMultilanguageEditButtons('block',$block->id,$block); ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>
    <div class="col-sm-4">
        @include('admin.partials.form-settings', [
            'locale_selector' => true,
            'published' => true,
        ])
    </div>
</div>