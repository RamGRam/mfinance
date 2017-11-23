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
 
$group = $this->request->data;

$date = explode(' - ',$group['Group']['first_collection_date']);
if($this->params->action == 'admin_edit'){
    $date = $this->Time->format('m/d/Y', $group['Group']['first_collection_date'])." - ".$this->Time->format('m/d/Y', $group['Group']['final_collection_date']);
    
} else {
    if($date[0]!="" && $date[1]!=""){
        $date = $this->Time->format('m/d/Y', $date[0])." - ".$this->Time->format('m/d/Y', $date[1]);
    }
}

?>

<div class="box box-primary box-form">
    <div class="box-body">

        <div class="col-md-12 col-sm-12col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <i class="icon-calendar"></i>
                    <h3 class="panel-title">Loan Details</h3>
                </div>

                <div class="panel-body">
                    <?php
                        echo $this->Form->input('GroupProfileImage.id'); 
                        echo $this->Form->input('id');
                        echo $this->Form->input('name', array('type' => 'text', 'label' => __('Title')));
                        echo $this->Form->input('center_id', array('data-placeholder'=>'Select','class'=>'form-control center','type' => 'text', 'label' => __('Center')));
                        echo $this->Form->input('disp_amount', array('type' => 'text', 'label' => __('Disbursent Amount')));
                        echo $this->Form->input('interest', array('type' => 'text', 'label' => __('Interest')));    
                        echo $this->Form->input('no_of_members', array('type' => 'text'));
                        echo $this->Form->input('first_collection_date', array('type' => 'date'));
                        echo $this->Form->input('GroupProfileImage.attachment_name', array('type' => 'file', 'size' => 1048576, 'afterInput' => '<p class="help-block">Please upload only JPG, GIF, PNG file formats</p>', 'label' => __('Image')));
                        if($this->params->action == 'admin_edit' && !empty($group['GroupProfileImage']['attachment_name'])){
                            echo $this->html->image('/files/group_profile_image/'.str_replace('\\','/', $group['GroupProfileImage']['dir']).'/'.$group['GroupProfileImage']['attachment_name'],array('style'=>'width:10%;'));
                        }
                    ?>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <i class="icon-calendar"></i>
                    <h3 class="panel-title">Minimum Loan Details</h3>
                </div>

                <div class="panel-body">
                    <?php
                        echo $this->Form->input('min_amount', array('type' => 'text', 'label' => __('Minimum Amount')));
                        echo $this->Form->input('min_amt_interest', array('class'=>'form-control','type' => 'text', 'label' => __('Interest')));
                        echo $this->Form->input('min_amt_week', array('type' => 'text', 'label' => __('No Of Week')));
                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <i class="icon-calendar"></i>
                    <h3 class="panel-title">Extra Loan Details</h3>
                </div>

                <div class="panel-body">
                    <?php
                        echo $this->Form->input('extra_amount', array('type' => 'text', 'label' => __('Extra Amount')));
                        echo $this->Form->input('extra_amt_interest', array('class'=>'form-control','type' => 'text', 'label' => __('Interest')));
                        echo $this->Form->input('extra_amt_week', array('type' => 'text', 'label' => __('No Of Week')));
                    ?>
                </div>
            </div>
        </div>

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

<script type="text/javascript">
    $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        'Last 7 Days': [moment().subtract('days', 6), moment()],
                        'Last 30 Days': [moment().subtract('days', 29), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    startDate: moment().subtract('days', 29),
                    endDate: moment()
                },
        function (start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });
    });
</script>