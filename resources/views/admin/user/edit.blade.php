@extends('admin.partials.create-edit')

@section('create-edit-header')
    @include('admin.partials.crud-header', [
        'title' => [[
            'name' => trans('messages.' . $table_name),
            'url' => 'admin/' . str_slug($singular_table_name),
        ],[
            'name' => trans('messages.edit'),
        ]],
        'buttons' => [
            'delete' => [
                'name' => trans('messages.delete'),
                'url' => 'admin/' . str_slug($singular_table_name) . '/soft-delete/' . $entry->id,
                'class' => 'btn-danger',
                'attribute' => 'data-delete data-delete-msg=' . rawUrlEncode(trans('messages.confirm_trash')),
                'icon' => 'fa-trash-o',
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
        @include('admin.' . $singular_table_name . '.form', [
            'password' => trans('messages.new_password') . ' ' .trans('messages.new_password_text')
        ])

        {{-- Slider user galleries --}}
        <style>
          .slick-arrow {
            background-color:#376994;
          }
          .slick-arrow:focus {
            background-color:#376994;
          }
          .slick-arrow:hover {
            background-color:#376994;
          }
        </style>
        <div style="font-size:22px;color:#376994;font-family:Lato, sans-serif;margin-top:20px;">Fotos i tags</div>
          @if ($uploaded_pictures->count() > 0)
            <label style="margin-top:20px;" class="control-label">Fotos afegides per l'usuari</label>
            <div class="galleries-container" style="margin-bottom:20px;">
            @foreach ($uploaded_pictures as $img)
              <div class="gallery-item">
                <img style="height:200px;width:300px;object-fit:cover;" src="{{ url('galleries/medium/' . $img->img) }}" alt="">
                <div>{{ $img->gallery->title }}</div>
                <div> {{$img->gallery->promotion->school->title}} - {{$img->gallery->promotion->title}} </div>
              </div>
            @endforeach
            </div>
          @else
            <div>L'usuari no ha afegit cap galeria.</div>
          @endif
        @if ($tags->count() > 0)
        <label style="margin-top:20px;" class="control-label">Fotos en què l'usuari ha estat etiquetat</label>
        <div class="galleries-container" style="margin-bottom:50px;">
          @foreach ($tags as $tag)
            <div class="gallery-item">
              <img style="height:150px;width:250px;object-fit:cover;" src="{{ url('galleries/medium/'. $tag->img) }}" alt="">
              <div>{{ $tag->gallery->title }}</div>
                <div> {{ $tag->gallery->promotion->school->title }} - {{ $tag->gallery->promotion->title }} </div>
            </div>
          @endforeach
        </div>
        @else
        <div style="margin-bottom:20px;">L'usuari no ha estat etiquetat en cap foto</div>
        @endif
@stop


@push('scripts')
    {!! $validator !!}
@endpush
