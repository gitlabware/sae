<div class="row">
    <div class="col-md-12">
        <!-- Basic Form Elements Block -->
        <div class="block">
            <!-- Basic Form Elements Title -->
            <div class="block-title">
                <h2>Reporte de Comprobantes</h2>
            </div>
            <div class="form-horizontal form-bordered">
                <?php echo $this->Form->create('Reporte'); ?>

                <div class="form-group">
                    <div class="col-md-3">
                        <label class="control-label">Tipo</label>
                        <?php echo $this->Form->select('tipo', array('Ingreso' => 'Ingreso', 'Egreso' => 'Egreso', 'Ingreso de Banco' => 'Ingreso de Banco'), array('class' => 'form-control', 'empty' => 'Todos')); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Nomenclatura cta.</label>
                        <?php echo $this->Form->select('nomenclatura_id', $nomenclaturas, array('class' => 'select-chosen', 'empty' => 'Todos')); ?>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">Fecha_Inicio</label>
                        <?php echo $this->Form->date('fecha_ini', array('class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">Fecha_Fin</label>
                        <?php echo $this->Form->date('fecha_fin', array('class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">&nbsp;</label>
                        <button class="btn btn-primary form-control">BUSCAR</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <div class="form-group">
                    <div class="col-md-12" id="divtablapagos">
                        <?php if (!empty($comprobantes)): ?>
                          <h2 class="text-center text-success">REPORTE DE COMPROBANTES EDIFICIO <?php echo strtoupper($this->Session->read('Auth.User.Edificio.nombre')); ?></h2>
                          <h3 class="text-center"> <?php echo 'DESDE ' . $this->request->data['Reporte']['fecha_ini'] . ' HASTA ' . $this->request->data['Reporte']['fecha_ini'] ?></h3> 
                          <?php if (!empty($nomenclatura)): ?>
                            <h4 class="text-center"> <?php echo $nomenclatura['Nomenclatura']['codigo_completo'] . ' - ' . $nomenclatura['Nomenclatura']['nombre'] ?></h4>
                          <?php endif; ?>
                          <?php if (!empty($this->request->data['Reporte']['tipo'])): ?>
                            <h4 class="text-center"><?php echo $this->request->data['Reporte']['tipo']; ?></h4>
                          <?php endif; ?>
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>Fecha</th>
                                          <th>Numero</th>
                                          <th>Codigo Prog.</th>
                                          <th>Codigo Ctab.</th>
                                          <th>Cuenta Contable</th>
                                          <th>Auxiliar</th>
                                          <th>Debe</th>
                                          <th>Haber</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($comprobantes as $comp): ?>
                                        <tr>
                                            <td><?php echo $comp['Comprobante']['fecha'] ?></td>
                                            <td><?php echo $comp['Comprobante']['numero'] ?></td>
                                            <td><?php echo $comp['Comprobante']['codigo'] ?></td>
                                            <td><?php echo $comp['Comprobante']['codigo_subc'] ?></td>
                                            <td><?php echo $comp['Comprobante']['cta_ctable'] ?></td>
                                            <td><?php echo $comp['Comprobante']['auxiliar'] ?></td>
                                            <td><?php echo $comp['Comprobante']['debe'] ?></td>
                                            <td><?php echo $comp['Comprobante']['haber'] ?></td>
                                        </tr>
                                      <?php endforeach; ?>
                                      <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td>TOTAL</td>
                                          <td><?php echo $total_debe; ?></td>
                                          <td><?php echo $total_haber; ?></td>
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
