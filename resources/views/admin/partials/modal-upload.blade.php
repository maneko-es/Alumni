<div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="modal-uploadLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-uploadLabel">{{ trans('messages.medias') }}</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation">
                        <a href="#tab-upload" aria-controls="tab-upload" role="tab" data-toggle="tab">
                            {{ trans('messages.upload_files') }}
                        </a>
                    </li>
                    <li role="presentation" class="active">
                        <a href="#tab-library" aria-controls="tab-library" role="tab" data-toggle="tab">
                            {{ trans('messages.library') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="tab-upload">
                        <form action="{{ url('admin/' . str_slug($singular_table_name) . '/upload') }}" data-uploader>
                            {{ csrf_field() }}
                            <div class="content">
                                <div>
                                    <i class="fa fa-5x fa-cloud-upload" aria-hidden="true"></i>
                                    <p>{{ trans('messages.drag_drop') }}</p>
                                    <p>o</p>
                                    <div class="dz-message">{{ trans('messages.select_files') }}</div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="error-message"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane active" id="tab-library">
                        <div class="row medias">
                            <div class="col-xs-12">{{ trans('messages.loading') }}...</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary add" disabled="disabled">{{ trans('messages.add') }}</button>
            </div>
        </div>
    </div>
</div>
