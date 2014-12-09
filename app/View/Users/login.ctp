 <!-- Login Block -->
            <div class="block push-bit">
                <!-- Login Form -->
                <?php echo $this->Form->create('User',array('class' => 'form-horizontal form-bordered form-control-borderless','id' => 'form-login'));?>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <?php echo $this->Form->text('username',array('class' => 'form-control input-lg','placeholder' => 'Nombre de Usuario','required'));?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <?php echo $this->Form->password('password',array('class' => 'form-control input-lg','placeholder' => 'Password','required'));?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        
                        <div class="col-xs-8 text-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Ingresar al Sistema</button>
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
                <!-- END Login Form -->

                

            </div>
            <!-- END Login Block -->