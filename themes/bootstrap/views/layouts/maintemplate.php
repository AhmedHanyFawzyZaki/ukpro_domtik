<!DOCTYPE html>
<!--[if lt IE 7]>       <html class="no-js lt-ie9 lt-ie8 lt-ie7">   <![endif]-->
<!--[if IE 7]>          <html class="no-js lt-ie9 lt-ie8">          <![endif]-->
<!--[if IE 8]>          <html class="no-js lt-ie9">                 <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png"> 
        <meta name="description" content="<?php echo yii::app()->name; ?>">
        <?php Yii::app()->bootstrap->register(); ?>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/main.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.metisMenu.js"></script>

        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.css">


        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/morris-0.4.3.min.css">
    </head>
    <?php
    if (Yii::app()->user->getState('wide_screen') == 1) {
        $classN = "hide-sidebar";
    } else {
        $classN = '';
    }
    ?>
    <body class="<?= $classN; ?>"  >
        <!-- BEGIN WRAP -->
        <div id="wrap"> 

            <!-- BEGIN TOP BAR -->
            <div id="top"> 
                <!-- .navbar -->
                <div class="navbar navbar-inverse navbar-static-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">  
                            <a class="brand span4" href="<?php echo Yii::app()->request->baseUrl; ?>/admin">
                                <?= Yii::app()->name; ?>
                            </a> 
                            <!-- .topnav -->
                            <div class="btn-toolbar topnav">
                                <div class="btn-group"> <a id="changeSidebarPos" class="btn btn-success header_btns" rel="tooltip"
                                                           data-original-title="Show / Hide Sidebar" data-placement="bottom" onClick=""> <i class="fa fa-outdent"></i> </a> </div>
                                <!--<div class="btn-group">
                                <?php
                                /*
                                  echo CHtml::ajaxLink(
                                  "<i class='icon-resize-horizontal'></i>",
                                  Yii::app()->createUrl( 'admin/dashboard/ajaxRequest' ),
                                  array( // ajaxOptions
                                  'type' =>'POST',
                                  'beforeSend' => "function( request )
                                  {
                                  // Set up any pre-sending stuff like initializing progress indicators
                                  }",
                                  'success' => "function( data )
                                  {
                                  // handle return data
                                  //alert( data );
                                  }",
                                  'data' => array( 'val1' => '1', )
                                  ),
                                  array( //htmlOptions
                                  'href' => Yii::app()->createUrl( 'admin/dashboard/ajaxRequest' ),
                                  'class' => 'btn btn-success',
                                  'id'=>'changeSidebarPos',
                                  'data-original-title'=>'Show / Hide Sidebar',
                                  )
                                  );
                                 */
                                ?>
                     </div>-->

                                <div class="btn-group dropdown"> <a class="btn header_btns dropdown-toggle" rel="tooltip" href="#" data-original-title="Lists"
                                                                    data-placement="bottom" data-toggle="dropdown" >
                                        <li class="fa fa-list"></li>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?= Yii::app()->request->baseUrl ?>/admin/faqCat"> FAQs Categories</a> </li>
                                        <li><a href="<?= Yii::app()->request->baseUrl ?>/admin/faq"> FAQs</a> </li>
                                        <li><a href="<?= Yii::app()->request->baseUrl ?>/admin/banner"> Site Slider</a> </li>
                                    </ul>
                                </div>
                                <div class="btn-group dropdown"> <a class="btn header_btns dropdown-toggle" rel="tooltip" href="#" data-original-title="Users" data-toggle="dropdown" data-placement="bottom"> <i class="fa fa-users"></i> </a>
                                    <ul class="dropdown-menu pull-right">
                                        <?php if (Yii::app()->user->group == 5) { ?>
                                            <li><a href="<?= Yii::app()->request->baseUrl ?>/admin/User?usergroup=6"> Administrators</a> </li>
                                            <?php
                                        }
                                        ?>
                                        <li><a href="<?= Yii::app()->request->baseUrl ?>/admin/User">  users</a> </li>
                                    </ul>
                                </div>
                                <!--<div class="btn-group"> <a class="btn header_btns" data-placement="bottom" data-original-title="Logout" rel="tooltip"
                                                       href="<?php echo Yii::app()->request->baseUrl; ?>/admin/dashboard/logout"><i class="fa fa-power-off"></i></a></div>-->

                                <div class="btn-group dropdown"> <a class="btn header_btns dropdown-toggle" rel="tooltip" href="#" data-original-title="User" data-placement="bottom" data-toggle="dropdown">
                                        <i class="fa fa-user admin_icon"></i>  <?php
                                        $criteria = new CDbCriteria;
                                        $criteria->condition = 'id=:ID';
                                        $criteria->params = array(':ID' => Yii::app()->user->id);
                                        $us = User::model()->find($criteria);
                                        echo $us->username;
                                        ?> 
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo Yii::app()->baseUrl; ?>/admin/user/update/id/<?php echo Yii::app()->user->id; ?>"> Profile</a> </li>
                                        <li><a data-placement="bottom" data-original-title="Logout" rel="tooltip"
                                               href="<?php echo Yii::app()->request->baseUrl; ?>/admin/dashboard/logout"> Log Out</a> </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.navbar --> 
            </div>
            <!-- END TOP BAR --> 

            <!-- BEGIN HEADER.head -->
            <header class="head">
                <div class="search-bar">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="search-bar-inner"> <a id="menu-toggle" class="accordion-toggle btn btn-inverse visible-phone" data-toggle="collapse"
                                                              data-target=".menu"rel="tooltip" data-placement="bottom" data-original-title="Show/Hide Menu"> <i class="icon-sort"></i> </a>
                                <!--
                                <form class="main-search">
                                  <input class="input-block-level" type="text" placeholder="Live search...">
                                  <button id="searchBtn" type="submit" class="btn btn-inverse"><i class="fa fa-search"></i> </button>
                                </form>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ."main-bar -->
                <div class="main-bar">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span12"> </div>
                        </div>
                        <!-- /.row-fluid --> 
                    </div>
                    <!-- /.container-fluid --> 
                </div>
                <!-- /.main-bar --> 
            </header>
            <!-- END HEADER.head --> 

            <!-- BEGIN LEFT  -->
            <div id="left"> 
                <!-- .user-media -->

                <!--
                <div class="media user-media hidden-phone"> <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/user/update/id/<? echo yii::app()->user->id; ?>" class="user-link">
                <?php
                if (Yii::app()->user->getState('admin_image') == '') {
                    $AdminImage = 'img/user.gif';
                } else {
                    $AdminImage = 'media/members/' . Yii::app()->user->admin_image;
                }
                ?>
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?= $AdminImage ?>" alt="" class="media-object img-polaroid user-img" width="100" height="150" style="margin:0 auto"> 
                  <span class="label user-label">16</span>
                  </a>
                  <div class="media-body hidden-tablet">
                    <h5 class="media-heading"><?php echo Yii::app()->name; ?></h5>
                    <ul class="unstyled user-info">
                      <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/user/update/id/<?= Yii::app()->user->id; ?>">
