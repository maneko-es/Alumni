@extends('admin.partials.index', [
    'modalDeleteIcon' => 'fa-trash'
])

@section('index-header')
    @include('admin.partials.crud-header', [
        'title' => [[
            'name' => trans('messages.' . $table_name),
            'url' => 'admin/' . str_slug($singular_table_name),
        ], [
            'name' => trans('messages.trash')
        ]],
        'buttons' => [
            'trash' => [
                'name' => trans('messages.back'),
                'url' => 'admin/' . str_slug($singular_table_name),
                'class' => 'btn-default',
                'icon' => 'fa-angle-left',
            ],
        ]
    ])
@stop
