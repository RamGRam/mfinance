<!DOCTYPE html>
<html>
  <head>
    <?php echo $this->Html->charset(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<?php
		echo $this->Html->meta('favicon.ico','img/favicon.ico',array('type' => 'icon'));

		echo $this->Html->css(array(
			'bootstrap.min',
			'font-awesome.min',
			'select2.min',
			'select2-bootstrap.min',
		));
		
		echo $this->Minify->css(array(
			'AdminLTE.min.css',
			'skins/_all-skins.min.css',
			'AdminLTE-additional.css',
		));
		
		echo $this->Html->scriptBlock('var web_root="' . $this->Html->url('/') . '";'); 
	?>

  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><?php echo $this->Html->image('pitkrew-logo-resize.png'); ?></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
  
	<?php
		echo $this->Html->script(array(
			'jquery.min',
			'bootstrap.min',
			'select2.min',
		));

		echo $this->Minify->script(array(
			'AdminLTE.min.js',
			'common_functions.js',
		));
                echo $this->Html->script(array('scripts'));

	?>
  </body>
</html>