<?= User::model()->findByPk(Yii::app()->user->id)->username; ?>
                        </a></li>
                      <li>Last Access : <br/>
                        <small><i class="icon-calendar"></i>
<?= Yii::app()->dateFormatter->formatDateTime(Yii::app()->user->getState('admin_last_login'), 'long', null); ?>
                        </small> </li>
                    </ul>
                  </div>
                </div>
                -->
                <!-- /.user-media --> 

                <!-- BEGIN MAIN NAVIGATION -->

                <div  class="menu">
                    <div class="unstyled accordion">
                        <?php
                        $this->widget('bootstrap.widgets.TbMenuUKPROM', array(
                            'type' => "list",
                            'items' => array(
                                array('label' => 'Main Site', 'url' => array('/home/index'), 'itemOptions' => array('class' => ''), "icon" => "fa fa-home", "parent" => ""),
                                array('label' => 'Dashboard', 'url' => array('/admin/dashboard/index'), 'itemOptions' => array('class' => Helper::active_admin('dashboard')),
                                    "icon" => "fa fa-tachometer", "parent" => ""),
                                /*
                                  array('label'=>'Static Page', 'url'=>array('/admin/pages'),'itemOptions'=>array('class' => Helper::active_admin('pages')) ,



                                  "icon"=>"fa fa-file-text-o" , "parent"=>""),

                                 */
                                array('label' => 'List', "parent" => "", 'url' => '#',
                                    "itemOptions" => array('class' => Helper::active_admin(array('faq', 'faqCat', 'Countries', 'Banner'))),
                                    "icon" => "fa fa-list", 'linkOptions' => array("data-toggle" => "collapse", "data-target" => "#subnav1", 'class' => ''),
                                    'items' => array(
                                        array('label' => 'FAQs Categories', 'url' => array('/admin/faqCat'), "icon" => "fa fa-globe"),
                                        array('label' => 'FAQs', 'url' => array('/admin/faq'), "icon" => "fa fa-globe"),
                                        array('label' => 'Site Slider', 'url' => array('/admin/Banner'), "icon" => "fa fa-globe"),
                                        array('label' => 'sponsor', 'url' => array('/admin/sponsor'), "icon" => "fa fa-globe"),
                                        array('label' => 'Colors', 'url' => array('/admin/colors'), "icon" => "fa fa-globe"),
                                        array('label' => 'Sizes', 'url' => array('/admin/sizes'), "icon" => "fa fa-globe"),
                                        array('label' => 'Manage category Advertisement', 'url' => array('/admin/ads'), "icon" => "fa fa-globe"),
                                        array('label' => 'Manage Brands', 'url' => array('/admin/brand'), "icon" => "fa fa-globe"),
                                    ), 'itemOptions' => array('class' => ''), 'visible' => User::CheckAdmin()),
                                array('label' => 'Categories', "icon" => "fa fa-list", "parent" => "", 'linkOptions' => array("data-toggle" => "collapse",
                                        "data-target" => "#subnav2", 'class' => ''), 'url' => '#',
                                    'items' => array(
                                        array('label' => 'web Site Category', 'url' => array('/admin/Category'), "icon" => "fa fa-list"),
                                        array('label' => 'Product Category ', 'url' => array('/admin/ProductCategory'), "icon" => "fa fa-list"),
                                        array('label' => 'Sub Category', 'url' => array('/admin/SubCategory'), "icon" => "fa fa-list"),
                                    ),
                                    'itemOptions' => array('class' => 'main-site-link3'), 'visible' => User::CheckAdmin()),
//                                 array('label' => 'Product', 'url' => array('/admin/Product'), 'itemOptions' => array('class' => Helper::active_admin('errormessage')),
//                                            "icon" => "fa fa-list", "parent" => ""),
                                array('label' => 'Countries', "icon" => "fa fa-list", "parent" => "", 'linkOptions' => array("data-toggle" => "collapse",
                                        "data-target" => "#subnav3", 'class' => ''), 'url' => '#',
                                    'items' => array(
                                        array('label' => 'Country', 'url' => array('/admin/Country'), "icon" => "fa fa-list"),
                                        array('label' => 'City ', 'url' => array('/admin/City'), "icon" => "fa fa-list"),
                                    ),
                                    'itemOptions' => array('class' => 'main-site-link3'), 'visible' => User::CheckAdmin()),
                                array('label' => 'Motors', "icon" => "fa fa-list", "parent" => "", 'linkOptions' => array("data-toggle" => "collapse",
                                        "data-target" => "#subnav4", 'class' => ''), 'url' => '#',
                                    'items' => array(
                                        array('label' => 'Manufacure', 'url' => array('/admin/Make'), "icon" => "fa fa-list"),
                                        array('label' => 'Model ', 'url' => array('/admin/MotorModel'), "icon" => "fa fa-list"),
                                        array('label' => 'Gas', 'url' => array('/admin/Gas'), "icon" => "fa fa-list"),
                                        array('label' => 'Door ', 'url' => array('/admin/Door'), "icon" => "fa fa-list"),
                                        array('label' => 'Kmage', 'url' => array('/admin/Kmage'), "icon" => "fa fa-list"),
                                        array('label' => 'Age ', 'url' => array('/admin/Age'), "icon" => "fa fa-list"),
                                        array('label' => 'Emission', 'url' => array('/admin/Emission'), "icon" => "fa fa-list"),
                                        array('label' => 'Engine ', 'url' => array('/admin/Engine'), "icon" => "fa fa-list"),
                                    ),
                                    'itemOptions' => array('class' => 'main-site-link3'), 'visible' => User::CheckAdmin()),
                                array('label' => 'Home Decor', "icon" => "fa fa-list", "parent" => "", 'linkOptions' => array("data-toggle" => "collapse",
                                        "data-target" => "#subnav5", 'class' => ''), 'url' => '#',
                                    'items' => array(
                                        array('label' => 'Decor Style', 'url' => array('/admin/decorStyle'), "icon" => "fa fa-list"),
                                        array('label' => 'Decor Type ', 'url' => array('/admin/decorType'), "icon" => "fa fa-list"),
                                    ),
                                    'itemOptions' => array('class' => 'main-site-link3'), 'visible' => User::CheckAdmin()),
                                array('label' => 'Payments', "icon" => "fa fa-list", "parent" => "", 'linkOptions' => array("data-toggle" => "collapse",
                                        "data-target" => "#subnav6", 'class' => ''), 'url' => '#',
                                    'items' => array(
                                        array('label' => 'Fee Packages', 'url' => array('/admin/FeePackage'), "icon" => "fa fa-list"),
                                        array('label' => 'Website Commission', 'url' => array('/admin/commission'), "icon" => "fa fa-list"),
                                        array('label' => 'Shipping Values', 'url' => array('/admin/ShippingValue'), "icon" => "fa fa-list"),
                                       // array('label' => 'Order Status', 'url' => array('/admin/OrderStatus'), "icon" => "fa fa-list"),
                                        array('label' => 'Orders', 'url' => array('/admin/Order'), "icon" => "fa fa-list"),
                                    ),
                                    'itemOptions' => array('class' => 'main-site-link3'), 'visible' => User::CheckAdmin()),
//                                array('label' => 'Product Details', 'url' => array('/admin/ProductDetails'), 'itemOptions' => array('class' => Helper::active_admin('errormessage')),
//                                            "icon" => "fa fa-list", "parent" => ""),
                                array('label' => 'Reviews', 'url' => array('/admin/review'), 'itemOptions' => array('class' => Helper::active_admin('errormessage')),
                                    "icon" => "fa fa-list", "parent" => ""),
//                                array('label' => 'Favourite', 'url' => array('/admin/favourite'), 'itemOptions' => array('class' => Helper::active_admin('errormessage')),
//                                            "icon" => "fa fa-list", "parent" => "", 'visible' => User::CheckAdmin()),
                                array('label' => 'Users', "icon" => "fa fa-user", "parent" => "", 'linkOptions' => array("data-toggle" => "collapse",
                                        "data-target" => "#subnav7", 'class' => ''), 'url' => '#',
                                    'items' => array(
                                        array('label' => 'Users', 'url' => array('/admin/user?usergroup=1'), "icon" => "fa fa-user"),
//                                  //array('label'=>'Newsletter ', 'url'=>array('/admin/newsletterMessage')  ,"icon"=>"fa fa-user" ),
                                    ),
                                    'itemOptions' => array('class' => 'main-site-link3'), 'visible' => User::CheckAdmin()),
                                
                                array('label' => 'Static Page', "parent" => "", 'url' => '#',
                                    "itemOptions" => array('class' => Helper::active_admin(array('faq', 'faqCat', 'Countries', 'Banner'))),
                                    "icon" => "fa fa-list", 'linkOptions' => array("data-toggle" => "collapse", "data-target" => "#subnav8", 'class' => ''),
                                    'items' => array(
                                        array('label' => 'Pages Cats', 'url' => array('/admin/pageCat'), "icon" => "fa fa-globe"),
                                        array('label' => 'Static Pages', 'url' => array('/admin/pages'), "icon" => "fa fa-globe"),
                                        array('label' => 'error page', 'url' => array('/admin/errormessage'), "icon" => "fa fa-globe"),
                                    ), 'itemOptions' => array('class' => ''), 'visible' => User::CheckAdmin()),
                                
                                array('label' => 'Reports', "parent" => "", 'url' => '#',
                                    "itemOptions" => array('class' => Helper::active_admin(array('faq', 'faqCat', 'Countries', 'Banner'))),
                                    "icon" => "fa fa-list", 'linkOptions' => array("data-toggle" => "collapse", "data-target" => "#subnav91", 'class' => ''),
                                    'items' => array(
                                        array('label' => 'The most selling products', 'url' => array('/admin/dashboard/productreport'), "icon" => "fa fa-bar-chart-o"),
                                        array('label' => 'The most buying users', 'url' => array('/admin/dashboard/buyerreport'), "icon" => "fa fa-bar-chart-o"),
                                        array('label' => 'The non buying users', 'url' => array('/admin/dashboard/buyerreport/not_buy/1'), "icon" => "fa fa-bar-chart-o"),
                                    ), 'itemOptions' => array('class' => ''), 'visible' => User::CheckAdmin()),
                                
                                array('label' => 'Settings', "parent" => "", 'url' => '#',
                                    "itemOptions" => array('class' => Helper::active_admin(array('settings', 'settings/report'))),
                                    "icon" => "fa fa-cogs", 'linkOptions' => array("data-toggle" => "collapse", "data-target" => "#subnav9", 'class' => ''),
                                    'items' => array(
                                        array('label' => 'General Settings', 'url' => array('/admin/settings'), 'itemOptions' => array('class' => Helper::active_admin('settings')),
                                            "icon" => "fa fa-cogs", "parent" => ""),
//                                        array('label' => 'Website Reports', 'url' => array('/admin/settings/report'), 'itemOptions' => array('class' => Helper::active_admin('settings/report')),
//                                            "icon" => "fa fa-cogs", "parent" => ""),
                                    ), 'itemOptions' => array('class' => ''), 'visible' => User::CheckAdmin()),
//                                array('label' => 'Settings', "icon" => "fa fa-cogs", "parent" => "", 'url' => array('/admin/settings'),
//                                    'itemOptions' => array('class' => Helper::active_admin('settings')), 'visible' => User::CheckAdmin()),
                                /* array('label'=>'Test',"icon"=>"fa fa-cogs" ,  "parent"=>"" ,  'url'=>array('/admin/test'),
                                  'itemOptions'=>array('class' => Helper::active_admin('test')), 'visible'=>User::CheckAdmin()), */
                                array('label' => 'Logout', "parent" => "", 'url' => array('/admin/dashboard/logout'), "icon" => "fa fa-power-off"
                                    , 'itemOptions' => array('class' => ''),
                                    'visible' => User::CheckAdmin()),
                                array('label' => 'divide', "divider" => "nav-divider"),
                            ),
                        ));
                        ?>
                    </div>
                </div>

                <!-- END MAIN NAVIGATION --> 

            </div>
            <!-- END LEFT --> 

            <!-- BEGIN MAIN CONTENT --> 
            <!-- #content -->
            <div id="content"> 
                <!-- .outer -->
                <div class="container-fluid outer">
                    <div class="row-fluid"> 
                        <!-- .inner -->
                        <div class="span12 inner"> 
                            <!--Begin Datatables-->
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box dark">
                                        <header>
                                            <div class="icons"><i class="fa fa-tachometer temp_icons"></i>
                                                <span class="page_title">Dashboard</span></div>
                        <?php
                        if (Yii::app()->controller->id == 'dashboard' and Yii::app()->controller->action->id == 'index') {
                            // load the script for graphs or anything related to the index page
                        } else {
                            echo "<h5>" . $this->pageTitlecrumbs . "</h5>";
                        }
                        ?>
