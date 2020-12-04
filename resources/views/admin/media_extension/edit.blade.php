@extends('admin.partials.create-edit', [
    'modalDeleteIcon' => 'fa-trash'
])

@section('create-edit-header')
    @include('admin.partials.crud-header', [
        'title' => [[
            'name' => trans('messages.' . $table_name),
            'url' => 'admin/' . str_slug($singular_table_name),
        ],[
            'name' => trans('messages.add'),
        ]],
        'buttons' => [
            'delete' => [
                'name' => trans('messages.delete'),
                'url' => 'admin/' . str_slug($singular_table_name) . '/' . $entry->id,
                'class' => 'btn-danger',
                'attribute' => 'data-delete data-delete-msg=' . rawUrlEncode(trans('messages.confirm')),
                'icon' => 'fa-trash',
            ],
            'add' => [
                'name' => trans('messages.add'),
                'url' => 'admin/' . str_slug($singular_table_name) . '/create',
                'class' => 'btn-success',
                'icon' => 'fa-plus-circle',
            ],
        ]
    ])
@stop

@section('create-edit-form')
    {!! Form::model($entry, [
        'url' => url('/admin/' . str_slug($singular_table_name) . '/' . $entry->id),
        'method' => 'put',
        'id' => 'create-edit-form',
        'role' => 'form',
    ]) !!}
        {!! Form::hidden('id', $value = $entry->id) !!}
        @include('admin.' . $singular_table_name . '.form')
@stop

@push('scripts')
    {!! $validator !!}
@endpush
