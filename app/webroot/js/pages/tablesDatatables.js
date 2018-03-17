/*
 *  Document   : tablesDatatables.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Tables Datatables page
 */


var TablesDatatables = function () {

    return {
        init: function () {
            /* Initialize Bootstrap Datatables Integration */
            App.datatables();
            
            /* Initialize Datatables */
            $('#example-datatable').dataTable({
                "aoColumnDefs": [{"bSortable": false
                                //, "aTargets": [ 1, 5 ] 
                    }],
                "iDisplayLength": 10,
                        "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "Todo"]],
                "order": []

            }).columnFilter({
                sPlaceHolder: "head:before",
                aoColumns: filtro_c
            });
            
            /*$('#agruacion').dataTable({ 
                "bLengthChange": false, 
                "bPaginate": false
            }).rowGrouping({bExpandableGrouping: true});*/

            $('#tabla-json').dataTable({
                "iDisplayLength": 10,
                'bProcessing': true,
                'sAjaxSource': urljsontablatrab,
                //'sServerMethod': 'POST',
                "bServerSide": true,
                "order": []

                        //"aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            }).columnFilter({
                sPlaceHolder: "head:before",
                aoColumns: filtro_c
            });

            /* Add placeholder attribute to the search input */
            $('.dataTables_filter input').attr('placeholder', 'Buscar');
        }
    };
}();