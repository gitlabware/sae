<!-- Blank Header -->
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>Edificio <?php echo $edificio['Edificio']['nombre']?><br>
        </h1>
    </div>
</div>
<?php foreach ($pisos as $pi): ?>
    <div class="block">
        <!-- Example Title -->
        <div class="block-title">
            <h2><?php echo $pi['Piso']['nombre']; ?> - AMBIENTES</h2>
        </div>
        <?php $ambientes = $this->requestAction(array('action' => 'get_ambientes',$edificio['Edificio']['id'],$pi['Piso']['id']))?>
        <div class="row">
            <?php foreach ($ambientes as $am):?>
            <div class="col-md-3">
                <a class="btn btn-info col-md-10" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente',$pi['Piso']['id'],$am['Ambiente']['id'])); ?>');"><?php echo $am['Ambiente']['nombre']?></a> 
                 <?php echo $this->Html->link('<i class="gi gi-circle_remove"></i>',array('action' => 'eliminar',$am['Ambiente']['id']),array('class' => 'btn btn-danger col-md-2','escape' => FALSE,'confirm' => 'Esta seguro de quitar el ambiente','title' => 'Quitar ambiente'))?>
            </div> 
            <?php endforeach;?>
            <div class="col-md-3">
                <a class="btn btn-success col-md-12" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente',$pi['Piso']['id'])); ?>');">ADICIONAR</a>
            </div> 
        </div>
        <br>
    </div>
<?php endforeach; ?>