var n_detalles = 0;
function adiciona() {

    n_detalles++;
    var elemento_aux = null;
    $('#detalles-div  input,#detalles-div  select').each(function (e, elemento) {

        $(elemento).attr('name', 'data[Cuentasegresos][' + n_detalles + '][' + $(elemento).attr('nombre') + ']');
        //alert($(elemento).attr('nombre'));
        if ($(elemento).attr('nombre') == 'nomenclatura_id') {
            elemento_aux = elemento;
            $(elemento).attr('class', 'classnomen-' + n_detalles);
            $(elemento).attr('id', 'idnomen-' + n_detalles);
        }
    });
    $('#detalles-' + (n_detalles - 1)).after('<div class="form-group has-warning" id="detalles-' + n_detalles + '"> ' + $('#detalles-div').html() + ' </div>');

    $(elemento_aux).attr('class', '');
    $(elemento_aux).attr('id', '');
    $('#idnomen-' + n_detalles).select2();
}
function quita() {
    if (n_detalles != 1) {
        $('#detalles-' + n_detalles).remove();
        n_detalles--;
    }

}
adiciona();