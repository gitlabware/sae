<style>
    div.card-pisos .ocu-d {
        display: none;
    }

    div.card-pisos .ver-d {
        display: block;
    }

    .oculto {
        display: none;
    }

    .card-block {
        padding: 0px !important;
    }
</style>
<style>
    .placeholder {
        border: 1px solid green;
        background-color: white;
        -webkit-box-shadow: 0px 0px 10px #888;
        -moz-box-shadow: 0px 0px 10px #888;
        box-shadow: 0px 0px 10px #888;
    }
    .tile {
        //height: 100px;
    }
    .grid {
        margin-top: 1em;
    }
</style>
<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">
            Ambientes por piso
        </h3>
    </div>
    <div class="col-md-6 col-4 align-self-center">
        <button class="btn pull-right btn-success" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'piso')); ?>')">
            <i class="mdi mdi-plus-circle">
            </i>
            Adicionar piso
        </button>
    </div>
</div>
<div class="row">
    <div class="col-12 d-pisos " id="c-pisos">
        <?php foreach ($pisos as $pi): ?>
        <div class="card card-outline-inverse card-pisos" data-id="<?php echo $pi['Piso']['id']; ?>">
            <div class="card-header">
                <div aria-label="Toolbar with button groups" class="btn-toolbar justify-content-between" role="toolbar">
                    <div class="input-group">
                        <h4 class="m-b-0 text-white ti-piso" dato-texto="<?= $pi['Piso']['nombre']?>">
                            <?= $pi['Piso']['nombre']?>
                        </h4>
                    </div>
                    <div aria-label="First group" class="btn-group" role="group">
                        <button class="btn btn-secondary add-ambiente" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente', $pi['Piso']['id'])); ?>',true);" title="Adicionar ambiente en este piso" type="button">
                            <i class="fa fa-plus">
                            </i>
                        </button>
                        <button class="btn btn-secondary guard-piso oculto" title="Guardar" type="button">
                            <i class="mdi mdi-content-save">
                            </i>
                        </button>
                        <button class="btn btn-secondary edit-piso" title="Editar" type="button">
                            <i class="mdi mdi-lead-pencil">
                            </i>
                        </button>
                        <button class="btn btn-secondary btn-circle elim-piso" title="Eliminar Piso" type="button">
                            <i class="mdi mdi-delete">
                            </i>
                        </button>
                        <button class="btn btn-secondary btn-circle b-ver-oc" title="Ver/Ocultar Ambientes" type="button">
                            <i class="fa fa-reorder">
                            </i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-block ocu-d" id="<?php echo 'idcont-' . $pi['Piso']['id'] ?>">
                <div class="table-responsive">
                    <table class="table table-bordered" style="font-size: 15px; font-weight: bold;">
                        <thead>
                            <tr>
                                <th>
                                    Inquilino
                                </th>
                                <th>
                                    Propietario
                                </th>
                                <th>
                                    Ambiente
                                </th>
                                <th>
                                    Accion
                                </th>
                            </tr>
                        </thead>
                        <?php $ambientes = $this->
                        requestAction(array('action' => 'get_ambientes', $edificio['Edificio']['id'], $pi['Piso']['id']))?>
                        <?php foreach ($ambientes as $am): ?>
                        <tr>
                            <td class="success">
                                <?php echo $am['Inquilino']['nombre'] ?>
                            </td>
                            <td class="success">
                                <?php echo $am['User']['nombre'] ?>
                            </td>
                            <td class="info">
                                <?php echo $am['Ambiente']['nombre'] ?>
                            </td>
                            <td class="warning">
                                <a class="btn btn-secondary" href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente', $pi['Piso']['id'], $am['Ambiente']['id'])); ?>',true);">
                                    <i class="fa fa-pencil">
                                    </i>
                                </a>
                                <?php echo $this->Html->link('
                                <i class="fa fa-remove">
                                </i>
                                ', array('action' => 'eliminar', $am['Ambiente']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'confirm' => 'Esta seguro de quitar el ambiente', 'title' => 'Quitar ambiente')) ?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php $this->start('campo_js'); ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
</script>
<script>
    function guarda_edificio(id_piso) {
                var postData = $('#form-ambiente-' + id_piso).serializeArray();
                var formURL = $('#form-ambiente-' + id_piso).attr("action");
                $.ajax(
                        {
                            url: formURL,
                            type: "POST",
                            data: postData,
                            beforeSend: function (XMLHttpRequest) {
                                $('#edita-edificio-' + id_piso).toggle();
                                $('#idloadnombre-<?php echo $pi['Piso']['id']; ?>').toggle();
                            },
                            success: function (data, textStatus, jqXHR)
                            {
                                if ($.parseJSON(data).msgerror == '') {
                                    $('#idnombre-span-amb-' + id_piso).html($.parseJSON(data).nombre_amb);
                                    var growlType = 'success';
                                    $.bootstrapGrowl('<h4>Excelente!</h4> <p>Se registro correctamente!!</p>', {
                                        type: growlType,
                                        delay: 2500,
                                        allow_dismiss: true
                                    });
                                    $(this).prop('disabled', true);
                                } else {
                                    var growlType = 'danger';
                                    $.bootstrapGrowl('<h4>Error!</h4> <p>' + $.parseJSON(data).msgerror + '</p>', {
                                        type: growlType,
                                        delay: 2500,
                                        allow_dismiss: true
                                    });
                                    $(this).prop('disabled', true);
                                }
                                $('#idloadnombre-<?php echo $pi['Piso']['id']; ?>').toggle();
                                $('#div-nombre-edi-' + id_piso).toggle(200);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                //if fails
                                alert("error");
                            }
                        });
            }

            
            $(function () {
                    $(".d-pisos").sortable({
                        tolerance: 'pointer',
                        revert: 'invalid',
                        cursor: "move",
                        forceHelperSize: true,
                        update: function (event, ui) {
                            revisa_tabla();
                        }
                    });
                });

            function revisa_tabla() {
                var postData = "";
                var cont = 0;
                $('.d-pisos div.card-pisos').each(function (ey, eva) {
                    cont++;
                    postData += " pisos[" + $(eva).attr('data-id') + ']=' + cont + '&';
                    //console.log($(eva).attr('data-id'));
                });
                var formURL = '<?php echo $this->Html->url(array('action' => 'reg_ord_pisos')); ?>';
                $.ajax(
                        {
                            url: formURL,
                            type: "POST",
                            data: postData,
                            /*beforeSend:function (XMLHttpRequest) {
                             alert("antes de enviar");
                             },
                             complete:function (XMLHttpRequest, textStatus) {
                             alert('despues de enviar');
                             },*/
                            success: function (data, textStatus, jqXHR)
                            {
                                //data: return data from server
                                //$("#parte").html(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                //if fails
                                alert("error");
                            }
                        });
            }
</script>
<script>
    if (localStorage['piso'] !== "undefined" && localStorage['piso'] !== undefined)
    {
        // console.log(localStorage['piso']);
        $('#idcont-' + localStorage['piso']).toggle(400);
        $('html,body').animate({
            scrollTop: $('#idcont-' + localStorage['piso']).offset().top
        },'slow');
    }
    $(document).on('click','.b-ver-oc',function () {
        e_elem = $(this).parents('div.card-pisos');
        e_elem.children('div.card-block').toggle(200);
        if(e_elem.attr('data-id') != localStorage['piso']){
            localStorage['piso'] = e_elem.attr('data-id');
        }else{
            localStorage['piso'] = undefined;
        }
    });

    $('#c-pisos').on('click','.edit-piso',function () {
        editarpiso($(this).parents('div.card-pisos').find('h4.ti-piso'));
    });
    $('#c-pisos').on('click','.guard-piso',function () {
        guardapiso($(this).parents('div.card-pisos'));
    });
    function editarpiso(elemento) {

        $(elemento).parents('div.card-pisos').find('button.edit-piso').hide(200);
        $(elemento).parents('div.card-pisos').find('button.guard-piso').show(200);
        contenidoti = '<input type="text" class="form-control fnom-piso" placeholder="Nombre del Piso" value="' + $(elemento).attr('dato-texto') + '">';

        $(elemento).html("");
        $(elemento).parent(".input-group").append(contenidoti);
        $(elemento).parents('div.card-pisos').find('input').focus().select();
    }
    function guardapiso(elemento) {
        var postData = $(elemento).find('form').serializeArray();

        $.ajax({
            url: '<?= $this->Html->url(['controller' => 'Ambientes', 'action' => 'registra_nombre']); ?>',
            type: "POST",
            data: {
                id: $(elemento).attr('data-id'),
                nombre: $(elemento).find('input.fnom-piso').val()
            },
            success: function (data) {
                if ($.parseJSON(data).estado) {
                    alertabn($.parseJSON(data).respuesta);
                    $(elemento).find('button.edit-piso').show(200);
                    $(elemento).find('button.guard-piso').hide(200);
                    contenidoti = '<h4 class="m-b-0 text-white ti-piso">' + $(elemento).find('input.fnom-piso').val() + '</h4>';
                    $(elemento).find(".input-group").html(contenidoti);
                } else {
                    alertaer($.parseJSON(data).respuesta);
                }
            },
            error: function () {
                alert("Error");
            }
        });
    }
    $('#c-pisos').on('click','.elim-piso',function () {
        e_elemento = $(this).parents('div.card-pisos');
        idPiso = e_elemento.attr('data-id');
        nombre_p = e_elemento.find('.ti-piso').html();
        texto = 'Se eliminara el piso: ' + nombre_p + '?';
        swal({
            title: "Esta seguro?",
            text: texto,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                window.location.href = '<?php echo $this->Html->url(['controller' => 'Edificios', 'action' => 'elimina_piso']);  ?>/' + idPiso
            } else {
                swal("Cancelado", "(DE " + texto + ')', "error");
            }
        });
    });
</script>
<?php $this->end(); ?>