<?php ?>

                                            <!-- .toolbar -->

                                            <div class="toolbar">
                                                <ul class="nav">
                                                    <li class="dropdown"> <a href="#" class="dropdown-toggle temp_icons" data-toggle="dropdown"> <i class="fa fa-th-large"></i> </a>
                                                        <ul class="dropdown-menu">
<?php
$this->beginWidget('zii.widgets.CPortlet', array(
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'items' => $this->menu,
    'htmlOptions' => array('class' => 'nav'),
));
$this->endWidget();
?>
                                                            <!-- <li><a href="Accounts-create.html">Create Account</a></li>
                                                                                      <li><a href="Accounts.html">View Accounts</a></li>
                                                                                      <li><a href="Accounts.html">View Account Reports</a></li>
                                                                                      <li><a href="Accounts-import.html">Import Accounts</a></li> -->
                                                        </ul>
                                                    </li>
                                                    <li> 
                                                        <!-- <a href="#div-1" data-toggle="collapse" class="accordion-toggle minimize-box">
                                                                                 <i class="icon-chevron-up"></i>
                                                                                 </a> --> 
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.toolbar --> 

                                        </header>
                                        <div id="collapse4" class="body"> <?php echo $content; ?> </div>
                                    </div>
                                </div>
                                <!--End Datatables--> 
                            </div>
                            <!-- /.row-fluid --> 
                        </div>
                        <!-- /.outer --> 
                    </div>
                    <!-- /#content --> 
                    <!-- #push do not remove -->
                    <div id="push"></div>
                    <!-- /#push --> 
                </div>
            </div>
            <!-- END CONTENT --> 

        </div>

        <!-- END WRAP --> 

        <!-- BEGIN FOOTER -->
        <div id="footer">
            <p><?php echo date('Y'); ?> &copy; Uk Pro.Solutions LTD</p>
        </div>
        <!-- END FOOTER -->

        <script>
            $(".collapse").collapse('hide')
        </script>
        <script>
            $("document").ready(function() {
                $("#changeSidebarPos").click(function() {
                    $.ajax({
                        url: "<?php echo Yii::app()->createUrl('admin/dashboard/ajaxRequest'); ?>",
                        success: function() {
                        }
                    });
                });
            });
        </script>
        
        
        
        
        
 <!-- Join Modal -->
                <div class="modal popup fade" id="xml-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Xml</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/fetchFromMyXml/flag/admin" ?>" enctype='multipart/form-data'>

     <?php 

