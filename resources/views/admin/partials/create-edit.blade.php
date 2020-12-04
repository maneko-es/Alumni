@extends('admin.layouts.default')

@section('content')
    <div class="container-fluid">

        @yield('create-edit-header')

        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.notifications')

                @yield('create-edit-form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-save"></i>
                            {{ trans('messages.save') }}
                        </button>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

    @include('admin.partials.modal-delete', [
        'icon' => isset($modalDeleteIcon) ? $modalDeleteIcon : ''
    ])

    @include('admin.partials.modal-upload')
@stop
