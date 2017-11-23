 
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary filters">
            <div class="box-header">
                <h3 class="box-title"><i class="glyphicon glyphicon-filter"></i><?php echo __('Filter'); ?></h3>
                <div class="box-tools pull-right">
                    <?php echo $this->Html->link('<i class="fa fa-chevron-down"></i>', '#', array('data-toggle' => 'collapse','onclick'=>'return false', 'data-target' => '#collapseTwo', 'class' => 'collapsed btn btn-default btn-sm filter_icon_bg', 'id' => 'click', 'escape' => false)); ?>
                </div>
            </div> 
            <?php echo $this->Form->create('Seats',array('type' => 'GET','url' => array('controller' => 'Seats', 'action' => 'admin_closed'))); ?>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php
                        echo $this->Html->tag('div', $this->Form->input('user_id', array('type' => 'text','data-placeholder'=>'Select', 'class' => 'form-control customer', 'label' => __('Customer'))), array('class' => 'col-md-6'));
                        echo $this->Html->tag('div', $this->Form->input('staff_id', array('type' => 'text', 'data-placeholder'=>'Select', 'class' => 'form-control staff', 'label' => __('Staff'))), array('class' => 'col-md-6'));
                        echo $this->Html->tag('div', $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'label' => __('Place'))), array('class' => 'col-md-6'));
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
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <tr class="actions">
                        <th><?php echo __('ID'); ?></th>
                        <th><?php echo __('Place'); ?></th>
                        <th><?php echo __('Customer'); ?></th>
                        <th><?php echo __('Staff'); ?></th>
                        <th><?php echo __('No.Of Weeeks'); ?></th>
                        <th><?php echo __('Amount Per Weeeks'); ?></th>
                        <th><?php echo __('Last Updated'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <?php
                    if (empty($seats)) {
                        echo $this->Html->tag('tr', $this->Html->tag('td colspan = "7"', __('No records found')));
                    } else {  
                        foreach ($seats as $seat):
                            ?>
                            <tr> 
                                <td><?php echo __($seat['Seat']['id']); ?></td>
                                <td><?php echo __($seat['Seat']['title']); ?></td>
                                <td><?php echo __($seat['Staff']['name']); ?></td>
                                <td><?php echo __($seat['User']['name']); ?></td>
                                <td><?php echo __($seat['Seat']['no_of_weeks']); ?></td>
                                <td>Rs <?php echo __($seat['Seat']['amount_per_week']); ?></td>
                                <td><?php echo __($this->Time->format('M jS, Y h:i A', $seat['Seat']['updated'])); ?></td>
                                <td>
                                    <?php echo $this->html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i>', array('action' => 'view', $seat['Seat']['id']), array('escape' => false, 'class' => "btn btn-primary btn-xs")); ?>
                                </td>
                            </tr> 
                            <?php
                        endforeach;
                    }
                    ?>
                    <tr>
                        <td><b>Customers</b></td>
                        <td><b><?php echo $customers;?></b></td>
                        <td><b>Amount Paid</b></td>
                        <td colspan="5"><b>Rs <?php echo $amount;?></b></td>
                    </tr>
                </table>
                <?php echo $this->element('admin/pagination'); ?>
            </div>
        </div>
    </div>
</div>