@extends('admin.layouts.default')

@section('content')
    <div class="container-fluid index">

        @yield('index-header')

        @include('admin.partials.notifications')

        <div class="row">
            <div class="table-responsive">
                <div class="col-sm-12">
                    {!! $dataTable->table([
                        'class' => 'table table-striped table-bordered',
                        'data-sort-table',
                    ]) !!}
                </div>
            </div>
        </div>

    </div>

    @include('admin.partials.modal-delete', [
        'icon' => isset($modalDeleteIcon) ? $modalDeleteIcon : ''
    ])
@stop

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
