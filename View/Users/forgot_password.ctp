        <p class="login-box-msg">Forgot Password?</p>
        <?php echo $this->Form->create(null, array(
		'inputDefaults' => array(
			'div' => 'form-group has-feedback',
			'wrapInput' => false,
			'class' => 'form-control'
		),
		'novalidate' => true,
            'class'=>'form-focus'
	)); ?>
            <?php echo $this->Form->input('username', array(
            	'label'=>false, 
            	'placeholder'=>__('Username'),
            	'after'=>'<span class="glyphicon glyphicon-envelope form-control-feedback"></span>'
            	)); ?>
          <div class="row">
            <div class="col-xs-8">
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
            </div><!-- /.col -->
          </div>
        <?php echo $this->Form->end(null); ?>