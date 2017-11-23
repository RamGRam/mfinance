 
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary filters">
            <div class="box-header">
                <h3 class="box-title"><i class="glyphicon glyphicon-filter"></i><?php echo __('Filter'); ?></h3>
                <div class="box-tools pull-right">
                    <?php echo $this->Html->link('<i class="fa fa-chevron-down"></i>', '#', array('data-toggle' => 'collapse','onclick'=>'return false', 'data-target' => '#collapseTwo', 'class' => 'collapsed btn btn-default btn-sm filter_icon_bg', 'id' => 'click', 'escape' => false)); ?>
                </div>
            </div> 
            <?php echo $this->Form->create(null); ?>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php
                        echo $this->Html->tag('div', $this->Form->input('loan_id', array('data-placeholder'=>'Select','type' => 'text', 'class' => 'form-control loan', 'label' => __('Loan Id'))), array('class' => 'col-md-6'));
                        echo $this->Html->tag('div', $this->Form->input('amount', array('type' => 'text', 'class' => 'form-control', 'label' => __('Amount'))), array('class' => 'col-md-6'));
                        echo $this->Html->tag('div', $this->Form->input('user_id', array('data-placeholder'=>'Select','type' => 'text', 'class' => 'form-control customer', 'label' => __('Customer'))), array('class' => 'col-md-6'));
                        echo $this->Html->tag('div', $this->Form->input('type', array('type' => 'select','class' => 'form-control', 'empty' => __('All'), 'options' => array('2' => 'Arrear', '1' => 'Collection'), 'label' => __('Status'))), array('class' => 'col-md-6'));
                        echo $this->Html->tag('div', $this->Form->input('date', array('value'=>$_REQUEST['date'],'id'=>'reservation','required'=>false,'type' => 'text', 'class' => 'form-control dateTime', 'label' => __('From Date - To Date'))), array('class' => 'col-md-6'));
                    ?> 
                </div>
                <div class="box-footer text-right">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> <?php echo __("Search"); ?></button>
<!--                    <button class="btn btn-default" type="reset"><i class="fa fa-wrench"></i> <?php echo __("Reset"); ?></button>-->
                    <?php echo $this->Html->link('<i class="fa fa-refresh"></i> ' . __("Refresh"), array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>                                       
                </div>
                <?php echo $this->Form->end(null); ?>
            </div>
        </div>
        <div class="box box-primary box-grid listing">
            <div class="box-header">
                <h3 class="box-title"><i class="glyphicon glyphicon-th-list"></i>  <?php echo __('Listing'); ?></h3>
                <?php echo $this->Html->link('<i class="fa fa-plus"></i> '. __('Add New'), array('action' => 'add'), array('class' => 'btn btn-primary pull-right', 'escape' => false)); ?>
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <tr class="actions">
                        <th><?php echo __('Loan ID'); ?></th>
                        <th><?php echo __('Customer'); ?></th>
                        <th><?php echo __('Amount'); ?></th>
                        <th><?php echo __('Type'); ?></th>
                        <th><?php echo __('Created'); ?></th>
                        <th><?php echo __('Updated'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <?php $arrTotal = 0; $collTotal = 0;
                    if (empty($dues)) {
                        echo $this->Html->tag('tr', $this->Html->tag('td colspan = "7"', __('No records found')));
                    } else {
                        foreach ($dues as $dues):
                            $loan = ClassRegistry::init('Loan')->find('first',array('fields'=>array('uid'),'conditions'=>array('id'=>$dues['Due']['loan_id']),'recursive'=>-1));
                            ?>
                    <tr> 
                        <td><?php echo __($loan['Loan']['uid']); ?></td>
                        <td><?php echo __($dues['User']['name']); ?></td>
                        <td>Rs <?php echo __($dues['Due']['amount']); ?></td>
                        <td><?php echo __($type[$dues['Due']['type']]); ?></td>
                        <td><?php echo __($this->Time->format('M jS, Y h:i A', $dues['Due']['created'])); ?></td>
                        <td><?php echo __($this->Time->format('M jS, Y h:i A', $dues['Due']['updated'])); ?></td>
                        <td>
                            <?php 
                            if($dues['Due']['type']==1){
                                $disabled = "disabled";
                                echo $this->html->link('<i  class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>', array('action' => '#'), array($disabled,'class' => "btn btn-primary btn-xs", 'escape' => false));
                            } else{
                                echo $this->html->link('<i  class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>', array('action' => 'edit', $dues['Due']['id']), array('class' => "btn btn-primary btn-xs", 'escape' => false));
                            }
                            ?>
                            <?php //echo $this->Form->postLink('<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Delete"></i>', array('action' => 'delete', $loan['Loan']['id']), array('confirm' => __('Do you really want to delete ' . $loan['Loan']['uid'] . '?'), 'escape' => false, 'class' => "btn btn-danger btn-xs")); ?>
                        </td>
                    </tr> 
                            <?php
                             
                        endforeach;
                    }
                    ?>
                    <tr>
                        <td><b>Collection</b></td>
                        <td><b>Rs <?php echo $collection;?></b></td>
                        <td><b>Arear</b></td>
                        <td><b>Rs <?php echo $arrear;?></b></td>
                        <td><b>Total</b></td>
                        <td colspan="2"><b>Rs <?php echo $collection+$arrear;?></b></td>
                    </tr>

                </table>
                <?php echo $this->element('admin/pagination'); ?>
            </div>
        </div>
    </div>
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


    });
</script>