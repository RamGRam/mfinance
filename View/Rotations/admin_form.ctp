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
                echo $this->Form->input('customer_name', array('type' => 'text', 'label' => __('Customer Name')));
                echo $this->Form->input('contact', array('type' => 'text', 'label' => __('Contact')));
                echo $this->Form->input('payment_date', array('type' => 'date', 'label' => __('Payment Date'))); 
                echo $this->Form->input('closed_date', array('type' => 'date', 'label' => __('Closed Date'))); 
                echo $this->Form->input('payment_amount', array('type' => 'text', 'label' => __('Payment Amount'))); 
                echo $this->Form->input('collection_amount', array('type' => 'text', 'label' => __('Collection Amount')));
                //echo $this->Form->input('balance_amount', array('type' => 'text', 'label' => __('Balance Amount')));
                 
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
   
</div>
<?php echo $this->Form->end(null); ?>
