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
if(!empty($this->request->data['AgentProfileImage']['id']))
{
    echo $this->Form->hidden('agent_profile_id',array('type'=>'text','name'=>'agent_profile_id','value'=>$this->request->data['AgentProfileImage']['id']));
}
$agent = $this->request->data;
 
?>


    <div class="box box-primary box-form">        
        <div class="box-body">
        <?php
                //for remove remembered password for unwanted fields
                echo $this->Form->password('remove_remember_password',array('style'=>array('display:none;')));
                echo $this->Form->input('id');
                echo $this->Form->input('User.id');
                echo $this->Form->input('password', array('class' => 'form-control', 'maxlength'=>15, 'label' => __('New Password')));
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
 
