 
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
                    echo $this->Html->tag('div', $this->Form->input('uid', array('type' => 'text', 'class' => 'form-control', 'label' => __('Loan Id'))), array('class' => 'col-md-6'));
                    echo $this->Html->tag('div', $this->Form->input('loan_amount', array('type' => 'text', 'class' => 'form-control', 'label' => __('Amount'))), array('class' => 'col-md-6'));
                    echo $this->Html->tag('div', $this->Form->input('uid', array('data-placeholder'=>'Select','type' => 'text', 'class' => 'form-control group', 'label' => __('Group'))), array('class' => 'col-md-6'));
                    echo $this->Html->tag('div', $this->Form->input('user_id', array('data-placeholder'=>'Select','type' => 'text','class' => 'form-control customer',  'label' => __('Customer'))), array('class' => 'col-md-6'));
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
                <?php if($this->Session->read('User.User.id')==1){?>
                    <?php echo $this->Html->link('<i class="fa fa-plus"></i> '. __('Add New'), array('action' => 'add'), array('class' => 'btn btn-primary pull-right', 'escape' => false)); ?>
                <?php }?>
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <tr class="actions">
                        <th><?php echo __('ID'); ?></th>
                        <th><?php echo __('Customer'); ?></th>
                        <th><?php echo __('Group'); ?></th>
                        <th><?php echo __('Loan Amount'); ?></th>
                        <th><?php echo __('Last Updated'); ?></th>

                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <?php
                    if (empty($loans)) {
                        echo $this->Html->tag('tr', $this->Html->tag('td colspan = "6"', __('No records found')));
                    } else {
                        foreach ($loans as $loan):
                            ?>
                    <tr> 
                        <td><?php echo __($loan['Loan']['uid']); ?></td>
                        <td><?php echo __($loan['User']['name']); ?></td>
                        <td><?php echo __($loan['Group']['name']); ?></td>
                        <td>Rs <?php echo __($loan['Loan']['loan_amount']); ?></td>
                        <td><?php echo __($this->Time->format('M jS, Y h:i A', $loan['Loan']['updated'])); ?></td>
                        <td>
                            <?php echo $this->html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i>', array('action' => 'view', $loan['Loan']['id']), array('escape' => false, 'class' => "btn btn-primary btn-xs")); ?>
                            <?php if($this->Session->read('User.User.id')==1){?>
                                <?php echo $this->html->link('<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>', array('action' => 'edit', $loan['Loan']['id']), array('class' => "btn btn-primary btn-xs", 'escape' => false)); ?> 
                                <?php echo $this->Form->postLink('<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Delete"></i>', array('action' => 'delete', $loan['Loan']['id']), array('confirm' => __('Do you really want to delete ' . $loan['Loan']['uid'] . '?'), 'escape' => false, 'class' => "btn btn-danger btn-xs")); ?>
                            <?php }?>
                        </td>
                    </tr> 
                            <?php
                        endforeach;
                    }
                    ?>
                </table>
                <?php echo $this->element('admin/pagination'); ?>
            </div>
        </div>
    </div>
</div>