$cats = Category::model()->findAll();
?>
     <select class="form-control" name="category" required>
         <option value="">select Category</option>
         <?php
foreach ($cats as $cat){
    ?>
         <option value="<?php echo $cat->id; ?>"> <?php echo $cat->title; ?></option>
         <?php
}
         ?>
     </select>
            <input type="file" name="xmlfile" class="filename" required />
            <input type="submit" value="upload" name="upload" class="form-submit"/>
                            </form>
      
      <a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadXml" ?>">Download Xml Guide</a>

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->


                
                
                
 <!-- Join Modal -->
                <div class="modal popup-e fade" id="excel-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Excel</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/fetchFromExcel/flag/admin" ?>" enctype='multipart/form-data'>

            <input type="file" name="excelfile" class="filename" required />
            <input type="submit" value="upload" name="uploadexcel" class="form-submit"/>
                            </form>
      
      <a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadExcel" ?>">Download Excel Guide</a>

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
                
                   
              <!-- Join Modal -->
                <div class="modal popup-e fade" id="csv-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Csv Or Excel</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/fetchFromMyCsv/flag/admin" ?>" enctype='multipart/form-data'>

            <input type="file" name="csvfile" class="filename" required />
            <input type="submit" value="upload" name="uploadecsv" class="form-submit"/>
                            </form>
      
      <a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadCsv" ?>">Download Csv Guide</a>

      <a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadExcel" ?>">Download Excel Guide</a>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->   
                
             
        
        
        
       <!-- Join Modal -->
                <div class="modal popup fade" id="amazon-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Amazon</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/testAmazon/flag/admin" ?>" enctype='multipart/form-data'>
