<div class="col-md-6 col-8 align-self-center">
  <h2 class="text-themecolor m-b-0 m-t-0">Listado de Sub-conceptos</h2>
</div>

<div class="row">
  <!-- Example Title -->
  <div class="col-md-12">
    <div class="block-options pull-right">
      <a href="javascript:void(0)" class="btn btn-alt btn-success" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Conceptos', 'action' => 'subconcepto')); ?>');" title="Nuevo Subconcepto"><i class="fa fa-plus"></i></a>
    </div>

  </div>    
  <!-- Example Content -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
       <div class="table-responsive m-t-40">
        <table id="general-table" class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10%;">Codigo</th>
              <th style="width: 45%;">Subconcepto</th>
              <th style="width: 10%;">Tipo</th>
              <th style="width: 20%;">Concepto</th>
              <th style="width: 15%;">Accion</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($subconceptos as $sub): ?>

              <tr class="table-success">
                <td style="width: 10%;"><?php echo $sub['Subconcepto']['codigo'] ?></td>
                <td style="width: 45%;"><?php echo $sub['Subconcepto']['nombre'] ?></td>
                <td style="width: 10%;"><?php echo $sub['Subconcepto']['tipo'] ?></td>
                <td style="width: 20%;"><?php echo $sub['Concepto']['nombre'] ?></td>
                <td style="width: 15%;">
                  <a class="btn btn-secondary btn-sm" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'subconcepto', $sub['Subconcepto']['id'])); ?>');"><i class="fa fa-pencil"></i> </a>  
                  <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar_subconcepto', $sub['Subconcepto']['id']), array('class' => 'btn btn-danger btn-sm', 'escape' => FALSE, 'confirm' => 'Esta seguro de quitar el subconcepto!!', 'title' => 'Quitar subconcepto')) ?> 
                </td>
              </tr>
              <tr>
                <td style="padding: 0px;" colspan="5" id="subconcepto-<?php echo $sub['Subconcepto']['id']; ?>">

                </td>
              </tr>
              <?php $this->append('campo_js') ?>
              <script>
                $('#subconcepto-<?php echo $sub['Subconcepto']['id']; ?>').load('<?php echo $this->Html->url(array('action' => 'ajax_subconceptos', $sub['Subconcepto']['id'])) ?>');
              </script>
              <?php $this->end() ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- END Example Content -->
    </div>
  </div>
</div> 
</div>

