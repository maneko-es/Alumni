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
                'url' => 'admin/'. str_slug($singular_table_name) .'/trash',
                'class' => 'btn-default',
                'icon' => 'fa-trash-o',
            ],
            'order' => [
                'name' => trans('messages.sort'),
                'class' => 'btn-default btn-order',
                'icon' => 'fa-sort'
            ],
            'add' => [
                'name' => trans('messages.add'),
                'url' => 'admin/'. str_slug($singular_table_name) .'/create',
                'class' => 'btn-success',
                'icon' => 'fa-plus-circle',
            ]
        ]
    ])

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                @foreach(App\Category::where('category_id',null)->get() as $parent)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ url('admin/category/'.$parent->id.'/edit') }}"><b>{{ $parent->title }}</b></a>
                        </div>
                        <div class="panel-body">
                            @foreach($parent->categories()->get() as $child)
                            <a href="{{ url('admin/category/'.$child->id.'/edit') }}">{{ $child->title }}</a><br>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