<div class="form-group">
     <input type="text"  name="search_value" placeholder="Search" class="form-control"/>
</div>
     
     <div class="form-group">
     <select id="category" name="category" class="form-control">
      <option value="Blended">ALL</option>
      <option value="Books">Books</option>
      <option value="DVD">DVD</option>
      <option value="Apparel">Apparel</option>
      <option value="Automotive">Automotive</option>
      <option value="Electronics">Electronics</option>
      <option value="GourmetFood">GourmetFood</option>
      <option value="Kitchen">Kitchen</option>
      <option value="Music">Music</option>
      <option value="PCHardware">PCHardware</option>
      <option value="PetSupplies">PetSupplies</option>
      <option value="Software">Software</option>
      <option value="SoftwareVideoGames">SoftwareVideoGames</option>
      <option value="SportingGoods">SportingGoods</option>
      <option value="Tools">Tools</option>
      <option value="Toys">Toys</option>
      <option value="VHS">VHS</option>
      <option value="VideoGames">VideoGames</option>
    </select>
     </div>
    
     <div class="form-group">
     <select id="country" name="country" class="form-control">
      <option value="de">DE</option>
      <option value="com">USA</option>
      <option value="co.uk">ENG</option>
      <option value="ca">CA</option>
      <option value="fr">FR</option>
      <option value="co.jp">JP</option>
      <option value="it">IT</option>
      <option value="cn">CN</option>
      <option value="es">ES</option>
    </select>
     </div>
     
     
