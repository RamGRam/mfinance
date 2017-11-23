
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
                                <td><b>Loan Id</b></td>
                                <td><?php echo $loan['Loan']['uid']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Customer</b></td>
                                <td><?php echo $loan['User']['name']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Group</b></td>
                                <td><?php echo $loan['Group']['name']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Loan Amount</b></td>
                                <td>Rs <?php echo $loan['Loan']['loan_amount']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Interest</b></td>
                                <td>Rs <?php echo $loan['Loan']['interest_amount']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Total Amount</b></td>
                                <td>Rs <?php echo ($loan['Loan']['loan_amount']+$loan['Loan']['interest_amount']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Collected Amount</b></td>
                                <td><?php if(!empty($totAmountPaid)){echo "Rs ".$totAmountPaid;} else {echo "--";} ?></td>
                            </tr>
                            <tr>
                                <td><b>Collection Week</b></td>
                                <td><?php echo  count($loan['Collection']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Balance</b></td>
                                <td>Rs <?php echo (($loan['Loan']['loan_amount']+$loan['Loan']['interest_amount'])-$totAmountPaid); ?></td>
                            </tr>
                            <tr>
                                <td><b>Balance Week</b></td>
                                <td><?php echo  $loan['Loan']['min_amt_week']-count($loan['Collection']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Created Date</b></td>
                                <td><?php echo $loan['Loan']['created']; ?></td>
                            </tr>
                        </tbody>
                    </table> 

                </div>

            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <i class="icon-calendar"></i>
                    <h3 class="panel-title">Minimum Loan Details</h3>
                </div>

                <div class="panel-body">
                    <table class=   "table table-user-information">
                        <tbody>
                            <tr>
                                <td><b>Minimum Amount</b></td>
                                <td>Rs <?php echo $loan['Loan']['min_amount']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Interest</b></td>
                                <td>Rs <?php echo $loan['Loan']['min_amt_interest']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Total Amount</b></td>
                                <td>Rs <?php echo ($loan['Loan']['min_amount']+$loan['Loan']['min_amt_interest']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Amount Per Week</b></td>
                                <td>Rs <?php echo $loan['Loan']['amt_permin_week']; ?></td>
                            </tr>
                            <tr>
                                <td><b>No Of Week</b></td>
                                <td><?php echo $loan['Loan']['min_amt_week']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Collection Amount</b></td>
                                <td><?php if(!empty($minAmountPaid)){echo "Rs ".$minAmountPaid;} else {echo "--";} ?></td>
                            </tr>
                            <tr>
                                <td><b>Collected Week</b></td>
                                <td><?php echo  count($loan['Collection']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Balance Week</b></td>
                                <td><?php echo  $loan['Loan']['min_amt_week']-count($loan['Collection']); ?></td>
                            </tr>

                        </tbody>
                    </table>  

                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <i class="icon-calendar"></i>
                    <h3 class="panel-title">Extra Loan Details</h3>
                </div>

                <div class="panel-body">

                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td><b>Extra Amount</b></td>
                                <td>Rs <?php echo $loan['Loan']['extra_amount']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Interest</b></td>
                                <td>Rs <?php echo $loan['Loan']['extra_amt_interest']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Total Amount</b></td>
                                <td>Rs <?php echo ($loan['Loan']['extra_amount']+$loan['Loan']['extra_amt_interest']); ?></td>
                            </tr>
 
                            <tr>
                                <td><b>Amount Per Week</b></td>
                                <td><?php if(empty($loan['Loan']['amt_perextra_week'])){echo "Rs 0";} else {echo "Rs ".$loan['Loan']['amt_perextra_week'];} ?></td>
                            </tr>
                            <tr>
                                <td><b>No Of Week</b></td>
                                <td><?php echo $loan['Loan']['extra_amt_week']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Collection Amount</b></td>
                                <td><?php if(!empty($extAmountPaid)){echo "Rs ".$extAmountPaid;} else {echo "--";} ?></td>
                            </tr>
                            <tr>
                                <td><b>Collected Week</b></td>
                                <td><?php if(count($loan['Collection'])<=$loan['Loan']['extra_amt_week']){ echo  count($loan['Collection']);} else{echo $loan['Loan']['extra_amt_week'];} ?></td>
                            </tr>
                            <tr>
                                <td><b>Balance Week</b></td>
                                <td><?php if(count($loan['Collection'])<=$loan['Loan']['extra_amt_week']){ echo  $loan['Loan']['extra_amt_week']-count($loan['Collection']); } else { echo "0";} ?></td>
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
