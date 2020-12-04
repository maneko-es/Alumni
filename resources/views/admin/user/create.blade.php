@extends('admin.partials.create-edit')

@section('create-edit-header')
    @include('admin.partials.crud-header', [
        'title' => [[
            'name' => trans('messages.' . $table_name),
            'url' => 'admin/' . str_slug($singular_table_name),
        ],[
            'name' => trans('messages.add'),
        ]]
    ])
@stop

@section('create-edit-form')
    {!! Form::open([
        'url' => '/admin/' . str_slug($singular_table_name),
        'method' => 'post',
        'id' => 'create-edit-form',
        'role' => 'form',
    ]) !!}
        @include('admin.' . $singular_table_name . '.form', [
            'password' => trans('messages.password')
        ])
@stop


