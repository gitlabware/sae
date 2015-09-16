<!--<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="fa fa-check-circle"></i> Excelente </h4> <?php //echo $message; ?>
</div>-->
<script>
  var growlType = 'success';
  $.bootstrapGrowl('<h4>Excelente!</h4> <p><?php echo $message; ?></p>', {
      type: growlType,
      delay: 2500,
      width: 400,
      allow_dismiss: true
  });
  $(this).prop('disabled', true);
</script>