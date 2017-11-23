        <p class="login-box-msg">Reset Password</p>
        <?php echo $this->Form->create(null, array(
		'inputDefaults' => array(
			'div' => 'form-group has-feedback',
			'wrapInput' => false,
			'class' => 'form-control'
		),
		'novalidate' => true,
            'class'=>'form-focus'
	)); ?>
            <?php echo $this->Form->input('id'); ?>	
            <?php echo $this->Form->input('password', array(
            	'label'=>false, 
            	'placeholder'=>__('Password'),
            	'after'=>'<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
            	)); ?>
            <?php echo $this->Form->input('confirm_password', array(
            	'label'=>false, 
            	'type' => 'password',
            	'placeholder'=>__('Confirm Password'),
            	'after'=>'<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
            	)); ?>
          <div class="row">
            <div class="col-xs-8">
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
            </div><!-- /.col -->
          </div>
        <?php echo $this->Form->end(null); ?>