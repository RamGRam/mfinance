 
<div class="box">
    <div class="box-body">

        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <i class="icon-calendar"></i>
                    <h3 class="panel-title">Seat Details</h3>
                </div>

                <div class="panel-body">

                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td><b>Seat Id</b></td>
                                <td><?php echo $seat['Seat']['id']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Place</b></td>
                                <td><?php echo $seat['Seat']['title']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Staff</b></td>
                                <td><?php echo $seat['Staff']['name']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Customer</b></td>
                                <td><?php echo $seat['User']['name']; ?></td>
                            </tr>
                             
                            <tr>
                                <td><b>No.Of Weeks</b></td>
                                <td><?php echo $seat['Seat']['no_of_weeks']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Amount Per Week</b></td>
                                <td>Rs <?php echo  $seat['Seat']['amount_per_week']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Weeks Paid</b></td>
                                <td><?php echo  count($seat['SeatDue']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Amount Paid</b></td>
                                <td>Rs <?php echo $seat['Seat']['amount_paid']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Balance Week</b></td>
                                <td><?php echo  $seat['Seat']['no_of_weeks']-count($seat['SeatDue']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Balance Amount</b></td>
                                <td>Rs <?php echo  ($seat['Seat']['no_of_weeks']*$seat['Seat']['amount_per_week'])-$seat['Seat']['amount_paid']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Last Updated Date</b></td>
                                <td><?php echo $seat['Seat']['updated']; ?></td>
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
                <!--<?php echo $this->Html->link('<i class="fa fa-floppy-o"></i> ' . __('Edit'), array('controller' => 'garages', 'action' => 'edit', $garage['Garage']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>-->
                <!--<button class="btn btn-primary" type="reset"><i class="fa fa-wrench"></i> <?php echo __("Reset"); ?></button>-->
                <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> ' . __('Back'), array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
