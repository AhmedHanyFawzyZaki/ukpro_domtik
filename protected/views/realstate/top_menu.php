<?php
    $cats=  ProductCategory::model()->findAll(array('condition'=>'category_id=10'));
    if($cats){
?>

<nav class="navbar navbar-default main-nav" role="navigation">
 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     <ul class="nav navbar-nav">
                        <?php
                            $controller=Yii::app()->controller->id;
                            foreach ($cats as $cat)
                            {
                                $subcats=  SubCategory::model()->findAll(array('condition'=>'product_category_id='.$cat->id));
                                if($subcats)
                                {
                                    echo '
                                    <li class="dropdown">
                                        <a href="'.Yii::app()->request->baseUrl.'/'.$controller.'/Category?cat_id='.$cat->id.'" class="dropdown-toggle" >'.$cat->title.'</a>
                                        <ul class="dropdown-menu" role="menu">';
                                    foreach ($subcats as $sub)
                                    {
                                        echo '<li><a href="'.Yii::app()->request->baseUrl.'/'.$controller.'/Category?subcat_id='.$sub->id.'&cat_id='.$sub->product_category_id.'">'.$sub->title.'</a></li>';
                                    }
                                    echo '
                                        </ul>
                                    </li>';
                                }
                                else
                                {
                                    echo '<li><a href="'.Yii::app()->request->baseUrl.'/'.$controller.'/Category?cat_id='.$cat->id.'">'.$cat->title.'</a></li>';
                                }
                        ?>
                        <?php
                            }
                        ?>
                    </ul>
      
      
    </div><!-- /.navbar-collapse -->
</nav>
    <?php
                            }
                        ?>