<!--     <div class="form-group">
     <input type="text" name="browse_search" class="form-control"  placeholder="Browse Search"/>
</div>            -->
<!--<input type="file" name="xmlfile" class="filename" required />-->
            <input type="submit" value="search" name="upload" class="form-submit"/>
                            </form>
      
      <!--<a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadXml" ?>">Download Xml Guide</a>-->

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
          
                
                
       <!-- Join Modal -->
                <div class="modal popup fade" id="affiliate-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">affiliate window</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/affiliateWindow/flag/admin" ?>" enctype='multipart/form-data'>
<div class="form-group">
     <input type="text"  name="search_value" placeholder="Search" class="form-control"/>
</div>
     

     
<!--     <div class="form-group">
     <input type="text" name="browse_search" class="form-control"  placeholder="Browse Search"/>
</div>            -->
<!--<input type="file" name="xmlfile" class="filename" required />-->
            <input type="submit" value="search" name="upload" class="form-submit"/>
                            </form>
      
      <!--<a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadXml" ?>">Download Xml Guide</a>-->

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
                
                
                
                
       <!-- Join Modal -->
                <div class="modal popup fade" id="comm-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Commission Junction</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/junction/flag/admin" ?>" enctype='multipart/form-data'>
<div class="form-group">
     <input type="text"  name="search_value" placeholder="Search" class="form-control"/>
