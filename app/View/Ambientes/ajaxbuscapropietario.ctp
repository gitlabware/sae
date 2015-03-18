<div class="table-responsive">
    <!--
    Available Table Classes:
        'table'             - basic table
        'table-bordered'    - table with full borders
        'table-borderless'  - table with no borders
        'table-striped'     - striped table
        'table-condensed'   - table with smaller top and bottom cell padding
        'table-hover'       - rows highlighted on mouse hover
        'table-vcenter'     - middle align content vertically
    -->    
    <table id="general-table" class="table table-striped table-vcenter">
        <thead>
            <tr>                
                <th>Propietario</th>                
                <th style="width: 150px;" class="text-center"></th>
            </tr>
        </thead>
        <tbody>            
            <?php foreach ($propietarios as $p): ?>            
              <?php $idPropietario = $p['User']['id']; ?>             
              <tr>                                
                  <td>
                      <?php echo $p['User']['nombre']; ?>
                      <?php
                      echo $this->Form->hidden('idPropietario', array('value' => $idPropietario));
                      echo $this->Form->hidden('opcion', array('value' => 2));
                      ?>  
                  </td>                
                  <td class="text-center">
                      <div class="btn-group btn-group-sm">
                          <button type="button" onclick="envia(<?php echo $idPropietario; ?>)" data-toggle="tooltip" title="Edit" class="btn btn-success"><i class="fa fa-search"></i></button>                        
                      </div>
                  </td>
              </tr>                
            <?php endforeach; ?>
        </tbody>      
    </table>

</div>
<script>
  function envia(idPropietario){
    console.log(idPropietario);
    $('#ajax_loader').load('<?php echo $this->Html->url(array('action'=>'ajaxlistapropietario')); ?>/'+idPropietario);
  }
</script>