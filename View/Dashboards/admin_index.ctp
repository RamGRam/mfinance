<section class="content">

    <div class="row">


        <div class="col-md-12">
            <!-- Bar chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Group Statistics</h3>
                     
                </div>
                <div class="box-body">
                    <div id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body-->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->


<?php if($this->Session->read('User.User.id')==1){?>
    <div class="box box-primary box-grid listing">
            <div class="box-header">
                <h3 class="box-title"><i class="glyphicon glyphicon-th-list"></i>  <?php echo __('Group Statistics'); ?></h3>
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <tr class="actions">
                        <th><?php echo __('Center'); ?></th>
                        <th><?php echo __('Member'); ?></th>
                        <th><?php echo __('Amount'); ?></th>
                        <th><?php echo __('Interest'); ?></th>
                        <th><?php echo __('Total Amount'); ?></th>
                        <th><?php echo __('Collection Amount'); ?></th>
                        <th><?php echo __('Balance'); ?></th>
                        <th><?php echo __('Weekly Collection'); ?></th>
                    </tr>
                   
                    <tr> 
                        <td><?php if(empty($center)){ echo "0";} else {echo __($center);} ?></td>
                        <td><?php if(empty($member)){ echo "0";} else {echo __($member);} ?></td>
                        <td>Rs <?php if(empty($dispAmount)){ echo "0";} else {echo __($dispAmount);} ?></td>
                        <td>Rs <?php if(empty($interest)){ echo "0";} else {echo __($interest);} ?></td>
                        <td>Rs <?php if(empty(($dispAmount+$interest))){ echo "0";} else {echo ($dispAmount+$interest);} ?></td>
                        <td>Rs <?php if(empty($collection)){ echo "0";} else {echo __($collection);} ?></td>
                        <td>Rs <?php if(empty(($dispAmount+$interest)-$collection)){ echo "0";} else {echo __(($dispAmount+$interest)-$collection);} ?></td>
                        <td>Rs <?php if(empty($nextCollection)){ echo "0";} else {echo __($nextCollection);} ?></td>
                    </tr> 
                      
                </table>
                 
            </div>
        </div>
<?php }?>
</section><!-- /.content -->

<script type="text/javascript">

    $(function () {

        /*
         * Flot Interactive Chart
         * -----------------------
         */
        // We use an inline data source in the example, usually data would
        // be fetched from a server
        var data = [], totalPoints = 100;
        function getRandomData() {

            if (data.length > 0)
                data = data.slice(1);

            // Do a random walk
            while (data.length < totalPoints) {

                var prev = data.length > 0 ? data[data.length - 1] : 50,
                        y = prev + Math.random() * 10 - 5;

                if (y < 0) {
                    y = 0;
                } else if (y > 100) {
                    y = 100;
                }

                data.push(y);
            }

            // Zip the generated y values with the x values
            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]]);
            }

            return res;
        }





        /* END AREA CHART */

        /*
         * BAR CHART
         * ---------
         */

        var bar_data = {
            data: [
                <?php echo $data;?>
            ],
            color: "#3c8dbc"
        };
        $.plot("#bar-chart", [bar_data], {
            grid: {
                borderWidth: 1,
                borderColor: "#f3f3f3",
                tickColor: "#f3f3f3"
            },
            series: {
                bars: {
                    show: true,
                    barWidth: 0.5,
                    align: "center"
                }
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            }
        });
        /* END BAR CHART */



    });

    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
        return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                + label
                + "<br/>"
                + Math.round(series.percent) + "%</div>";
    }
</script>