</div>
   
     
 
<!--     <div class="form-group">
     <select id="country" name="country" class="form-control">
      <option value="de">ar</option>
      <option value="com">bn</option>
      <option value="co.uk">zh</option>
      <option value="ca">cs</option>
      <option value="fr">da</option>
      <option value="co.jp">nl</option>
      <option value="it">en</option>
      <option value="cn">fi</option>
      <option value="es">fr</option>
      <option value="es">de</option>
      
      <option value="de">el</option>
      <option value="com">bn</option>
      <option value="co.uk">zh</option>
      <option value="ca">cs</option>
      <option value="fr">da</option>
      <option value="co.jp">nl</option>
      <option value="it">en</option>
      <option value="cn">fi</option>
      <option value="es">fr</option>
      <option value="es">de</option>
      
    </select>
     </div>-->
     
     
<!--     <div class="form-group">
     <input type="text" name="browse_search" class="form-control"  placeholder="Browse Search"/>
</div>            -->
<!--<input type="file" name="xmlfile" class="filename" required />-->
            <input type="submit" value="search" name="upload" class="form-submit"/>
                            </form>
      
      <!--<a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadXml" ?>">Download Xml Guide</a>-->

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
          
     
                

                
                
                 <!-- Join Modal -->
                <div class="modal popup fade" id="trade-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Trade Doubler</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/tradeDoubler" ?>" enctype='multipart/form-data'>
