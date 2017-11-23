
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
                    echo $this->Html->tag('div', $this->Form->input('full_name', array('type' => 'text', 'class' => 'form-control', 'label' => __('Knowledge Center Name'))), array('class' => 'col-md-6'));
                    echo $this->Html->tag('div', $this->Form->input('email', array('type' => 'text', 'class' => 'form-control', 'label' => __('Email'))), array('class' => 'col-md-6'));
                    echo $this->Html->tag('div', $this->Form->input('contact_no', array('type' => 'text', 'class' => 'form-control', 'label' => __('Contact'))), array('class' => 'col-md-6'));
                    echo $this->Html->tag('div', $this->Form->input('is_active', array('type' => 'select', 'class' => 'form-control', 'empty' => __('All'), 'options' => array('1' => 'Active', '0' => 'Inactive'), 'label' => __('Status'))), array('class' => 'col-md-6'));
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
                        <th><?php echo __('Knowledge Center Name'); ?></th>
                        <th><?php echo __('Email ID'); ?></th>
                        <th><?php echo __('Contact'); ?></th>
                        <th><?php echo __('Last Updated'); ?></th>
                        <th class="status"><?php echo __('Status'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <?php                    
                    if (empty($kcTeams)) {
                        echo $this->Html->tag('tr', $this->Html->tag('td colspan = "4"', __('No records found')));
                    } else {
                       // echo $this->element('sql_dump');
                       foreach ($kcTeams as $kcTeam){   
                        ?>
                            <tr> 
                                <td><?php echo __($kcTeam['KcTeam']['full_name']); ?></td>
                                <td><?php echo __($kcTeam['User']['email']); ?></td>
                                <td><?php echo __($kcTeam['KcTeam']['contact_no']); ?></td>
                                <td><?php echo __($this->Time->format('F jS, Y h:i A',$kcTeam['KcTeam']['updated'])); ?></td>
                                <td><?php echo $statuses[$kcTeam['User']['active']]; ?></td>
                                <td>
                                    <?php echo $this->html->link('<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>', array('action' => 'edit', $kcTeam['KcTeam']['id']), array('class' => "btn btn-primary btn-xs", 'escape' => false)); ?> 
                                    <?php echo $this->Form->postLink('<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Delete"></i>', array('action' => 'delete', $kcTeam['KcTeam']['id']), array('confirm' => __('Do you really want to delete '.$kcTeam['KcTeam']['full_name'].'?'), 'escape' => false, 'class' => "btn btn-danger btn-xs")); ?>
                                    <?php //echo $this->html->link('<i class="glyphicon glyphicon-th"></i>', array('action' => 'agent_change_password', $kcteam['KCTeam']['id']), array('class' => "btn btn-primary btn-xs", 'escape' => false,'title'=>'Change password')); ?> 
                                </td>
                            </tr> 
                            <?php
                    }
                    }
                    ?>
                </table>
                <?php echo $this->element('admin/pagination'); ?>
            </div>
        </div>
    </div>
</div>
 
 