
<div class="box">
    <div class="box-body">

        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <i class="icon-calendar"></i>
                    <h3 class="panel-title">Loan Details</h3>
                </div>

                <div class="panel-body">

                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td><b>Name</b></td>
                                <td><?php echo $user['User']['name']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Contact</b></td>
                                <td><?php echo $user['User']['contact']; ?></td>
                            </tr>
                             
                            <tr>
                                <td><b>Address</b></td>
                                <td><?php echo $user['User']['address']; ?></td>
                            </tr>
                             
                            <tr>
                                <td><b>Image</b></td>
                                <?php
                                    $img_path = Router::url('/', true) . "/files/user_profile_image/" . $user['UserProfileImage']['dir'] . '/' . $user['UserProfileImage']['attachment_name'];
                                ?>
                                <td>
                                    <?php if ($user['UserProfileImage']['attachment_name'] != '') { ?>
                                        <?php echo $this->html->link($this->html->image($img_path, array('style' => 'width:100px;')), $img_path, array('class' => 'example-image-link', 'data-lightbox' => 'example-1', 'escape' => false)); ?>
                                    <?php } ?>

                                </td>
                            </tr>

                        </tbody>
                    </table> 

                </div>

            </div>
        </div>
         
    </div>

    <div class="box-footer">
        <div class="col-xs-6">
             
        </div>
        <div class="col-xs-6">
            <div class="pull-right">
                <!--<?php echo $this->Html->link('<i class="fa fa-floppy-o"></i> ' . __('Edit'), array('controller' => 'garages', 'action' => 'edit', $garage['Garage']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?> -->
                <!--<button class="btn btn-primary" type="reset"><i class="fa fa-wrench"></i> <?php echo __("Reset"); ?></button>-->
                <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> ' . __('Back'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