<div class="form-group">
     <input type="text"  name="search_value" placeholder="Search" class="form-control"/>
</div>
     
     <div class="form-group">
     <select id="category" name="tdCategoryId" class="form-control">
    <option value="">ALL</option>
    <?php foreach ($trade_cats as $trade_cat){
        ?>
      <option value="<?php echo $trade_cat['id'] ?>"><?php echo $trade_cat['name'] ?></option>
    
    <?php
    } ?>
      
    </select>
     </div>
     
  
     
    
   <!--   <div class="form-group">
     <select id="country" name="country" class="form-control">
     <option value="de">DE</option>
      <option value="com">USA</option>
      <option value="co.uk">ENG</option>
      <option value="ca">CA</option>
      <option value="fr">FR</option>
      <option value="co.jp">JP</option>
      <option value="it">IT</option>
      <option value="cn">CN</option>
      <option value="es">ES</option>
    </select>
     </div>-->
     
     
<!--     <div class="form-group">
     <input type="text" name="browse_search" class="form-control"  placeholder="Browse Search"/>
</div>            -->
<!--<input type="file" name="xmlfile" class="filename" required />-->
            <input type="submit" value="search" name="upload" class="form-submit"/>
                            </form>
      

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
          
                
                
                
                
                
                
                 <!-- Join Modal -->
                <div class="modal popup fade" id="zanox-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Zanox</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/zanox/flag/admin" ?>" enctype='multipart/form-data'>
<div class="form-group">
     <input type="text"  name="search_value" placeholder="Search" class="form-control"/>
</div>
     
     
        
     <div class="form-group">
     <input type="text"  name="min_price" placeholder="min price" class="form-control"/>
</div>
     
     <div class="form-group">
     <input type="text"  name="max_price" placeholder="max price" class="form-control"/>
</div>
     
<!--     <div class="form-group">
     <select id="category" name="category" class="form-control">
    <option value="">ALL</option>-->
    <?php // foreach ($zanox_cats as $zanox_cat){
//        $zanox_cat = (array)$zanox_cat;
        ?>
      <!--<option value="<?php echo $zanox_cat['@id'] ?>"><?php echo $zanox_cat['$'] ?></option>-->
    
    <?php
   // } ?>
      
<!--    </select>
     </div>-->
    
   <!--   <div class="form-group">
     <select id="country" name="country" class="form-control">
     <option value="de">DE</option>
      <option value="com">USA</option>
      <option value="co.uk">ENG</option>
      <option value="ca">CA</option>
      <option value="fr">FR</option>
      <option value="co.jp">JP</option>
      <option value="it">IT</option>
      <option value="cn">CN</option>
      <option value="es">ES</option>
    </select>
     </div>-->
     
     
<!--     <div class="form-group">
     <input type="text" name="browse_search" class="form-control"  placeholder="Browse Search"/>
</div>            -->
<!--<input type="file" name="xmlfile" class="filename" required />-->
            <input type="submit" value="search" name="upload" class="form-submit"/>
                            </form>
      

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
          
                

        
        
    </body>
</html>
