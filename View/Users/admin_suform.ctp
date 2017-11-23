<?php

echo $this->Form->create(null, array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control',

	),
	'novalidate' => true,
        'type' => 'file',
        'class'=>'form-focus'
)); 
 
$user = $this->request->data;
?>

<div class="box box-primary box-form">
    <div class="box-body">
        <?php
            
                echo $this->Form->input('UserProfileImage.id');
	        echo $this->Form->input('id');
                echo $this->Form->input('user_role', array('value'=>'seat','type' => 'hidden', 'label' => __('Name')));
                echo $this->Form->input('name', array('type' => 'text', 'label' => __('Name')));
                echo $this->Form->input('email', array('type' => 'text', 'label' => __('Email')));
                echo $this->Form->input('contact', array('type' => 'text', 'label' => __('Contact')));
                echo $this->Form->input('UserProfileImage.attachment_name', array('type' => 'file', 'size' => 1048576, 'afterInput' => '<p class="help-block">Please upload only JPG, GIF, PNG file formats</p>', 'label' => __('Image')));
                if($this->params->action == 'admin_edit' && !empty($user['UserProfileImage']['attachment_name'])){
                    echo $this->html->image('/files/user_profile_image/'.str_replace('\\','/', $user['UserProfileImage']['dir']).'/'.$user['UserProfileImage']['attachment_name'],array('style'=>'width:10%;'));
                }
                echo $this->Form->input('address', array('type' => 'textarea','label' => __('Address'))); 
                echo $this->Form->input('is_active', array('type' => 'checkbox', 'class'=>'checkbox', 'value'=>'1'));
        ?>
        <span class="help-block text-danger" style="color: #b94a48" id="BrandUsed_Error"></span>
    </div>
    <div class="box-footer">
        <div class="col-xs-6">
            <i class="fa fa-asterisk text-red"></i>  <?php echo __("- Indicated fields are mandatory"); ?>
        </div>
        <div class="col-xs-6">
            <div class="pull-right">
                <button class="btn btn-primary" id="usedBrand" type="submit"><i class="fa fa-floppy-o"></i> <?php echo __("Save"); ?></button>
                <button class="btn btn-primary" type="reset"><i class="fa fa-wrench"></i> <?php echo __("Reset"); ?></button>
                <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> '. __('Back'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php echo $this->Form->end(null); ?>
</div>
<?php echo $this->Form->end(null); ?>
