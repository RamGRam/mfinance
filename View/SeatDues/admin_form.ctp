<?php

echo $this->Form->create('SeatDue', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control',

	),
	'novalidate' => true,
        'type' => 'file',
        'class'=>'form-focus'
)); 
$seatdue = $this->request->data;
 
?>

<div class="box box-primary box-form">
    <div class="box-body">
        <?php
            
	        echo $this->Form->input('id');
                echo $this->Form->input('user_id', array('class'=>'form-control seatcustomer','data-placeholder'=>'Select','type' => 'text', 'label' => __('Customer')));
                echo $this->Form->input('amount', array('class'=>'form-control seatdue','data-placeholder'=>'Select','type' => 'text', 'label' => __('Amount')));    
                echo $this->Form->input('paid_date', array('id'=>'reservation','class'=>'form-control','type' => 'text', 'label' => __('Paid Date')));    
                 
                
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
<script>
    $(function () {
        
        $('#reservation').daterangepicker({
            singleDatePicker: true
        });
    });

</script>