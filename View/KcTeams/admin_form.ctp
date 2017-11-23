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
if(!empty($this->request->data['KcTeamProfileImage']['id']))
{
    echo $this->Form->hidden('kcteam_profile_id',array('type'=>'text','name'=>'kcteam_profile_id','value'=>$this->request->data['KcTeamProfileImage']['id']));
}
$kcteam = $this->request->data;
//echo "<pre>";
//print_r($kcteam);
$KcprofileImage = $kcteam['KcTeamProfileImage'];
 
?>
 

    <div class="box box-primary box-form">        
        <div class="box-body">
        <?php
 
                //for remove remembered password for unwanted fields
                echo $this->Form->password('remove_remember_password',array('style'=>array('display:none;')));
                echo $this->Form->input('KcTeamProfileImage.id', array('type' => 'hidden'));
                echo $this->Form->input('id');
                echo $this->Form->input('User.id');
                //echo $this->Form->input('agent_id', array('type' => 'text', 'label' => __('Agent Id')));
                echo $this->Form->input('first_name', array('type' => 'text', 'label' => __('First Name')));
                echo $this->Form->input('last_name', array('type' => 'text', 'label' => __('Last Name')));
                echo $this->Form->input('gender', array(
			'legend' => __('Gender'),
			//'placeholder' => __('Fuel'),
			'type' => 'radio',
			'default' => 1,
			'class' => 'radio-inline',
                        'options'=>array(1=>'Male', 2=>'Female'),
		)); 
                echo $this->Form->input('address', array('type' => 'text', 'label' => __('Address')));
                //echo $this->Form->input('country', array('options'=>$countries,'class' => 'select2 form-control','empty'=>'Select', 'label' => __('Country'),'data-placeholder' => __('Select')));
                //echo $this->Form->input('country', array('type' => 'text','class'=>'country form-control','label' => __('Country'),'data-placeholder' => __('Select')));
                //echo $this->Form->input('state', array('options'=>$states,'class' => 'select2 form-control','empty'=>'Select', 'label' => __('State'),'data-placeholder' => __('Select')));
                //echo $this->Form->input('state', array('class' => 'state form-control','type'=>'text', 'label' => __('State'),'data-placeholder' => __('Select')));
                echo $this->Form->input('city', array('options'=>$cities,'empty'=>'Select','class' => 'select2 form-control', 'label' => __('City'),'data-placeholder' => __('Select')));
                //echo $this->Form->input('city', array('class'=>'city form-control','type' => 'text', 'label' => __('City'),'data-placeholder' => __('Select')));
                echo $this->Form->input('contact_no', array('type' => 'text', 'label' => __('Conatct Number')));
                echo $this->Form->input('User.email', array('type' => 'text', 'label' => __('Email')));
                //echo $this->Form->input('user_name', array('type' => 'text', 'label' => __('User Name'))); 
                
                 if($this->params->action != 'admin_edit'){
                    echo $this->Form->input('User.password', array('type' => 'password', 'class' => 'form-control', 'label' => __('Password')));
                    echo $this->Form->input('User.confirm_password', array('type' => 'password', 'class' => 'form-control', 'label' => __('Confirm Password')));
                }
                //echo $this->Form->input('User.password', array('type' => 'password', 'label' => __('Password')));
                //echo $this->Form->input('profile_img', array('type' => 'text', 'label' => __('Profile Image Upload')));
                echo $this->Form->input('KcTeamProfileImage.attachment_name', array('type' => 'file', 'size' => 1048576, 'afterInput' => '<p class="help-block">Please upload only JPG, GIF, PNG file formats</p>', 'label' => __('Profile Image')));
               if($this->params->action == 'admin_edit' && !empty($KcprofileImage['attachment_name'])){
                    echo $this->html->image('/files/kc_team_profile_image/'.str_replace('\\','/', $KcprofileImage['dir']).'/'.$KcprofileImage['attachment_name'],array('style'=>'width:10%;'));
               }
                echo $this->Form->input('User.active', array('type' => 'checkbox', 'class'=>'checkbox', 'value'=>'1'));
                echo $this->Form->input('User.user_type', array('type' => 'hidden', 'value' => 'kcteam'));
                echo $this->Form->input('User.user_type_id', array('type' => 'hidden'));
        ?>
           
        </div>
        <div class="box-footer">
            <div class="col-xs-6">
                <i class="fa fa-asterisk text-red"></i>  <?php echo __("- Indicated fields are mandatory"); ?>
            </div>
            <div class="col-xs-6">
                <div class="pull-right">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> <?php echo __("Save"); ?></button>
                    <button class="btn btn-primary" type="reset"><i class="fa fa-wrench"></i> <?php echo __("Reset"); ?></button>
                    <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> '. __('Back'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php echo $this->Form->end(null); ?>
    </div>

