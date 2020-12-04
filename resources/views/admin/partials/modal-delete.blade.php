<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label={{ trans('messages.close') }}><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <i class="fa fa-btn fa-question-circle fa-lg"></i>
                <span class="modal-message">
                </span>
            </div>
            <div class="modal-footer">
                <form method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-btn {{ $icon }}"></i>{{ trans('messages.yes') }}
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('messages.no') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
