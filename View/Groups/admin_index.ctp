 
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
                        echo $this->Html->tag('div', $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'label' => __('Name'))), array('class' => 'col-md-6'));
                        echo $this->Html->tag('div', $this->Form->input('center_id', array('data-placeholder'=>'Select','type' => 'text', 'class' => 'form-control center', 'label' => __('Center'))), array('class' => 'col-md-6'));
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
                        <th><?php echo __('Name'); ?></th>
                        <th><?php echo __('Center'); ?></th>
                        <th><?php echo __('First Collection Date'); ?></th>
                        <th><?php echo __('Final Collection Date'); ?></th>
                        <th><?php echo __('Next Due Date'); ?></th>
                        <th><?php echo __('Last Updated'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <?php
                    if (empty($groups)) {
                        echo $this->Html->tag('tr', $this->Html->tag('td colspan = "6"', __('No records found')));
                    } else {
                        foreach ($groups as $group):
                             
                            $loan = ClassRegistry::init('Loan')->find('list',array('fields'=>array('id'),'conditions'=>array('group_id'=>$group['Group']['id']),'recursive'=>-1));
                            $count = ClassRegistry::init('Due')->find('count',array('conditions'=>array('loan_id'=>$loan,'type'=>1),'recursive'=>-1));
                            $num = floor($count/count($loan));
                            $date = strtotime(''.date('d-m-Y',strtotime($group['Group']['first_collection_date'])).' + '.$num.' week');
                            ?>
                            <tr> 
                                <td><?php echo __($group['Group']['name']); ?></td>
                                <td><?php echo __($group['Center']['name']); ?></td>
                                <td><?php echo __($this->Time->format('M jS, Y', $group['Group']['first_collection_date'])); ?></td>
                                <td><?php echo __($this->Time->format('M jS, Y', $group['Group']['final_collection_date'])); ?></td>
                                <td><?php echo __($this->Time->format('M jS, Y', $date)); ?></td>
                                <td><?php echo __($this->Time->format('M jS, Y h:i A', $group['Group']['updated'])); ?></td>
                                <td>
                                    <?php echo $this->html->link('<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>', array('action' => 'edit', $group['Group']['id']), array('class' => "btn btn-primary btn-xs", 'escape' => false)); ?> 
                                    <?php echo $this->html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i>', array('action' => 'view', $group['Group']['id']), array('escape' => false, 'class' => "btn btn-primary btn-xs")); ?>
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