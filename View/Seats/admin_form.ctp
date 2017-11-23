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
 
$brand = $this->request->data;
?>

<div class="box box-primary box-form">
    <div class="box-body">
        <?php
            
	        echo $this->Form->input('id');
                echo $this->Form->input('title', array('type' => 'text', 'label' => __('Place')));
                echo $this->Form->input('user_id', array('type' => 'text','class'=>'form-control seatcustomer','data-placeholder'=>'Select', 'label' => __('Customer')));
                echo $this->Form->input('staff_id', array('type' => 'text','class'=>'form-control staff','data-placeholder'=>'Select', 'label' => __('Staff')));
                echo $this->Form->input('no_of_weeks', array('type' => 'number', 'label' => __('No.Of Weeks')));
                echo $this->Form->input('amount_per_week', array('type' => 'number', 'label' => __('Amount Per Week')));
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
