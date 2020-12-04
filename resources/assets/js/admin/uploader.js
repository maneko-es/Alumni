/**
 * Uploader js file.
 *
 * @copyright Copyright Maneko
 * @author    Maneko
*/
jQuery(document).ready(function ($) {
    'use strict';

    var baseUrl = window.Laravel.baseUrl,
        mediaOriginals = [],
        mediaExtensions = '',
        $trigger,
        $modal = $('#modal-upload'),
        $uploader = $modal.find('[data-uploader]'),
        $progressBar = $modal.find('.progress-bar'),
        $errorMessage = $modal.find('.error-message'),
        $medias = $modal.find('.medias'),
        $addBtn = $modal.find('.add.btn'),
        $formMedias = $('.form-medias');

    /**
     * On file added.
     *
     * @return void
     */
    function onAddedfile()
    {
        $errorMessage.html('');

        $progressBar.parent().show();
        $progressBar.css('width', '0%');
    }

    /**
     * Method to show the progress bar.
     *
     * @param  integer progress
     * @return void
     */
    function onTotaluploadprogress(progress)
    {
        $progressBar.css('width', progress + '%');

        if (progress == 100) {
            setTimeout(function () {
                onUploadCompleted();
            }, 600);
        }
    }

    /**
     * On upload completed.
     *
     * @return void
     */
    function onUploadCompleted()
    {
        hideProgressBar();

        $modal.find('a[href="#tab-library"]').tab('show');
    }

    /**
     * Hide progress bar.
     *
     * @return void
     */
    function hideProgressBar()
    {
        $progressBar.parent().hide();
    }

    /**
     * On upload file success.
     *
     * @param  object file
     * @param  object html
     * @return void
     */
    function onSuccess(file, media)
    {
        removeMediasNotExistsMessage();

        renderMediaOriginal(media);
    }

    /**
     * Remove medias not exists message.
     *
     * @return void
     */
    function removeMediasNotExistsMessage()
    {
        var $message = $medias.find('.col-xs-12');

        if ($message.length > 0) {
            $message.hide();
        }
    }

    /**
     * Set medias not exists message.
     *
     * @return void
     */
    function setMediasNotExistsMessage()
    {
        $medias.find('.col-xs-12').html('No existen ficheros para añadir. Por favor, sube un fichero');
    }

    /**
     * Remove media selected class.
     *
     * @return void
     */
    function removeMediaClass()
    {
        $medias.find('.media').removeClass('selected');
    }

    /**
     * On media clicked.
     *
     * @return void
     */
    function onMediaClicked()
    {
        removeMediaClass();

        $(this).addClass('selected');

        $addBtn.prop('disabled', false);
    }

    /**
     * Render selected medias on modal.
     *
     * @return void
     */
    function renderMedias()
    {
        var name = $trigger.attr('id'),
            $formMediasContainer = $trigger.siblings('.form-medias'),
            $selectedMedias = $medias.find('.media.selected');

        $selectedMedias.each(function(index, element) {
            $.get(baseUrl + '/admin/upload/media-html', {
                'id': $(element).data('id'),
                'name': name,
            }, function(html) {
                if ($trigger.data('multiple')) {
                    $formMediasContainer.append(html);
                } else {
                    $formMediasContainer.html(html);
                }
            });
        });
    }

    /**
     * On add button clicked.
     *
     * @return void
     */
    function onAddBtnClicked()
    {
        $modal.modal('hide');

        renderMedias();
    }

    /**
     * Sort media originals by created_at desc.
     *
     * @return void
     */
    function sortMediaOriginals(data)
    {
        var indexArray = [];

        for (var i in data) {
            indexArray.push(i);
        }

        indexArray.sort(function(a,b) {
            return(new Date(data[a].created_at) - new Date(data[b].created_at));
        });

        mediaOriginals = [];
        for (var i = 0, length = indexArray.length; i < length; i++) {
            mediaOriginals.push(data[indexArray[i]]);
        }
    }

    /**
     * Render media originals.
     *
     * @return void
     */
    function renderMediaOriginals()
    {
        if (mediaOriginals.length > 0) {
            removeMediasNotExistsMessage();
        } else {
            setMediasNotExistsMessage();
        }

        for (var i = 0, length = mediaOriginals.length; i < length; i++) {
            renderMediaOriginal(mediaOriginals[i]);
        }
    }

    /**
     * Render media original.
     *
     * @return void
     */
    function renderMediaOriginal(media)
    {
        $medias.prepend('<div class="col-xs-6 col-sm-3 col-md-2 media" data-id="' + media.id +'">' + media.html + '</div>');
    }

    /**
     * On show modal.
     *
     * @return void
     */
    function onShowModal(event)
    {
        removeMediaClass();

        $addBtn.prop('disabled', true);

        $trigger = $(event.relatedTarget);
    }

    /**
     * On deleted media button clicked.
     *
     * @return void
     */
    function onDeleteBtnClicked(event)
    {
        event.preventDefault();

        $(this).closest('div[class*=col]').remove();
    }

    /**
     * Set events.
     *
     * @return void
     */
    function setEvents()
    {
        $medias.on('click', '.media', onMediaClicked);

        $addBtn.not('disabled').click(onAddBtnClicked);

        $modal.on('show.bs.modal', onShowModal);

        $formMedias.on('click', 'button', onDeleteBtnClicked);
    }

    /**
     * Get media originals.
     *
     * @return void
     */
    function getMediaOriginals()
    {
        $.get(baseUrl + '/admin/upload/media-originals', function(data) {
            sortMediaOriginals(data);
            renderMediaOriginals();
        });
    }

    /**
     * Get media extensions.
     *
     * @return void
     */
    function getMediaExtensions()
    {
        $.get(baseUrl + '/admin/upload/media-extensions', function(extensions) {
            mediaExtensions = extensions;
            initDropzone();
        });
    }

    /**
     * Show error message.
     *
     * @return void
     */
    function showErrorMessage(file, message)
    {
        hideProgressBar();

        $errorMessage.html(message);
    }

    /**
     * Initialize Dropzone.
     *
     * @return void
     */
    function initDropzone()
    {
        var uploader = $uploader.dropzone({
            addedfile: onAddedfile,
            totaluploadprogress: onTotaluploadprogress,
            success: onSuccess,
            acceptedFiles: mediaExtensions,
            error: showErrorMessage,
        });
    }

    /**
     * Initialize method.
     *
     * @return void
     */
    function init()
    {
        getMediaExtensions();
        getMediaOriginals();

        setEvents();
    }

    // Initialize
    if ($uploader.length > 0) {
        init();
    }
});
