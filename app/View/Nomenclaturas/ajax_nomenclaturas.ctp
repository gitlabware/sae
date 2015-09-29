


<!-- END Example Content -->
<div class="panel-group" id="accordion-<?php echo $idNomenclatura; ?>" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #27ae60;" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a href="javascript:" class="ablanco" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'nomenclatura', $idNomenclatura)); ?>');">
                    <i class="fa fa-plus"></i> Adicionar Categoria
                </a>
            </h4>
        </div>
    </div>
    <?php foreach ($nomenclaturas as $nom): ?>
      <div class="panel panel-default">
          <div class="panel-heading" style="background-color: #394263;" role="tab" id="headingOne-<?php echo $nom['Nomenclatura']['id']; ?>">
              <h4 class="panel-title">
                  <a role="button" class="ablanco" data-toggle="collapse" data-parent="#accordion-<?php echo $idNomenclatura; ?>" href="#collapseOne-<?php echo $nom['Nomenclatura']['id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                      <b>
                          <?php
                          echo $this->requestAction(array('action' => 'get_codigo_com', $nom['Nomenclatura']['id']));
                          ?>- 
                      </b> <?php echo $nom['Nomenclatura']['nombre'] ?>
                  </a>
                  <div class=" pull-right">
                      <a class="btn btn-xs btn-success" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'nomenclatura', $idNomenclatura,$nom['Nomenclatura']['id']));   ?>');">
                          <i class="fa fa-edit"></i> editar
                      </a>
                      <a class="btn btn-xs btn-primary" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambientes',$nom['Nomenclatura']['id']));   ?>');">
                          <i class="fa fa-list"></i> Ambientes
                      </a>
                      <?php echo $this->Html->link('<i class="fa fa-trash-o"></i> Quitar',array('action' => 'eliminar',$nom['Nomenclatura']['id']),array('class' => 'btn btn-xs btn-danger','escape' => false,'confirm' => 'Esta seguro de eliminar la categoria??')); ?>
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