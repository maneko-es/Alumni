/**
 * Main admin js file.
 *
 * @copyright Copyright Maneko
 * @author    Maneko
*/
jQuery(document).ready(function ($) {
    'use strict';

    var $body = $('body'),
        $chosen = $('[data-chosen]'),
        $modalDelete = $('#modal-delete'),
        $origin = $('[data-slug=data-origin]'),
        $destination = $('[data-slug=data-destination]'),
        $tooltip = $('[data-toggle="tooltip"]');

    /**
     * Initialize Chosen.
     *
     * @return void
     */
    function initChosen()
    {
        $chosen.chosen({
            'placeholder_text_multiple': ' ',
            'no_results_text': ' ',
            'width': '100%',
        });
    }

    /**
    * Initialize Slugify.
    *
    * @return void
    */
    function initSlugify()
    {
        $destination.slugify($origin);
    }

    /**
     * Initialize tooltips
     *
     * @return void
     */
    function initTooltips()
    {
        $tooltip.tooltip();
    }

    /**
     * Show modal on button clicked.
     *
     * @param  jQuery.Event event
     * @return void
     */
    function showDeleteModal(event)
    {
        var url = $(this).data('url'),
            msg = '';

        event.preventDefault();

        $modalDelete.find('form').attr('action', url);

        if ($(this).is('[data-delete-msg]')) {
            msg = decodeURIComponent($(this).data('delete-msg'));
            $modalDelete.find('.modal-message').html(msg);
        }

        $modalDelete.modal('show');
    }

    /**
     * Sync CKEDITOR textarea
     *
     * @param  CKEDITOR event
     * @return void
     */
    function onInstanceReady(event)
    {
        var editor = event.editor;

        editor.on('change', function (event) {
            this.updateElement();
        });
    }

    /**
     * Set events.
     *
     * @return void
     */
    function setEvents()
    {
        $body.on('click', '[data-delete]', showDeleteModal);

        CKEDITOR.on('instanceReady', onInstanceReady);
    }

    /**
     * Initialize method.
     *
     * @return void
     */
    function init()
    {
        initChosen();
        initSlugify();
        initTooltips();

        setEvents();
    }

    // Initialize
    init();
});
