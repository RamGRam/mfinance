<?php
$profileImage = $this->Session->read('ProfileImage');
?>
<header class="main-header">
    <!-- Logo -->
     <a href="<?php echo Router::url('/admin/users');?>" class="logo">
           
          <?php echo $this->Html->image('logo.png'); ?>
        </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo $this->Html->image('/files/user_profile_image/'.str_replace('\\','/', $profileImage['dir']).'/'.$profileImage['attachment_name'], array('class' => 'img-circle user-image', 'alt' => 'User Image'));?>
                        <span class="hidden-xs"><?php echo __($this->Session->read('Auth.User.name'));?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php echo $this->Html->image('/files/user_profile_image/'.str_replace('\\','/', $profileImage['dir']).'/'.$profileImage['attachment_name'], array('class' => 'img-circle', 'alt' => 'User Image')); ?>
                            <p>
                                <?php echo __($this->Session->read('Auth.User.name'));?>
                                <small><?php echo __($this->Session->read('Auth.User.group_title'))?></small>
                            </p>
                        </li>  
                        <!-- Menu Body -->
                        <li class="user-body">                                        
                            <div class="col-xs-12 text-center">
                                <?php echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'change_password/'.$this->Session->read('Auth.User.id')));?></a>
                            </div>                                        
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?php echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'profile',$this->Session->read('Auth.User.id'),$this->Session->read('Auth.User.user_type_id')), array('class' => 'btn btn-default btn-flat'));?>
                            </div>
                            <div class="pull-right">
                                <?php echo $this->Html->link('Sign out', array('controller'=>'users', 'action'=>'logout'), array('class' => 'btn btn-default btn-flat'));?>
                            </div>
                        </li>
                    </ul>
                </li>   
                <?php if($this->Session->read('Auth.User.group_id') == 0) : ?>
                <li>
                    <?php //echo $this->Html->link('<i class="fa fa-gears"></i>',array('controller' => 'settings','action' => 'edit', 1), array('escape' => false));?>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>