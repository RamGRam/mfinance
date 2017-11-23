<?php echo $this->Form->create(null, array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control',

	),
	'novalidate' => true,
        'type' => 'file',
    'class'=>'form-focus'
     
));  
//pr($this->request->data);
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary box-form">            
             
            <?php echo $this->Form->hidden('User.id'); ?>
           <div class="box-body">
                <?php
                //for remove remembered password for unwanted fields
                echo $this->Form->password('remove_remember_password',array('style'=>array('display:none;')));
                echo $this->Form->input('id', array('type' => 'hidden'));
                echo $this->Form->input('old_password', array('type'=>'password','class' => 'form-control', 'label' => __('Old Password')));
                echo $this->Form->input('new_password', array('type'=>'password','class' => 'form-control', 'minlength'=>16, 'label' => __('New Password')));
                echo $this->Form->input('confirm_password', array('type'=>'password','class' => 'form-control', 'minlength'=>16, 'label' => __('Confirm Password')));
                ?>
            </div>
            <div class="box-footer">
                <div class="col-xs-12 col-sm-6">
                    <i class="fa fa-asterisk text-red"></i>  <?php echo __("- Indicated fields are mandatory"); ?>
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> <?php echo __("Save"); ?></button>
                    <button class="btn btn-default" type="reset"><i class="fa fa-wrench"></i> <?php echo __("Reset"); ?></button>
                    <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> ' . __('Back'), array('controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>                
                </div>                
            </div>
            <?php echo $this->Form->end(null); ?>
        </div>
    </div>        
</div>
<?php
echo $this->Html->scriptBlock('
    $("form").bootstrapValidator({
        message: "This value is not valid",            
        fields: {
        "data[User][old_password]": {
                validators: {
                    notEmpty: {
                        message: "The old password is required and cannot be empty"
                    }
                }
            },
            "data[User][password]": {
                validators: {
                    notEmpty: {
                        message: "The password is required and cannot be empty"
                    },
                    stringLength: {                           
                            min: 6,
                            message: "Password shoud be alteast 6 character"
                    }
                }
            },
            "data[User][confirm_password]": {
                validators: {
                    notEmpty: {
                        message: "The confirm password is required and cannot be empty"
                    },
                    stringLength: {                           
                            min: 6,
                            message: "Password shoud be alteast 6 character"
                    }
                }
            }
        }
    });
    $(".btn[type=\"reset\"]").click(function() {
        $("form").data("bootstrapValidator").resetForm(true);
        $("form :input:enabled:visible:first").focus();
    });
', array('inline' => false));
?>