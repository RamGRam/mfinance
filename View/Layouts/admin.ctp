<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            <?php echo $this->fetch('title'); ?>
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        echo $this->Html->meta('favicon.ico','img/favicon.ico',array('type' => 'icon'));
        echo $this->Html->css(array(
            'googleapis',
            'bootstrap.min',
            'font-awesome.min',
            'select2.min',
            'select2-bootstrap.min',
            'bootstrap-duallistbox.min',
        ));

        
         
        
        echo $this->Minify->css(array(
            'AdminLTE.min',
            'skins/_all-skins.min',
            'AdminLTE-additional',
            'pitkrew',
            'datepicker/datepicker3',
            'daterangepicker-bs3'
        ));
        
        echo $this->Html->script('jquery-1.10.2.min');     
        echo $scripts_for_layout;
        echo $this->Js->writeBuffer();
        
         
        ?>
    <style>
        .table th, .table td { 
            border-top: none !important;
            border-left: none !important;
        }


       .radio
       {
           float: left;
           margin-top: 0px;
           width: 50px;
       }
       .checkbox + .checkbox, .radio + .radio {
            margin-top: 0px;
        }
        .input
        {
            width: 100px;
        }


        .nav-tabs-custom > .nav-tabs > li {
             margin-right: 0px;
        }
    </style>
    </head>
    <body class="hold-transition skin-red sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <?php echo $this->element('admin/header'); ?>

            <!-- =============================================== -->
            <?php echo $this->element('admin/sidebar'); ?>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?php echo $this->element('admin/content_header'); ?>

                <!-- Main content -->
                <section class="content">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <?php 
            echo $this->element('admin/footer');
            echo $this->Html->scriptBlock('var web_root="' . $this->Html->url('/') . '";');
            ?>


        </div><!-- ./wrapper -->

        <?php
         
        
         echo $this->Html->script(array(
            'jquery.min',
            'jquery-ui.min',
            'bootstrap.min',
            'select2.min',
            'moment.min',
            'bootstrap-datetimepicker.min',
            'scripts',
            'pitkrew'
        ));
         
        if(($this->request->params['controller']=='dashboards') && $this->request->params['action']=='admin_index'){
           echo $this->Html->Script('datepicker/jQuery-2.1.4.min');
        }
         
          
        echo $this->Html->script(array(
            'chart/jquery.flot.min',
            'chart/jquery.flot.resize.min',
            'chart/jquery.flot.pie.min',
            'chart/jquery.flot.categories.min',
        ));
     
        
        
         echo $this->Html->Script(array(
            'datepicker/input-mask/jquery.inputmask',
            'datepicker/input-mask/jquery.inputmask.date.extensions',
            'datepicker/input-mask/jquery.inputmask.extensions',
            //'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
            'datepicker/daterangepicker',
            'https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js'
        ));
        
 
        
         
        echo $this->fetch('script');
        echo $this->Minify->script(array(
            'AdminLTE.min',
            'select2.min',
            'jquery.bootstrap-duallistbox.min'
            
        ));
        
        
        //bootsrap form-validation
        echo $this->html->script('form-validation/formValidation');
        echo $this->html->script('form-validation/bootstrap');
         
        ?>

</html>