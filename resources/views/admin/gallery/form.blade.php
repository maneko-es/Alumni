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
                @include('admin.partials.form-inputs.base', [
                    'type' => 'select',
                    'name' => 'promotion_id',
                    'elems' => $promotions
                ])
                @include('admin.partials.form-inputs.base', [
                    'type' => 'textarea',
                    'name' => 'description',
                ])
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Imatges</div>
            <div class="panel-body">
                <label>Afegir imatges</label>
                <input type="file" multiple="true" name="pictures[]">

                @if(isset($entry) && $entry->pictures())
                    <br><table class="table table-bordered">
                        <tr>
                            <th>Imatge</th><th>Etiquetes</th><th></th>
                        </tr>
                    @foreach($entry->pictures()->get() as $picture)
                    <tr>
                        <td><img src="{{ url('galleries/thumbnails/'.$picture->img) }}"></td>
                        <td>
                            @if($picture->users())
                                @foreach($picture->users()->get() as $user)
                                {{ $user->name}}
                                @endforeach
                            @endif
                        </td>
                        <td><a href="{{ url('admin/picture/'.$picture->id.'/edit') }}">Editar</a></td>
                    </tr>
                    @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">Dades</div>
            <div class="panel-body">
                @if(isset($entry))
                <b>Promoció: </b>{{ $entry->promotion->title }}<br>
                <b>Escola: </b>{{ $entry->promotion->school->title }}<br>
                @endif
            </div>
        </div>
        @include('admin.partials.form-settings', [
            'locale_selector' => true,
            'published' => true,
        ])
    </div>
</div>