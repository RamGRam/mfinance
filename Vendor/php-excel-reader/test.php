<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Read Files</title>


        <!--script type='text/javascript' src='http://192.168.0.58/avathar_vstore_live/manager/combine_scripts.php?type=js&page_path=manager&files=jquery.tools.js,jquery.validations.js,jquery.highlightfade.js,jscolor.js,drupal.js,jquery.prompt.js,jquery.autocomplete.js,function_common.js,numeric.js,rupee.js'></script-->
        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/jquery.tools.js"></script>

        <!--
         Here we are using compressed version of jquery, tab, autocomplete and highlight functionality
         above file contents are placed in a single file(jquery.js)
        -->

        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/jquery.validations.js"></script>
        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/jquery.highlightfade.js"></script>
        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/jscolor.js"></script>
        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/drupal.js"></script>
        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/jquery.prompt.js"></script>
        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/jquery.autocomplete.js"></script>

        <!-- Commented on 21Apr12 -->
        <!--script type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/libs/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/jquery_scroll.js"></script-->
        <!--script type="text/javascript" src="libs/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="libs/ckfinder/ckfinder.js"></script-->


        <script type="text/javascript">
            var html_root_path = "http://192.168.0.58/avathar_vstore_live/manager/";

            function mouse_over(current_value) {
                current_value.backgroundColor = '#CEE1FB';
            }
            function mouse_out(current_value) {
                current_value.backgroundColor = '#F2F5FD';
            }

        </script>
        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/function_common.js"></script>
        <script type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/numeric.js"></script>
        <!-- Combined js 1-->
        <!--script type='text/javascript' src='http://192.168.0.58/avathar_vstore/combine_scripts.php?type=js&page_path=manager&files=jquery.validations.js,jquery.highlightfade.js,jscolor.js,drupal.js,jquery.prompt.js,jquery.autocomplete.js'></script-->
        <link href="http://192.168.0.58/avathar_vstore_live/manager/css/system.css" type=text/css rel=stylesheet>
            <link href="http://192.168.0.58/avathar_vstore_live/manager/css/admin_stylesheet.css" rel="stylesheet" type="text/css"/>
            <link href="http://192.168.0.58/avathar_vstore_live/manager/css/tabs.css" rel="stylesheet" type="text/css" />
            <link href="http://192.168.0.58/avathar_vstore_live/manager/css/footer.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="http://192.168.0.58/avathar_vstore_live/manager//css/colorbox.css" type="text/css" />
            <link rel="stylesheet" type="text/css" href="http://192.168.0.58/avathar_vstore_live/manager/css/rupee_font.css">
                <link rel="stylesheet" type="text/css" href="http://192.168.0.58/avathar_vstore_live/manager/css/category_settings.css">
                    <script src="http://192.168.0.58/avathar_vstore_live/manager/js/rupee.js" type="text/javascript"></script>
                    </head>
                    <body>
                        <div id="common-floating-message" align="center" class="header-floating" style="display:none"></div>

                        <form name="catalog_dashboard" _action="catalog_dashboard.php" method="post" enctype="multipart/form-data"  style="margin:0px;">
                            <table width="100%" cellpadding="0"  cellspacing="0">
                                <tr>
                                    <td height="8"><img src="http://192.168.0.58/avathar_vstore_live/manager/images/spacer.gif" width="1" height="1" /></td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <table width="98%" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="main_border">
                                            <tr class="table_bg_form black_bold">
                                                <td colspan="2">Catalog Dashboard Widgets</td>
                                            </tr>
                                            <tr class="black" style='background: #fff;'>

                                                <td valign="top" style="width:500px;"><b>Widgets</b>	
                                                    <div style='height:600px;overflow:auto;width:500px;'>
                                                        <ul id='sidebar_widget' class='pdt_cat_ul connectedSortable'>
                                                            <li id='newwidget_brand' class='sidebar_widget ui-state-default'><b>Brand</b></li>
                                                            <li id='newwidget_1' class='sidebar_widget ui-state-default'><b>Brand Color</b></li>
                                                            <li id='newwidget_color_id' class='sidebar_widget ui-state-default'><b>Color</b></li>
                                                            <li id='newwidget_dept_id' class='sidebar_widget ui-state-default'><b>Department</b></li>
                                                            <li id='newwidget_8' class='sidebar_widget ui-state-default'><b>Fit</b></li>
                                                            <li id='newwidget_gender_id' class='sidebar_widget ui-state-default'><b>Gender</b></li>
                                                            <li id='newwidget_3' class='sidebar_widget ui-state-default'><b>Length</b></li>
                                                            <li id='newwidget_2' class='sidebar_widget ui-state-default'><b>Material</b></li>
                                                            <li id='newwidget_6' class='sidebar_widget ui-state-default'><b>Neck</b></li>
                                                            <li id='newwidget_family_id' class='sidebar_widget ui-state-default'><b>Product Family</b></li>
                                                            <li id='newwidget_type_id' class='sidebar_widget ui-state-default'><b>Product Type</b></li>
                                                            <li id='newwidget_size_id' class='sidebar_widget ui-state-default'><b>Size</b></li>
                                                            <li id='newwidget_7' class='sidebar_widget ui-state-default'><b>Sleeve</b></li>
                                                            <li id='newwidget_5' class='sidebar_widget ui-state-default'><b>Type</b></li>
                                                            <li id='newwidget_4' class='sidebar_widget ui-state-default'><b>Visual Pattern</b></li>
                                                        </ul>                                            </div>
                                                </td>
                                                <td valign="top" style="width:500px">
                                                    <div style='height:600px;overflow:auto;width:500px;'>
                                                        <b>Categories</b>
                                                        <select name="parent_id" class="select_option1" id="parent_id_fld">
                                                            <optgroup label="MOBILE & ELECTRONICS"><option value="765">Mobile</option><option value="774">Tablet</option><option value="780">Laptops,Pc & Storage</option><option value="784">Televisions,Video & Audio</option><option value="789">Cameras</option><option value="797">Computer Hardware & Software</option><option value="805">Security & Protection</option><option value="815">Mobile Accessories</option><option value="827">Tablet Accessories</option><option value="835">Storage Devices</option><option value="840">Audio & Video Devices</option><option value="845">Camera Accessories</option><option value="853">Fans & Cooling</option><option value="862">Police & Military Supplies</option><option value="873">Other Computer Products</option><option value="886">Laptop Accessories</option><option value="902">TV Accessories</option><option value="907">Netbooks & UMPC</option><option value="916">USB Hubs</option><option value="921">Printers & Scanners</option></optgroup><optgroup label="WOMEN"><option value="29">Clothings</option><option value="30">Shoes</option><option value="31">Bags</option><option value="32">Accessories</option><option value="617">Beauty & Cosmetics</option></optgroup><optgroup label="MEN"><option value="33">Clothings</option><option value="34">Shoes</option><option value="35">Bags</option><option value="36">Accessories</option><option value="618">Beauty & Cosmetics</option><option value="735">Shorts</option></optgroup><optgroup label="BOOKS, VIDEO GAMES & MEDIA"><option value="938">Books</option><option value="956">Video Games</option><option value="969">Movies & TV</option><option value="977">Music</option></optgroup><optgroup label="KIDS, BABY & TOYS"><option value="597">Baby Safety</option><option value="607">Furniture</option><option value="632">Fashion Accessories</option><option value="645">BABY CARE</option><option value="658">Beauty & Cosmetics</option><option value="665">Baby Essentials</option><option value="669">Toys & Games</option><option value="682">Board Games</option><option value="691">Uni Sex Footwear</option><option value="697">Baby Room</option><option value="701">Games & Movies</option><option value="705">SCHOOL  STUFF</option><option value="71">Boys Apparels</option><option value="715">Books & Comics</option><option value="72">Girls Apparels</option><option value="725">Kids Accessories</option><option value="73">Boys Footwear</option><option value="74">Girls Footwear</option><option value="75">Accessories</option><option value="76">Baby Products</option></optgroup><optgroup label="SPORTS & HEALTH"><option value="1020">HEALTH & WELLNESS</option><option value="991">SPORTS & LEISURE</option></optgroup><optgroup label="FOOD & BEVERAGE"><option value="752">Fruits & Vegetables</option><option value="753">Grocery</option><option value="754">Organic Products</option><option value="755">Meat, Seafood & Poultry</option><option value="756">Sweets & Chocolate</option><option value="757">Drinking Water</option><option value="758">Instant Food</option><option value="759">Snacks</option><option value="760">Other Food & Beverages</option><option value="761">Baby Food</option><option value="762">Diary</option><option value="763">Alcoholic Beverages</option><option value="764">Hotels & Restaurant</option></optgroup><optgroup label="HOME & LIVING"><option value="1041">Home Appliances</option><option value="1062">Kitchen Appliances</option><option value="1092">Furniture</option><option value="1122">Home Décor & Festive Needs</option><option value="1139">HOME FURNISHING</option><option value="1155">Home Light & Construction</option><option value="1177">Home & Garden</option></optgroup><optgroup label="METALLURGY , AGRICULTURE & AUTOMOBILES"><option value="1199">Minerals & Metallurgy</option><option value="1200">Agriculture & Food</option><option value="1201">Automobiles</option></optgroup><optgroup label="PACKAGING, ADVERTISING & OFFICE SUPPLIES"><option value="1244">Packaging & Printing</option><option value="1245">Office & School supplies</option></optgroup>                                                </select>
                                                        <div id='list_subcategory'>
                                                            <ul class='pdt_cat_ul' id='category_sortable_765'>
                                                                <li id="cat_map_766" class="category_mapping">
                                                                    <div class="ui-state-default" style="border-width:0px 0px 1px 0px;padding:4px;">Android</div>
                                                                    <div><b>Drop widgets here</b><ul class="drop_pdt connectedSortable" id=drop_widget_766>
                                                                            <li id='newwidget_dept_id' class='sidebar_widget ui-state-default ui-state-highlight'>
                                                                                <span class='ui-icon ui-icon-circle-close pdt_remove'></span>
                                                                                <input type='hidden' name='widget[766][]' value='dept_id'/><b>Department</b>
                                                                            </li>
                                                                            
                                                                </li></ul>          
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="98%" border="0" align="center" cellpadding="5" cellspacing="0" class="main_border black" >
                                            <tr>
                                                <td valign="middle" height="32" align="center">
                                                    <input type = "hidden" value="save" name = "type">
                                                        <a href ="javascript:;" onclick="return widget_validate();"><input type="image" border="0" name="reset"  src="../layouts/default/manager/images/button/save.gif" title="Save" /></a>

                                                        <a href='javascript:void(0);' onclick="window.location.reload();"><img src="../layouts/default/manager/images/button/reset.gif" title="Reset"/></a>


                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>
                        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
                        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
                        <script type="text/javascript">
                                                            google.load("jqueryui", "1.7.2");
                        </script>


                        <script type="text/javascript">
                            function widget_validate() {
                                if ($('form.changes_made').length == 0)
                                {
                                    show_productStatus("No changes found to save!", 0);
                                    return false;
                                }
                            }
                            function load_subcategory_widget(val) {
                                jQuery('ul[id^=category_sortable_]').hide();
                                jQuery('#category_sortable_' + val).show();

                            }
                            jQuery(function () {
                                load_subcategory_widget($('#parent_id_fld').val());

                                $('#parent_id_fld').change(function () {
                                    var val = $(this).val();
                                    load_subcategory_widget(val);
                                });
                                $("#sidebar_widget").sortable({
                                    connectWith: ".connectedSortable",
                                    cursor: "move",
                                    helper: function (e, li) {
                                        this.copyHelper = li.clone().insertAfter(li);
                                        //this.copyHelper = li.siblings(".selected").clone().insertAfter(li);
                                        $(this).data('copied', false);

                                        return li.clone();
                                    },
                                    stop: function () {

                                        var copied = $(this).data('copied');
                                        if (!copied) {
                                            this.copyHelper.remove();
                                        }

                                        this.copyHelper = null;
                                    }
                                });
                                /*
                                 $("#sidebar_widget").sortable({
                                 connectWith: ".connectedSortable",
                                 cursor: "move",
                                 start: function(e, info) {
                                 info.item.siblings(".selected").appendTo(info.item);
                                 },
                                 stop: function(e, info) {
                                 info.item.after(info.item.find("li"))
                                 }
                                 });*/
                                $("ul[id^=drop_widget_]").sortable({
                                    receive: function (e, ui) {
                                        var catid = $(this).parent().find('input[name^=subcat[]]').val();
                                        var title = ui.item.attr('id');
                                        var feature_id = title.replace('newwidget_', '');

                                        var img = $(this).find('li[id="' + title + '"]');
                                        if (img.length)
                                        {
                                            img.filter(":gt(0)").remove();
                                        }
                                        if (!jQuery('form[name="catalog_dashboard"]').hasClass("changes_made"))
                                        {
                                            jQuery('form[name="catalog_dashboard"]').addClass("changes_made");
                                        }

                                        jQuery(ui.item)
                                                .addClass("ui-state-highlight").prepend('<div class="ui-icon ui-icon-circle-close pdt_remove"></div><input type="hidden" name="widget[' + catid + '][]" value="' + feature_id + '"/>');
                                        ui.sender.data('copied', true);
                                    }
                                }).disableSelection();
                                jQuery('.exist_pdt_list .pdt_remove, .new_pdt_list .pdt_remove, .sidebar_widget .pdt_remove').live('click', function () {
                                    if (!jQuery('form[name="catalog_dashboard"]').hasClass("changes_made"))
                                    {
                                        jQuery('form[name="catalog_dashboard"]').addClass("changes_made");
                                    }
                                    $(this).parent().remove();
                                });
                                jQuery(".sortable").sortable({
                                    items: ".drag",
                                    connectWith: ".sortable",
                                    revert: true,
                                    start: function (event, ui) {
                                        jQuery(ui.item).text("Drop me!");
                                    },
                                    stop: function (event, ui) {
                                        jQuery(ui.item).text("Drag me!");
                                    },
                                    receive: function (event, ui) {
                                        jQuery(ui.item)
                                                .addClass("ui-state-highlight")
                                                .after(
                                                        jQuery("<div>")
                                                        .addClass("drag")
                                                        .html("New item!")
                                                        );
                                    }
                                });
                            });
                        </script>


                        <!-- Commented on 21Apr12 -->
                        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/ui.datepicker.js"></script>
                        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/function_common_modules.js"></script>
                        <script language="JavaScript1.2" type="text/javascript" src="http://192.168.0.58/avathar_vstore_live/manager/js/jquery.colorbox-min.js"></script>

