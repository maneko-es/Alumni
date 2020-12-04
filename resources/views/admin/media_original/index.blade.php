@extends('admin.partials.index', [
    'modalDeleteIcon' => 'fa-trash-o'
])

@section('index-header')
    @include('admin.partials.crud-header', [
        'title' => [[
            'name' => trans('messages.' . $table_name),
            'url' => 'admin/' . str_slug($singular_table_name),
        ]],
        'buttons' => [
            'trash' => [
                'name' => trans('messages.go_to_trash'),
                'url' => 'admin/' . str_slug($singular_table_name) . '/trash',
                'class' => 'btn-default',
                'icon' => 'fa-trash-o',
            ],
            'add' => [
                'name' => trans('messages.add'),
                'url' => 'admin/' . str_slug($singular_table_name) . '/create',
                'class' => 'btn-success',
                'icon' => 'fa-plus-circle',
            ]
        ]
    ])
@stop
