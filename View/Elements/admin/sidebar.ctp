<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->         
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
             
            <li class="dashboards">
                <?php
                    echo $this->Html->link('<i class="fa fa-fw fa-dashboard"></i> <span>' . __("Dashboards") . '</span>', array('controller' => 'dashboards', 'action' => 'index'), array('escape' => false, 'class' => 'sidebar-menu-title'));
                ?>
            </li> 
            <?php if($this->Session->read('User.User.id')==1){?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-fw fa-server"></i> <span>Masters</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                       <li class="centers">
                            <?php
                                echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __("Center") . '</span>', array('controller' => 'centers', 'action' => 'index'), array('escape' => false));
                            ?>
                        </li>

                    </ul>
                </li>
            <?php }?>
              
            <li class="treeview" style="clear:both;">
                <a href="#">
                    <i class="fa fa-user fa-cog"></i> <span>User Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <?php if($this->Session->read('User.User.id')==1){?>
                    <li class="groups">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __("Groups") . '</span>', array('controller' => 'groups', 'action' => 'index'), array('escape' => false));
                        ?>
                    </li>
                    <?php }?>

                   <li class="users">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __("Loan Customers") . '</span>', array('controller' => 'users', 'action' => 'index'), array('escape' => false));
                        ?>
                    </li>
                    <li class="Users">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __("Seat Customers") . '</span>', array('controller' => 'Users', 'action' => 'seat_user'), array('escape' => false));
                        ?>
                    </li>
                    <li class="staffs">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __("Staffs") . '</span>', array('controller' => 'staffs', 'action' => 'index'), array('escape' => false));
                        ?>
                    </li>
                    <li class="loans">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __("Loans") . '</span>', array('controller' => 'loans', 'action' => 'index'), array('escape' => false));
                        ?>
                    </li>
                    <li class="seats">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __("Seats") . '</span>', array('controller' => 'seats', 'action' => 'index'), array('escape' => false));
                        ?>
                    </li> 
                    <li class="dues">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __("Dues") . '</span>', array('controller' => 'dues', 'action' => 'index'), array('escape' => false));
                        ?>
                    </li>
                    <li class="seat_dues">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __("Seat Dues") . '</span>', '#', array('data-toggle'=>'modal','data-target'=>'#myModal','escape' => false));
                        ?>
                    </li>
                    <li class="rotations">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __("Rotations") . '</span>', array('controller' => 'rotations', 'action' => 'index'), array('escape' => false));
                        ?>
                    </li>  
                    
                </ul>
            </li>

            <li class="treeview" style="clear:both">
              <a href="#">
                <i class="fa fa-fw fa-server"></i> <span>Reports</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
                <ul class="treeview-menu">
                <?php if($this->Session->read('User.User.id')==1){?>
                    <li class="Groups">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __('Closed Group') . '</span>', array('controller' => 'Groups', 'action' => 'closed'), array('escape' => false));
                        ?>
                    </li>
                    <?php }?>
                    <li class="Loans">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __('Closed Loan') . '</span>', array('controller' => 'Loans', 'action' => 'closed'), array('escape' => false));
                        ?>
                    </li>
                    <li class="Seats">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __('Closed Seat') . '</span>', array('controller' => 'Seats', 'action' => 'closed'), array('escape' => false));
                        ?>
                    </li>
                    <li class="Dues">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __('Closed Dues') . '</span>', array('controller' => 'Dues', 'action' => 'closed'), array('escape' => false));
                        ?>
                    </li>
                    <li class="SeatDues">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __('Closed Seat Dues') . '</span>', array('controller' => 'SeatDues', 'action' => 'closed'), array('escape' => false));
                        ?>
                    </li>
                    <li class="Rotations">
                        <?php
                            echo $this->Html->link('<i class="fa fa-circle-o"></i> <span>' . __('Closed Rotations') . '</span>', array('controller' => 'Rotations', 'action' => 'closed'), array('escape' => false));
                        ?>
                    </li>
                </ul>
            </li>

 
  
        </ul>
    </section>
    <!-- /.sidebar -->
</aside> 

<?php
/* if($this->params['action'] == 'admin_visit_request') {
  $type_value = 'visit_request';
  }
  else if(!empty($this->params->named['type']) || !empty($this->params->query['type'])) {
  $type_value = array_key_exists('type', $this->params->named) ? $this->params->named['type'] : $type_value = $this->params->query['type'];
  }
  else {
  $type_value = $this->params['controller'];
  } */

$this->Html->scriptBlock(
        '$(".sidebar-menu li.' . $this->params['controller'] . '").addClass("active");'
        . '$(".sidebar-menu li.' . $this->params['controller'] . '").parent().parent().addClass("active");'
        , array('inline' => false)
);
?>

<button data-toggle="modal" data-target="#myModal">Open Modal</button>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter Your Password</h4>
      </div>
      <div class="modal-body">
        <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter Password"><br>
        <p id="error_message" style="color:red;"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="security()">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
    function security(){
        $('#error_message').text('Please enter the password.');
        if($('#pass').val()=='admin123'){
            window.location.href="<?php echo Router::url('/', true);?>admin/seat_dues";
        }
    }
</script>