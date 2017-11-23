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
$loan = $this->request->data;

if($this->params->action == 'admin_edit'){
    if(!empty($loan['Loan']['extra_amount'])){
        $value = 2;
        $extra = 0;
    } else {
        $value = 1;
        $extra = 1;
    }
    
    setcookie('extra_amount', $extra, time() + (86400 * 30), "/"); // 86400 = 1 day
}

?>

<div class="box box-primary box-form">
    <div class="box-body">
        <?php
            
	        echo $this->Form->input('id');
                echo $this->Form->input('controller',array('type'=>'hidden','value'=>$this->request->params['controller']));
                echo $this->Form->input('uid', array('type' => 'text', 'label' => __('Loan Id')));
                echo $this->Form->input('user_id', array('class'=>'form-control customer','data-placeholder'=>'Select','type' => 'text', 'label' => __('Customer')));
                echo $this->Form->input('group_id', array('class'=>'form-control group','data-placeholder'=>'Select','type' => 'text', 'label' => __('Group')));
                echo $this->Form->input('amount', array('value'=>$value,'class'=>'form-control price','data-placeholder'=>'Select','type' => 'text', 'label' => __('Amount')));    
                
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
