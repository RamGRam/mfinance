<style>
    .input
    {
        width: 100%;
    }
</style>
 
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary box-form">
 
            <?php echo $this->Form->create(null, array(
                    'inputDefaults' => array(
                            'div' => 'form-group',
                            'wrapInput' => false,
                            'class' => 'form-control',

                    ),
                    'novalidate' => true,
                    'type' => 'file',
                    'class'=>'form-focus',
                    'autocomplete'=>'off'
                ));  
                $this->request->data['AdminProfileImage'] = $image;
            ?>
            <input type="password" style="display:none;">
            <div class="box-body">
                <?php
                echo $this->Form->input('AdminProfileImage.id');
                echo $this->Form->input('kcteam_id',array('label'=>false,'value'=>$kcTeam['KcTeam']['id'],'type'=>'text','style'=>array('display:none')));
                echo $this->Form->input('id');
                echo $this->Form->input('first_name', array('value'=>$kcTeam['KcTeam']['first_name'],'type' => 'text', 'class' => 'form-control'));
                echo $this->Form->input('last_name', array('value'=>$kcTeam['KcTeam']['last_name'],'type' => 'text', 'class' => 'form-control'));
                echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'label' => __('Name')));
                echo $this->Form->input('city_id', array('value'=>$kcTeam['KcTeam']['city'],'type'=>'text','class' => 'city form-control', 'label' => __('City'),'data-placeholder' => __('Select')));
                echo $this->Form->input('email', array('type' => 'email','class' => 'form-control', 'maxlength'=>100 , 'label' => __('Email')));
                echo $this->Form->input('User1.new_password', array('type' => 'password', 'class' => 'form-control', 'label' => __('New password')));              
                 
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