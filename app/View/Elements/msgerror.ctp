<?php $this->append('campo_css_ant'); ?>
<link href="<?php echo $this->webroot; ?>template/assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<?php $this->end(); ?>
<?php $this->append('campo_js_ant'); ?>
    <script src="<?php echo $this->webroot; ?>template/assets/plugins/toast-master/js/jquery.toast.js"></script>
    <script>
        $.toast({
            heading: 'Error',
            text: '<?= h($message) ?>',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });
    </script>
<?php $this->end(); ?>

