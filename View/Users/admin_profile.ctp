<style>
    .input
    {
        width: 100%;
    }
</style>
 
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary box-form">
<!--            <div class="box-header">
                <h3 class="box-title">
                    <?php
                    echo '<i class="glyphicon glyphicon-edit"></i> ' . __('Edit - Profile');
                    ?>
                </h3>                                                                           
            </div>-->
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
            <div class="box-body">
                <?php
                echo $this->Form->input('UserProfileImage.id');
                echo $this->Form->input('id');
                echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'label' => __('Name')));
                echo $this->Form->input('email', array('type' => 'email','class' => 'form-control', 'maxlength'=>100 , 'label' => __('Email')));
                echo $this->Form->input('UserProfileImage.attachment_name', array('type' => 'file', 'size' => 1048576, 'afterInput' => '<p class="help-block">Please upload only JPG, GIF, PNG file formats</p>', 'label' => __('Profile image')));
                if($this->params->action == 'admin_profile' && !empty($this->request->data['UserProfileImage']['attachment_name'])){
                    echo $this->html->image('/files/user_profile_image/'.str_replace('\\','/', $this->request->data['UserProfileImage']['dir']).'/'.$this->request->data['UserProfileImage']['attachment_name'],array('style'=>'width:10%;'));
                }
                // echo $this->Form->input('updated', array('type' => 'text', 'class' => 'form-control', 'label' => __('Updated')));                
                ?>
            </div>
            <div class="box-footer">
                <div class="col-xs-12 col-sm-6">
                    <i class="fa fa-asterisk text-red"></i>  <?php echo __("- Indicated fields are mandatory"); ?>
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> <?php echo __("Save"); ?></button>
                    <button class="btn btn-default" type="reset"><i class="fa fa-wrench"></i> <?php echo __("Reset"); ?></button>
                    <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> ' . __('Back'), array('controller' => 'dashboards', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>                
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
            "data[User][name]": {
                validators: {
                    notEmpty: {
                        message: "The name is required and cannot be empty"
                    }
                }
            },
            "data[User][email]": {
                validators: {
                    notEmpty: {
                        message: "The email is required and cannot be empty"
                    }
                }
            },
            "data[User][contact_no]": {
                validators: {
                    notEmpty: {
                        message: "The contact number is required and cannot be empty"
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