<!-- END Blank Header -->
<!-- Example Block -->
<div class="card">
    <!-- Example Title -->
    <div class="card-header">
        <div class="pull-right">
            <a href="javascript:"  onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'nomenclatura', 0)); ?>');" class="btn btn-alt btn-sm btn-success" title="Adicionar Nueva nomenclatura"><i class="fa fa-plus"></i></a>
            <?php //echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'index'), array('class' => 'btn btn-alt btn-sm btn-primary', 'escape' => FALSE,'title' => 'editar')); ?>
            <?php //echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'ver'), array('class' => 'btn btn-alt btn-sm btn-primary', 'escape' => FALSE,'title' => 'ver')); ?>
        </div>
        <span><b>Nomenclatura de cuentas</b></span>
    </div>    
    <!-- Example Content -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="example-datatable-2" class="table table-bordered table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Subconcepto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nomenclaturas as $no): ?>
                        <tr>
                            <td><?php echo $no['Nomenclatura']['codigo_completo']; ?></td>
                            <td><?php echo $no['Nomenclatura']['nombre']; ?></td>
                            <td><?php echo $no['Subconcepto']['nombre']; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="javascript:void(0)"  onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'nomenclatura', $no['Nomenclatura']['id'])); ?>');" title="Adicionar" class="btn btn-success"><i class="fa fa-plus"></i></a>

                                    <a href="javascript:" class="btn btn-primary" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambientes', $no['Nomenclatura']['id'])); ?>');" title="Ambientes"><i class="fa fa-list"></i></a>
                                    <a href="javascript:void(0)"  onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'nomenclatura', $no['Nomenclatura']['nomenclatura_id'], $no['Nomenclatura']['id'])); ?>');" title="Editar" class="btn btn-secondary"><i class="fa fa-pencil"></i></a>
                                    <?php echo $this->Html->link('<i class="fa fa-trash-o"></i>', array('action' => 'eliminar', $no['Nomenclatura']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'confirm' => 'Esta seguro de eliminar la nomenclatura??')); ?>
                                </div>
                            </td>
                        </tr>

                        <?php if (!empty($no['Ambiente'])): ?>
                            <?php foreach ($no['Ambiente'] as $am): ?>
                                <tr style="background-color: #feffde;">
                                    <td><?php echo $no['Nomenclatura']['codigo_completo'] . '.' . $am['NomenclaturasAmbiente']['codigo']; ?></td>
                                    <td>
                                        <?php
                                        if (!empty($am['Representante']['nombre'])) {
                                            echo $am['Representante']['nombre'];
                                        }
                                        echo ' (' . $am['Piso']['nombre'] . ' - ' . $am['nombre'] . ')';
                                        ?></td>
                                        <td><?php //echo $no['Subconcepto']['nombre'];         ?></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-xs">
                                                <?php echo $this->Html->link('<i class="fa fa-trash-o"></i>', array('action' => 'quita_ambiente2', $am['NomenclaturasAmbiente']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'confirm' => 'Esta seguro de eliminar el ambiente de la nomenclatura??')); ?>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
        <!-- END Example Content -->
    </div>
    <!-- END Example Block -->

    <?php $this->start('addscript'); ?>
    <script>
        $(function () {
            var tablelength = 10;
            if (typeof localStorage['tablelength'] !== "undefined")
            {
                tablelength = parseFloat(localStorage['tablelength']);
            }
            $('#example-datatable-2').dataTable({
                "aoColumnDefs": [{"bSortable": false
                            //, "aTargets": [ 1, 5 ] 
                        }],
                        "iDisplayLength": tablelength,
                        "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "Todo"]],
                        "order": []
                    }).columnFilter({
                        sPlaceHolder: "head:before",
                        aoColumns: filtro_c
                    });
                    $('select[name="example-datatable-2_length"]').change(function () {
            //alert($(this).val());
            localStorage['tablelength'] = $(this).val();
        });

                });
            </script>
            <?php $this->end(); ?>