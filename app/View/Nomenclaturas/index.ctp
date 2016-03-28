<!-- END Blank Header -->
<!-- Example Block -->
<style>
    .ablanco{
        color: white !important;
        font-weight: bold !important;
        font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    }
</style>
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <div class="block-options pull-right">
            <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'index'), array('class' => 'btn btn-alt btn-sm btn-primary', 'escape' => FALSE,'title' => 'editar')); ?>
            <?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'ver'), array('class' => 'btn btn-alt btn-sm btn-primary', 'escape' => FALSE,'title' => 'ver')); ?>
        </div>
        <h2>Nomenclatura de cuentas</h2>
    </div>    

    <!-- END Example Content -->
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #27ae60;" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a href="javascript:" class="ablanco" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'nomenclatura', 0)); ?>');">
                        <i class="fa fa-plus"></i> Adicionar Categoria
                    </a>
                </h4>
            </div>
        </div>
        <?php foreach ($nomenclaturas as $nom): ?>
          <div class="panel panel-default">
              <div class="panel-heading" style="background-color: #394263;" role="tab" id="headingOne-<?php echo $nom['Nomenclatura']['id']; ?>">
                  <h4 class="panel-title ">
                      <a role="button" class="ablanco" data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?php echo $nom['Nomenclatura']['id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                          <b><?php echo $nom['Nomenclatura']['codigo'] ?>- </b> <?php echo $nom['Nomenclatura']['nombre'] ?>
                      </a>
                      <div class=" pull-right">
                          <a class="btn btn-xs btn-success" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'nomenclatura', 0, $nom['Nomenclatura']['id'])); ?>');">
                              <i class="fa fa-edit"></i> Edit
                          </a>
                          <?php echo $this->Html->link('<i class="fa fa-trash-o"></i> Quitar', array('action' => 'eliminar', $nom['Nomenclatura']['id']), array('class' => 'btn btn-xs btn-danger', 'escape' => false, 'confirm' => 'Esta seguro de eliminar la categoria??')); ?>
                      </div>
                  </h4>
              </div>
              <div id="collapseOne-<?php echo $nom['Nomenclatura']['id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                      <div style="width: 100%; margin-left: 10px;" id="nom-<?php echo $nom['Nomenclatura']['id']; ?>">

                      </div>
                  </div>
              </div>
          </div>
          <script>
            $('#nom-<?php echo $nom['Nomenclatura']['id']; ?>').load('<?php echo $this->Html->url(array('action' => 'ajax_nomenclaturas', $nom['Nomenclatura']['id'])); ?>');
          </script>
        <?php endforeach; ?>
    </div>
</div>
<!-- END Example Block -->

