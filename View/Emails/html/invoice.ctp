<!-- Main content -->
<section style="height: 320px;;background: #fff none repeat scroll 0 0;border: 1px solid #f4f4f4;position: relative;">
    <!-- title row -->
    <div style="margin-left: -15px;margin-right: -15px; box-sizing: border-box; clear: both;">
        <div style="width: 100%;">
            <h2  style="padding:0px 14px 20px;font-size: 22px; margin: 10px 0 20px; border-bottom: 1px solid #eee;padding-bottom: 9px;">
                <i class="fa fa-globe"></i> Invoice Details
                <small style="color: #666;display: block;margin-top: 5px; float: right;">Date: <?php echo date('d/m/Y'); ?></small>
            </h2>
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div style="margin-left: -15px; margin-right: -15px;">
        
        <div style="float: left;min-height: 1px; padding-left: 15px;padding-right: 15px;position: relative;">
            From
            <address>
                <strong><?php echo $garage_info['Garage']['garage_name'];?></strong><br>
                <?php echo $garage_info['Garage']['address'];?><br>
                Phone: <?php echo $garage_info['Garage']['land_line_no'];?><br/>
                Email: <?php echo $garage_info['Garage']['email_id'];?>
            </address>
        </div><!-- /.col -->
        <div style="float: left;min-height: 1px; padding-left: 15px;padding-right: 15px;position: relative;">
            To
            <address>
                <strong><?php echo $customer_info['Customer']['name'];?></strong><br>
                Phone: <?php echo $customer_info['Customer']['phone_no'];?><br/>
                Email: <?php echo $customer_info['Customer']['email_id'];?>
            </address>
        </div><!-- /.col -->

        <div style="float: left;min-height: 1px; padding-left: 15px;padding-right: 15px;position: relative;">
            <b>Invoice <?php echo $invoice_no;?></b><br/>
            <br/>
            <b>Order ID:</b> <?php echo "PW".$customer_info['BreakdownRequest']['id'];?><br/>
            <b>Payment Due:</b> <?php echo date('d/m/Y'); ?><br/>
        </div><!-- /.col -->
    </div><!-- /.row -->

<?php
    $Subcost = $customer_info['BreakdownRequest']['service_cost']+$customer_info['BreakdownRequest']['visiting_cost'];
    
    $km_diff = $customer_info['BreakdownRequest']['km_difference'];
    $minimumKm = $customer_info['BreakdownRequest']['minimum_km'];
    if($km_diff>$minimumKm && !empty($minimumKm))
    {
        $remainingKm = $km_diff-$minimumKm;
        $Total = round($Subcost+($remainingKm*$customer_info['BreakdownRequest']['per_km_cost']));
    } else {
        $Total = $Subcost;
    }

    if(!empty($customer_info['BreakdownRequest']['extra_fee'])){
         $Total = $Total+$customer_info['BreakdownRequest']['extra_fee'];
    }
    
    
?>

    <div style="margin-left: -15px;margin-right: -15px; box-sizing: border-box; clear: both;">
        <!-- accepted payments column -->

        <div  style="min-height: 1px;padding-left: 15px;padding-right: 15px;position: relative; float: left;width: 50%;">
            <p style="font-size: 19px;line-height: 1.4;margin-bottom: 20px;">Billing Details</p>
            <div style="min-height: 0.01%;overflow-x: auto;">
                <table  style="text-align: left;margin-bottom: 20px; width: 100%;border-collapse: collapse; border-spacing: 0;background-color: transparent;">
                    <tr>
                        <th>Service Cost:</th>
                        <td>Rs.<?php echo $customer_info['BreakdownRequest']['service_cost']; ?></td>
                    </tr>
                    <tr>
                        <th>Visiting Cost:</th>
                        <td>Rs.<?php echo $customer_info['BreakdownRequest']['visiting_cost']; ?></td>
                    </tr>
                    <?php if(!empty($remainingKm)){?>
                        <tr>
                            <th>Price for <?php echo $remainingKm;?>km:</th>
                            <td>Rs.<?php echo round($remainingKm*$customer_info['BreakdownRequest']['per_km_cost']);?></td>
                        </tr>
                    <?php }?>
                    <?php if(!empty($customer_info['BreakdownRequest']['extra_fee'])){?>
                    <tr>
                        <th>Extra Fee:</th>
                        <td>Rs.<?php echo $customer_info['BreakdownRequest']['extra_fee']; ?></td>
                    </tr>
                    <?php }?>
                    <tr>
                        <th>Total:</th>
                        <td>Rs.<?php echo $Total;?></td>
                    </tr>
                </table>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->

 

<div style="clear: both"></div>