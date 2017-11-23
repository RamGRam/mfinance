 
<p class="login-box-msg">Sign in to start your session</p>
        <?php echo $this->Form->create(null, array(
		'inputDefaults' => array(
			'div' => 'form-group has-feedback',
			'wrapInput' => false,
			'class' => 'form-control',
			
		),
		'novalidate' => true,
            'class'=>'form-focus'
	)); ?>
            <?php echo $this->Form->input('username', array(
            	'label'=>false, 
            	'placeholder'=>__('Email'),'value'=>$pk_username,
            	'after'=>'<span class="glyphicon glyphicon-envelope form-control-feedback"></span>'
            	)); ?>
            <?php echo $this->Form->input('password', array(
            	'label'=>false, 
            	'placeholder'=>__('Password'),'value'=>$pk_password,
            	'after'=>'<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
            	)); ?>
<div class="row">
    <div class="col-xs-7 col-sm-6">
            <?php echo $this->Form->input('remember', array(
	    		'type' => 'checkbox',
	    		'div' => 'checkbox',
	    		'class' => false,$pk_remember,
	    		'label' => 'Remember me'
		)); ?>
    </div><!-- /.col -->
    <div class="col-xs-5 col-sm-6 text-right">
        <button type="submit" class="btn btn-primary btn-flat">Sign In</button>
        <button type="reset" class="btn btn-default btn-flat hidden-xs"><?php echo __('Reset'); ?></button>
    </div><!-- /.col -->
</div>
        <?php echo $this->Form->end(null); ?>

        <?php echo $this->Html->link(__('I forgot my password'), array('controller'=>'users', 'action'=>'forgot_password')); ?>