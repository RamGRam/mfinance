<?php

echo $this->Form->create('Due', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control',

	),
	'novalidate' => true,
        'type' => 'file',
        'class'=>'form-focus'
)); 
$due = $this->request->data;
if($this->params->action == 'admin_edit'){
    $disabled = "readonly";
}
 
?>
<script>
    function chkDue() {
        if ($('#amount').val() == 2) {
            if (confirm("Are you sure want to preclose the Loan?")) {
                $('#due').click();
            }
        } else {
            $('#due').click();
        }

    }
</script>
<div class="box box-primary box-form">
    <div class="box-body">
        <?php
            
	        echo $this->Form->input('id');
                echo $this->Form->input('user_id',array('type'=>'hidden','value'=>1));
                echo $this->Form->input('loan_id', array($disabled,'class'=>'form-control loanList','id'=>'loan','data-placeholder'=>'Select','type' => 'text', 'label' => __('Loan Id')));
                if($this->params->action == 'admin_edit'){
                    echo $this->Form->input('amount', array('readonly','class'=>'form-control','type' => 'text', 'label' => __('Amount')));    
                } else {
                    echo $this->Form->input('amount', array('id'=>'amount','class'=>'form-control due','data-placeholder'=>'Select','type' => 'text', 'label' => __('Amount')));    
                }        
                
                echo $this->Form->input('type', array(
			'legend' => __('Type'),
			//'placeholder' => __('Fuel'),
			'type' => 'radio',
			'default' => 1,
			'class' => 'radio-inline',
                        'options'=>array(1=>'Collection', 2=>'Arrear'),
		));
                
        ?>
        <span class="help-block text-danger" style="color: #b94a48" id="BrandUsed_Error"></span>
    </div>
    <div class="box-footer">
        <div class="col-xs-6">
            <i class="fa fa-asterisk text-red"></i>  <?php echo __("- Indicated fields are mandatory"); ?>
        </div>
        <div class="col-xs-6">
            <div class="pull-right">
                <button class="btn btn-primary" style="display: none" id="due" type="submit"><i class="fa fa-floppy-o"></i> <?php echo __("Save"); ?></button>
                <button class="btn btn-primary" id="due" onclick="chkDue()" type="button"><i class="fa fa-floppy-o"></i> <?php echo __("Save"); ?></button>
                <button class="btn btn-primary" type="reset"><i class="fa fa-wrench"></i> <?php echo __("Reset"); ?></button>
                <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> '. __('Back'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php echo $this->Form->end(null); ?>
