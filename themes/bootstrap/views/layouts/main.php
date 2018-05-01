<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="description" content="<?php echo CHtml::encode($this->pageTitle); ?>">
<meta name="author" content="Ukprosolutions">
<?php Yii::app()->bootstrap->register(); ?>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>-->
<?php  if( Yii::app()->controller->id =='dashboard' and Yii::app()->controller->action->id=='index')
    {
	  // load the script for graphs or anything related to the index page
	 
    }
   ?>
</head>
<body class="main-site">

<div id="myModal" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Delete</h3>
    </div>
    <div class="modal-body">
        <p>You are about to delete.</p>
        <p>Do you want to proceed?</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn danger">Yes</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    </div>
</div>



<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
     <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse"> <i class="fa fa-th-large"></i> </a>
     <a class="btn btn-navbar" data-toggle="collapse" data-target=".sidebar"> <span class="fa fa-th-list"></span> </a>
     <a class="brand" href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard"> <?= Yii::app()->name ;?></a>
      <div class="nav-collapse collapse navbar-responsive-collapse">
        <ul class="nav pull-right top-nav">
          <li class="dropdown ">
          <a data-toggle="dropdown" class="dropdown-toggle dropdown-avatar" href="#">
             <i class="icon-user icon-white"></i>&nbsp;<?= Yii::app()->user->id; ?> <b class="caret"></b>
          </a>
            <ul class="dropdown-menu ">
              <!-- the first element is the one with the big avatar, add a with-image class to it -->
              <!-- <li><a href="<?php //echo Yii::app()->request->baseUrl; ?>/user"><i class="icon-user"></i><span><?php // Yii::app()->user->username?></span></a></li>
              <li class="divider"></li> -->
              <li><a href="<?php //echo Yii::app()->request->baseUrl; ?>/user/update/<?= Yii::app()->user->id?>"><i class="icon-user"></i><span>Profile</span></a></li>
              <li><a href="<?php //echo Yii::app()->request->baseUrl; ?>/settings"><i class="icon-cog"></i> <span>Settings</span></a></li>
              <!-- <li><a href="#"><i class="icon-envelope"></i> <span>Messages</span> <span class="badge badge-important">5</span></a></li> -->
              <li><a href="<?php //echo Yii::app()->request->baseUrl; ?>/dashboard/logout"><i class="icon-off"></i> <span>Logout</span></a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.nav-collapse -->
    </div>
  </div>
  <!-- /navbar-inner -->
</div>
<div class="row-fluid">
  <div class="span2 side-menu">
    <div class="nav-collapse collapse sidebar">
       
      <?php
     $this->widget('bootstrap.widgets.TbMenuUKPRO',array(
     'type'=>"list",
     'items'=>array(
       array('label'=>'Main Site', 'url'=>array('/home/index'),'itemOptions'=>array('class' => '') , "icon"=>"fa fa-home" ,"parent"=>""),
       array('label'=>'Dashboard', 'url'=>array('/dashboard/index'),'itemOptions'=>array('class' => Helper::active_admin('dashboard') ) ,
	   "icon"=>"fa fa-tachometer" , "parent"=>""),
       array('label'=>'List',   "parent"=>"" , 'url'=>'#',
	          "itemOptions"=>array('class'=>  Helper::active_admin(array('faq' , 'faqCat' , 'Countries' , 'Banner'))), 
	          "icon"=>"fa fa-list"  ,'linkOptions'=> array("data-toggle"=>"collapse" , "data-target"=>"#subnav6" , 'class' =>'' ), 
			 'items'=>array(
					array('label'=>'FAQs Categories', 'url'=>array('/faqCat') ,"icon"=>"fa fa-globe"),
					array('label'=>'FAQs', 'url'=>array('/faq') ,"icon"=>"fa fa-globe") ,
					array('label'=>'Countries', 'url'=>array('/Countries') ,"icon"=>"fa fa-globe"),
					array('label'=>'Site Slider', 'url'=>array('/Banner') ,"icon"=>"fa fa-globe"),
				  ), 'itemOptions'=>array('class' => ''), 'visible'=>User::CheckAdmin() ),
				  
			  
       array('label'=>'Static Page', 'url'=>array('/pages'),'itemOptions'=>array('class' => Helper::active_admin('pages')) ,
                                 "icon"=>"fa fa-leaf" , "parent"=>""),
       array('label'=>'Buying & Selling',   "parent"=>"" , "icon"=>"fa fa-shopping-cart",  'linkOptions'=> array("data-toggle"=>"collapse" , 		              "data-target"=>"#subnav7" , 'class' => ''), 'url'=>array('#'),
	          'items'=>array(
						array('label'=>'Categories', 'url'=>array('/category') ,"icon"=>"fa fa-bar-chart-o"),
						array('label'=>'Products', 'url'=>array('/product') ,"icon"=>"fa fa-bar-chart-o" ),
                       ),
              'itemOptions'=>array('class' => 'main-site-link1'), 'visible'=>User::CheckAdmin() ),
			  
         array('label'=>'Users',"icon"=>"fa fa-user" ,   "parent"=>"" ,'linkOptions'=> array("data-toggle"=>"collapse" ,
				 "data-target"=>"#subnav8" , 'class' => '') ,  'url'=>'#',
				 'items'=>array(
              	  	            array('label'=>'Users', 'url'=>array('/user') , "icon"=>"fa fa-user" ),
              	     		   array('label'=>'Newsletter ', 'url'=>array('/newsletterMessage')  ,"icon"=>"fa fa-user" ),
                               ),
				  'itemOptions'=>array('class' => 'main-site-link3'), 'visible'=>User::CheckAdmin() ),
				  
        array('label'=>'Settings',"icon"=>"fa fa-cogs" ,   "parent"=>"" ,    'url'=>array('/settings'),
		        'itemOptions'=>array('class' => Helper::active_admin('settings')), 'visible'=>User::CheckAdmin()),
				
     	array('label'=>'Test',"icon"=>"fa fa-cogs" ,  "parent"=>"" ,  'url'=>array('/test'),
		       'itemOptions'=>array('class' => Helper::active_admin('test')), 'visible'=>User::CheckAdmin()),
			   
         array('label'=>'Logout',   "parent"=>"" ,  'url'=>array('/dashboard/logout') ,"icon"=>"fa fa-power-off"
              		,'itemOptions'=>array('class' => ''),
              		'visible'=>User::CheckAdmin()),
              		array('label'=>'divide',"divider"=>"nav-divider"),
      		  ),
     ));
     ?>
      
      
      
      
    </div>
  </div>
  <!-- breadcrumbs -->
  <div class="span10 content">
    <div id="content">
      <div class="page-head row-fluid">
        <div class="span7">
          <h3 class="title"><i class="fa fa-dashboard"></i>Dashboard</h3>
        </div>
        <div class="span5">
          <?php
					$this->beginWidget('zii.widgets.CPortlet', array(
					));
					$this->widget('bootstrap.widgets.TbMenu', array(
						'items'=>$this->menu,
						'htmlOptions'=>array('class'=>'nav-pills pull-right'),
					));
					$this->endWidget();
					?>
        </div>
      </div>
      <div class="page-cont">
        <div class="row-fluid">
          <?php if(isset($this->breadcrumbs)):?>
          <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
          <?php endif?>
        </div>
        <div class="row-fluid"> <?php echo $content; ?> </div>
        <footer> <span> Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.ukprosolutions.com">Ukprosolutions.com</a>,All Rights Reserved. </span> </footer>
      </div>
    </div>
  </div>
</div>
</div>
<!-- footer -->
</body>
</html>
