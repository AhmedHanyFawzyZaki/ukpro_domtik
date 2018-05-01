
<?php
    $cats=  ProductCategory::model()->findAll(array('condition'=>'category_id=9'));
    if($cats){
?>



<nav class="navbar navbar-default main-nav animated fadeInDown delay-05s" role="navigation">
 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        
        
         <?php
                            $controller=Yii::app()->controller->id;
                            foreach ($cats as $cat)
                            {
                                $subcats=  SubCategory::model()->findAll(array('condition'=>'product_category_id='.$cat->id));
                                
                                if($subcats)
                                {
                                    echo '
                                    <li class="dropdown">
                                        <a href="'.Yii::app()->request->baseUrl.'/'.$controller.'/subCategory?cat_id='.$cat->id.'" class="dropdown-toggle" >'.$cat->title.'</a>
                                        <ul class="dropdown-menu" role="menu">';
                                    foreach ($subcats as $sub)
                                    {
                                        echo '<li><a href="'.Yii::app()->request->baseUrl.'/'.$controller.'/subCategory?subcat_id='.$sub->id.'&cat_id='.$sub->product_category_id.'">'.$sub->title.'</a></li>';
                                    }
                                    echo '
                                        </ul>
                                    </li>';
                                }
                                else
                                {
                                    echo '<li><a href="'.Yii::app()->request->baseUrl.'/'.$controller.'/subCategory?cat_id='.$cat->id.'">'.$cat->title.'</a></li>';
                                }
                        ?>
                        <?php
                            }
                        ?>
        
        
<!--        
        <li class="active"><a href="#">music</a></li>
        
        
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">sports</a>
          <ul role="menu" class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        
        <li><a href="#">art</a></li>
        <li><a href="#">resturant</a></li>
        <li><a href="#">family & attraction</a></li>
        <li><a href="#">events & activities</a></li>
        <li><a href="#">at home </a></li>
        <li><a href="#">Fashion</a></li>
        
        -->
        
        
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
</nav>
<!-- InstanceBeginEditable name="EditRegion1" -->

</div>
</div>

 <?php }?>

