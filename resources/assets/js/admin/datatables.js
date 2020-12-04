/**
 * Datatables js file.
 *
 * @copyright Copyright Maneko
 * @author    Maneko
*/
jQuery(document).ready(function ($) {
    'use strict';

    var initOptions = {},
        orderOptions = {},
        $table = $('[data-sort-table]'),
        $btnOrder = $('.btn-order');

    /**
     * Initialize Sort DataTable.
     *
     * @return void
     */
    function initSortDataTable()
    {
        if ($table.length) {
            setDataTableSortOptions();
            setDataTableSortEvents();
        }
    }

    /**
     * Row reorder.
     *
     * @return void
     */
    function rowReorder(event, diff)
    {
        var order = {},
            url = window.location.href;

        for (var i = 0, ien = diff.length; i < ien; i++) {
            order[diff[i].node.id] = diff[i].newPosition + 1;
        }

        order = JSON.stringify(order);

        $.ajax({
            type: 'get',
            url: url + '/order?order=' + order,
        });
    }

    /**
     * On button order clicked.
     *
     * @return void
     */
    function onBtnOrderClicked(event)
    {
        event.preventDefault();

        $(this).toggleClass('active');
        $table.DataTable().destroy();

        if ($(this).hasClass('active')) {
            $table.DataTable(orderOptions);
            $table.find('thead').hide();
            $table.DataTable().column(getDataTableNumColumns()).visible(false);
        } else {
            $table.find('thead').show();
            $table.DataTable(initOptions);
        }
    }

    /**
     * Get DataTable number of columns.
     *
     * @return void
     */
    function getDataTableNumColumns()
    {
        return $table.find('thead th').length - 1;
    }

    /**
     * Set DataTable options.
     *
     * @return void
     */
    function setDataTableSortOptions()
    {
        initOptions = $table.DataTable().init();
        orderOptions = JSON.parse(JSON.stringify(initOptions));

        orderOptions.order = [[0, 'asc']];
        orderOptions.rowReorder = {
            'update': false,
            'dataSrc': 'sort',
            'snapX': true,
            'selector': 'tr',
        };
        orderOptions.pageLength = -1;
        orderOptions.buttons = [];
        orderOptions.filter = false;
        orderOptions.paging = false;
    }

    /**
     * Set events.
     *
     * @return void
     */
    function setDataTableSortEvents()
    {
        $table.DataTable().on('row-reorder', rowReorder);

        $btnOrder.on('click', onBtnOrderClicked);
    }

    /**
     * Initialize method.
     *
     * @return void
     */
    function init()
    {
        initSortDataTable();
    }

    // Initialize
    init();
});
