
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
                                <td><b>Title</b></td>
                                <td><?php echo $group['Group']['name']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Center</b></td>
                                <td><?php echo $group['Center']['name']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Disbursement Amount</b></td>
                                <td>Rs <?php echo $group['Group']['disp_amount']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Interest</b></td>
                                <td>Rs <?php echo $group['Group']['interest']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Total Amount</b></td>
                                <td>Rs <?php echo ($group['Group']['disp_amount']+$group['Group']['interest']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Collection Amount</b></td>
                                <td><?php if(!empty($totAmountPaid)){echo "Rs ".$totAmountPaid;} else {echo "--";} ?></td>
                            </tr>
                            <tr>
                                <td><b>Balance</b></td>
                                <td>Rs <?php echo (($group['Group']['disp_amount']+$group['Group']['interest'])-$totAmountPaid); ?></td>
                            </tr>
                            <tr>
                                <td><b>Maximum Loans</b></td>
                                <td><?php echo $group['Group']['no_of_members']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Loans Proceeded</b></td>
                                <td><?php echo $loanCount; ?></td>
                            </tr>
                            <tr>
                                <td><b>First Collection Date</b></td>
                                <td><?php echo $group['Group']['first_collection_date']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Final Collection Date</b></td>
                                <td><?php echo $group['Group']['final_collection_date']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Created Date</b></td>
                                <td><?php echo $group['Group']['created']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Image</b></td>
                                <?php
                                    $img_path = Router::url('/', true) . "/files/group_profile_image/" . $group['GroupProfileImage']['dir'] . '/' . $group['GroupProfileImage']['attachment_name'];
                                ?>
                                <td>
                                    <?php if ($group['GroupProfileImage']['attachment_name'] != '') { ?>
                                        <?php echo $this->html->link($this->html->image($img_path, array('style' => 'width:100px;')), $img_path, array('class' => 'example-image-link', 'data-lightbox' => 'example-1', 'escape' => false)); ?>
                                    <?php } ?>

                                </td>
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
                                <td>Rs <?php echo $group['Group']['min_amount']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Interest</b></td>
                                <td>Rs <?php echo $group['Group']['min_amt_interest']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Total Amount</b></td>
                                <td>Rs <?php echo ($group['Group']['min_amount']+$group['Group']['min_amt_interest']); ?></td>
                            </tr>
                            
                            <tr>
                                <td><b>Amount Per Week</b></td>
                                <td>Rs <?php echo $group['Group']['amt_permin_week']; ?></td>
                            </tr>
                            <tr>
                                <td><b>No Of Week</b></td>
                                <td><?php echo $group['Group']['min_amt_week']; ?></td>
                            </tr>

                            <tr>
                                <td><b>Collection Amount</b></td>
                                <td><?php if(!empty($minAmountPaid)){echo "Rs ".$minAmountPaid;} else {echo "--";} ?></td>
                            </tr>
                            <tr>
                                <td><b>Collected Week</b></td>
                                <td><?php echo $minCollectionWeek;?></td>
                            </tr>
                            <tr>
                                <td><b>Balance Week</b></td>
                                <td><?php echo ($group['Group']['min_amt_week']-$minCollectionWeek);?></td>
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
                                <td>Rs <?php echo $group['Group']['extra_amount']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Interest</b></td>
                                <td>Rs <?php echo $group['Group']['extra_amt_interest']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Total Amount</b></td>
                                <td>Rs <?php echo ($group['Group']['extra_amount']+$group['Group']['extra_amt_interest']); ?></td>
                            </tr>
 
                            <tr>
                                <td><b>Amount Per Week</b></td>
                                <td>Rs <?php if(!empty($group['Group']['amt_perextra_week'])) { echo $group['Group']['amt_perextra_week'];} else { echo "0"; } ?></td>
                            </tr>
                            <tr>
                                <td><b>No Of Week</b></td>
                                <td><?php echo $group['Group']['extra_amt_week']; ?></td>
                            </tr>

                            <tr>
                                <td><b>Collection Amount</b></td>
                                <td><?php if(!empty($extAmountPaid)){echo "Rs ".$extAmountPaid;} else {echo "--";} ?></td>
                            </tr>
                            <tr>
                                <td><b>Collected Week</b></td>
                                <td><?php echo $extraCollectionWeek;?></td>
                            </tr>
                            <tr>
                                <td><b>Balance Week</b></td>
                                <td><?php echo ($group['Group']['extra_amt_week']-$extraCollectionWeek);?></td>
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
