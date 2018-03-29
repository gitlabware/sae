

<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">



<section id="wrapper">
    <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">        
        <div class="login-box card">
            <div class="card-body">
                <?php echo $this->Form->create('User', array('class' => 'form-horizontal form-material', 'id' => 'loginform')); ?>
                <h3 class="box-title m-b-20">Administrador</h3>

                <div class="form-group ">
                    <div class="col-xs-12">
                       <?php echo $this->Form->text('username', ['class' => 'form-control', 'placeholder' => 'Ingrese el usuario', 'required']); ?>
                   </div>
               </div>
               <div class="form-group">
                <div class="col-xs-12">
                    <?php echo $this->Form->password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese el password', 'required']); ?>
                </div>
            </div>

            <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Ingresar</button>
                </div>
            </div> 
            <?php echo $this->Form->end(); ?>                 


        </div>
    </div>
</div>

</section>




    <script src="js/custom.min.js"></script>