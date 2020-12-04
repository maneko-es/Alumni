<div class="col-xs-12">
    <div class="media-container">
        {!! getThumbnail(
            config('maravel.media_originals_folder'). '/' . $entry->filename,
            $entry->mime_type
        ) !!}
        <button class="btn btn-default btn-md">
            <i class="fa fa-btn fa-trash"></i>{{ trans('messages.delete') }}
        </button>
    </div>
    <input type="hidden" name="{{ $name }}[]" value="{{ $entry->id }}">
</div>