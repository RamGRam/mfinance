 
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
                    echo $this->Html->tag('div', $this->Form->input('customer_name', array('type' => 'text', 'class' => 'form-control', 'label' => __('Customer Name'))), array('class' => 'col-md-6'));
                    echo $this->Html->tag('div', $this->Form->input('contact', array('type' => 'text', 'class' => 'form-control', 'label' => __('Contact'))), array('class' => 'col-md-6'));
                    echo $this->Html->tag('div', $this->Form->input('payment_amount', array('type' => 'text', 'class' => 'form-control', 'label' => __('Payment Amount'))), array('class' => 'col-md-6'));
                    echo $this->Html->tag('div', $this->Form->input('collection_amount', array('type' => 'text', 'class' => 'form-control', 'label' => __('Collection Amount'))), array('class' => 'col-md-6'));
                    echo $this->Html->tag('div', $this->Form->input('balance_amount', array('type' => 'text', 'class' => 'form-control', 'label' => __('Balance Amount'))), array('class' => 'col-md-6'));
                     
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
                        <th><?php echo __('Customer Name'); ?></th>
                        <th><?php echo __('Contact'); ?></th>
                        <th><?php echo __('Payment'); ?></th>
                        <th><?php echo __('Collection'); ?></th>
                        <th><?php echo __('Balance'); ?></th>
                        <th><?php echo __('Payment Date'); ?></th>
                        <th><?php echo __('Closed Date'); ?></th>
                        <?php if($this->Session->read('User.User.id')==1){?>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                        <?php }?>
                    </tr>
                    <?php
                    if (empty($rotations)) {
                        echo $this->Html->tag('tr', $this->Html->tag('td colspan = "8"', __('No records found')));
                    } else {
                        foreach ($rotations as $rotation):
                            ?>
                    <tr> 
                        <td><?php echo __($rotation['Rotation']['customer_name']); ?></td>
                        <td><?php echo __($rotation['Rotation']['contact']); ?></td>
                        <td>Rs <?php echo __($rotation['Rotation']['payment_amount']); ?></td>
                        <td>Rs <?php echo __($rotation['Rotation']['collection_amount']); ?></td>
                        <td>Rs <?php if(!empty($rotation['Rotation']['balance_amount'])){echo __($rotation['Rotation']['balance_amount']);} else { echo "0";} ?></td>
                        <td><?php echo __($this->Time->format('M jS, Y', $rotation['Rotation']['payment_date'])); ?></td>
                        <td><?php echo __($this->Time->format('M jS, Y', $rotation['Rotation']['closed_date'])); ?></td>
                        <?php if($this->Session->read('User.User.id')==1){?>
                        <td>
                              <?php echo $this->html->link('<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>', array('action' => 'edit', $rotation['Rotation']['id']), array('class' => "btn btn-primary btn-xs", 'escape' => false)); ?> 
                        </td>
                        <?php }?>

                    </tr> 
                            <?php
                             
                        endforeach;
                    }
                     
                    ?>
                    <tr>
                        <td><b>Payment</b></td>
                        <td><b>Rs <?php echo $payment_amount;?></b></td>
                        <td><b>Collection</b></td>
                        <td><b>Rs <?php echo $collection_amount;?></b></td>
                        <td><b>Balance</b></td>
                        <td colspan="3"><b>Rs <?php echo $balance_amount;?></b></td>
                    </tr>
                </table>
                <?php echo $this->element('admin/pagination'); ?>
            </div>
        </div>
    </div>
</div>