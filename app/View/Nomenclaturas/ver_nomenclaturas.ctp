<!-- END Example Content -->
<div class="panel-group" id="accordion-<?php echo $idNomenclatura; ?>" role="tablist" aria-multiselectable="true">
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
              </h4>
          </div>
          <div id="collapseOne-<?php echo $nom['Nomenclatura']['id']; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body" style="width: 100%; margin-left: 10px;" id="nom-<?php echo $nom['Nomenclatura']['id']; ?>">

              </div>
          </div>
      </div>
      <script>
        $('#nom-<?php echo $nom['Nomenclatura']['id']; ?>').load('<?php echo $this->Html->url(array('action' => 'ver_nomenclaturas', $nom['Nomenclatura']['id'])); ?>');
      </script>
    <?php endforeach; ?>
</div>