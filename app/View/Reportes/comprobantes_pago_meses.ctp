<div class="row">
  <div class="col-md-12">
    <!-- Basic Form Elements Block -->
    <div class="card">
      <!-- Basic Form Elements Title -->
      <div class="card-header">
        <h4>REPORTE AUXILIARES POR MESES</h4>
      </div>
      <div class="card-body">
        <?php echo $this->Form->create('Reporte', array('id' => 'ajaxform','class' => 'no-imrprime-p')); ?>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label class="control-label">Gestion</label>
              <?php echo $this->Form->select('gestion', $gestiones, array('class' => 'form-control', 'empty' => 'Seleccione la gestion', 'required')); ?>
            </div>
            <div class="col-md-3">
              <label class="control-label">&nbsp;</label>
              <button class="btn btn-primary form-control text-white">BUSCAR</button>
            </div>
          </div>
        </div>
        <?php echo $this->Form->end(); ?>
        <div class="form-group">
          <div class="row">
            <?php setlocale(LC_ALL, "es_ES"); ?>
            <div class="col-md-12" id="divtablapagos">
              <?php if (!empty($pagos)): ?>
                <h2 class="text-center text-success">REPORTE DE AUXILIARES POR MESE DEL EDIFICIO <?php echo strtoupper($this->Session->read('Auth.User.Edificio.nombre')); ?></h2>
                <h3 class="text-center"> <?php echo 'DE GESTION: ' . $this->request->data['Reporte']['gestion'] ?></h3> 
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Ambiente</th>
                        <th>Piso</th>
                        <th>Propietario</th>
                        <th>Cod.Prog.</th>
                        <th>Cod.Cont.</th>
                        <td>ENE</td>
                        <td>FEB</td>
                        <td>MAR</td>
                        <td>ABR</td>
                        <td>MAY</td>
                        <td>JUN</td>
                        <td>JUL</td>
                        <td>AGO</td>
                        <td>SEP</td>
                        <td>OCT</td>
                        <td>NOV</td>
                        <td>DIC</td>
                        <td>TOTAL</td>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $total_c = array();
                      for ($i = 1; $i <= 12; $i++) {
                        $total_c[$i] = 0.00;
                      }
                      $total_t = 0.00;
                      ?>

                      <?php foreach ($pagos as $pag): ?>
                        <?php $total_f = 0.00; ?>
                        <tr>
                          <td><?php echo $pag['Ambiente']['nombre'] ?></td>
                          <td><?php echo $pag['Comprobantescuenta']['piso'] ?></td>
                          <td><?php echo $pag['Comprobantescuenta']['propietario'] ?></td>
                          <td><?php echo $pag['Comprobantescuenta']['codigo_subc'] ?></td>
                          <td><?php echo $pag['Comprobantescuenta']['codigo'] ?></td>
                          <?php for ($i = 1; $i <= 12; $i++): ?>
                            <?php
                            $monto = $this->requestAction(array('action' => 'get_monto_com', $pag['Comprobantescuenta']['ambiente_id'], $gestion, $pag['Comprobantescuenta']['nomenclatura_id'], $pag['Comprobantescuenta']['subconcepto_id'], $i));
                            $total_f = $monto + $total_f;
                            $total_c[$i] = $monto + $total_c[$i];
                            $total_t = $monto;
                            ?>
                            <td><?php echo $monto; ?></td>
                          <?php endfor; ?>
                          <td><?php echo $total_f ?></td>
                        </tr>
                      <?php endforeach; ?>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>TOTAL</td>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                          <td><?php echo $total_c[$i] ?></td>
                        <?php endfor; ?>
                        <td><?php echo $total_t?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
