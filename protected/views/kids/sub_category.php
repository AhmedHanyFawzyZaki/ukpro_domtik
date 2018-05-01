</div>
</div>
    <?php
    $this->renderPartial("top_menu");
    ?>
    <?php
    $div1 = '';
    $div2 = '';
    $div3 = '';
    if(Yii::app()->user->getState('big1') == 'active'){
        $div1 = 'open';
    }
    if(Yii::app()->user->getState('big2') == 'active'){
        $div2 = 'open';
    }
    if(Yii::app()->user->getState('big3') == 'active'){
        $div3 = 'open';
    }
    ?>
<div class="container">
    <div class="wrap">
        <ul class="page_path wp4 delay-05s animated fadeInRight">
            <li><a href="javascript:void(0);">Categories</a> >> </li>
            <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids">kids</a> >> </li>
            <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/category?cat_id=<?php echo $sub->productCategory->id; ?>"><?php echo $sub->productCategory->title; ?></a> >> </li>
            <li class="active"><a href=""><?php echo $sub->title; ?></a></li>
        </ul>

        <div class="row">
            <div class="col-md-3 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $sub->productCategory->title; ?></div>
              <div class="panel-body left-menu">
                    <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav1">CATEGORIES</button>
                    <div id="nav1" class="collapse in">
                        <ul class="nav nav-pills nav-stacked">
                            <?php
                            foreach($allsub as $all){ ?>
<!--                                <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/subCategory?subcat_id=<?php echo $all->id; ?>"><?php echo $all->title; ?></a></li>-->
                                
                                  <li><a href="javascript:void(0);" onclick="insertParam('subcat_id',<?= $all->id ?>)"><?= $all->title ?></a></li>
                                
                            <?php
                            }
                            ?>
                        </ul>
                    </div>

                
                       <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav1">Brand</button>
                    <div id="nav1" class="collapse in">
                        <ul class="nav nav-pills nav-stacked">
                            <?php
                            foreach($brands as $brand){ ?>
<!--                                <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/subCategory?subcat_id=<?php echo $all->id; ?>"><?php echo $all->title; ?></a></li>-->
                                
                                  <li><a href="javascript:void(0);" onclick="insertParam('brand',<?= $brand->id ?>)"><?= $brand->title ?></a></li>
                                
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                       
                          <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav1">Shop</button>
                    <div id="nav1" class="collapse in">
                        <ul class="nav nav-pills nav-stacked">
                            <?php
                            foreach($users as $user){
                                 $user_details = UserDetails::model()->find("user_id=$user->id");
                                 ?>
                                
                                  <li><a href="javascript:void(0);" onclick="insertParam('shop',<?= $user->id ?>)"><?= $user_details->shop_name ?></a></li>
                                
                            <?php
                            }
                            ?>
                        </ul>
                    </div>

              </div>
            </div>
           <p class="amount" >
      <label for="price">Price range:</label>
      <input type="text" id="price" readonly>
    </p>
    <div id="slider-price"></div>
    
    
    
    <p class="amount" >
        <label for="price">Ages:</label>

    <ul class="sizes">
        
        <?php
        $sizes=Sizes::model()->findAll(array('condition' => 'category_id=8'));
        foreach ($sizes as $size) {
      
            ?>

  
  <li><a href="javascript:void(0);" onclick="insertParam('size',<?= $size->id ?>)"> <?= $size->title ?></a></li>
         

        <?php
        }
        
        ?>
        

    </ul>

</p>

<div class="clearfix"></div>

<p class="amount" >
    <label for="price">Colors:</label>

<ul class="colors">
      <?php
        $colors=Colors::model()->findAll();
        foreach ($colors as $color) {
      
            ?>
        
         <li style="background-color:<?php  echo $color->color   ?>  ; "><a   href="javascript:void(0);" onclick="insertParam('color',<?= $color->id ?>)"  ></a></li>
        
        <?php
        }
        
        ?>
       

</ul>

</p>


    
    
  
        </div>
    <div class="col-md-9 col-xs-12 part-right">
	<div class="head"><?php echo $sub->title; ?>
            <div class="btn-group pull-right">
                <a class="toggler toggle-big1 <?php echo Yii::app()->user->getState('big1');?>" href="javascript:void(0);" onclick="insertParam('tab', 'big1')"><i class="fa fa-th"></i></a>
                <a class="toggler toggle-big2 <?php echo Yii::app()->user->getState('big2');?>" href="javascript:void(0);" onclick="insertParam('tab', 'big2')"><i class="fa fa-th-large"></i></a>
                <a class="toggler toggle-big3 <?php echo Yii::app()->user->getState('big3');?>" href="javascript:void(0);" onclick="insertParam('tab', 'big3')"><i class="fa fa-align-justify"></i></a>
            </div>
        </div>
    <div class="sorting">
        <div class="pull-left">
            Sort By: <select onchange="insertParam('sort', this.value)">
                        <option value="title desc">Product name</option>
                        <option value="id desc">Product Date</option>
                        <option value="price asc">Product Price</option>
                    </select>
        </div>
            <?php
            $this->widget('CLinkPager', array(
                'pages' => $pages,
                'cssFile' => Yii::app()->theme->baseUrl . "/css/bootstrap.css",
                'firstPageLabel' => '&lt;&lt;',
                'prevPageLabel' => '&lt;',
                'nextPageLabel' => '&gt;',
                'lastPageLabel' => '&gt;&gt;',
                'header' => '',
                'htmlOptions' => array('class' => 'pagination pull-right'),
            ));
            
            ?>

    </div>
    
                <div class="toggle-div1 <?php echo $div1; ?> row">
                    <div class="col-md-12 col-xs-12 product-row line">
                        <?php
                         if (!empty($products)) {
                        $i = 1;
                        foreach($products as $product){
                            if($i == 4){
                                $i = 1;
                            ?>
                                </div>
                                <div class="col-md-12 col-xs-12 product-row line">
                                
                            <?php
                            }
                            ?>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="products">
                                    <a class="product-img" href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $product->id; ?>">
                                    <?php if($product->flag != 1){ ?>
                                        <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $product->main_image; ?>">
                                    <?php }else{
                                        ?>
                                        <img src="<?php echo $product->main_image ?>">
                                        <?php
                                    } ?>
                                    </a>
                                    <span class="price"><?php echo $product->price; ?> GBP</span>
                                    
                     <a class="title" href="<?php echo Yii::app()->getBaseUrl(true) . '/kids/details' ; ?>?pro_id=<?= $product->id ?>"><?php echo $product->title; ?></a>

                                    <span class="desc"><?php echo substr($product->description, 0, 30); ?>...</span>
                                    <span class="cart-btn"><a class="add-cart" href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $product->id; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/add-cart.png">Add to cart</a></span>
                                </div>
                            </div>
                        <?php
                        $i++;
                         }
                         
                            }else {
                        ?>
                      
                    
                    <div style="width:500px;height:15px;clear:both;" ></div>
        <div class="nofound"  style="width:815px;margin-left: 10px;">
                            <div class="alert alert-danger">
                                <p>No products found</p>
                            </div>
        </div>
 
                    
                        <?php
                    }
                    ?>
                       
                        </div>
                    </div>
    
                <div class="toggle-div2 <?php echo $div2; ?> row">
                    <div class="col-md-12 col-xs-12 product-row line">
                        <?php
                         if (!empty($products)) {
                        $j = 1;
                        foreach($products as $product){
                            if($j == 3){
                                $j = 1; ?>
                                </div>
                                <div class="col-md-12 col-xs-12 product-row line">
                            <?php
                            }
                            ?>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="products">
                                    <a class="product-img" href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $product->id; ?>">
                                       <?php if($product->flag != 1){ ?>
                                        <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $product->main_image; ?>">
                                       <?php }else{
                                           ?>
                                         <img src="<?php echo $product->main_image ?>">
                                        <?php
                                       } ?>
                                    </a>
                                    <span class="price"><?php echo $product->price; ?> GBP</span>
                                    
                         <a class="title" href="<?php echo Yii::app()->getBaseUrl(true) . '/kids/details' ; ?>?pro_id=<?= $product->id ?>"><?php echo $product->title; ?></a>
  
                                    
                                    <span class="desc"><?php echo substr($product->description, 0, 30); ?>...</span>
                                    <span class="cart-btn"><a class="add-cart" href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $product->id; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/add-cart.png">Add to cart</a></span>
                                </div>
                            </div>
                        <?php
                        $j++;
                        }
                        }else {
                        ?>
                      
                    
                    <div style="width:500px;height:15px;clear:both;" ></div>
        <div class="nofound"  style="width:815px;margin-left: 10px;">
                            <div class="alert alert-danger">
                                <p>No products found</p>
                            </div>
        </div>
 
                    
                        <?php
                    }
                    ?>
                    </div>
                </div>
    
                <div class="toggle-div3 <?php echo $div3; ?> row">
                <div class="col-md-12 product-row">
                    <?php    if (!empty($products)) {
                        ?>
                    
                   
                   <table class="table table-bordered">
                       <thead>
                           <tr>
                               <th>Name</th>
                               <th>Price</th>
                               <th>Description</th>
                               <th>Buy</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                           foreach ($products as $product){ ?>
                               <tr>
                                   <td><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $product->id; ?>" class="item-img"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $product->main_image; ?>" class="table-img"><span><?php echo $product->title; ?></span></a></td>
                                   <td><span><?php echo $product->price; ?> GBP</span></td>
                                   <td><span><?php echo substr($product->description, 0, 30); ?>...</span></td>
                                   <td><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $product->id; ?>">Add to cart</a></td>
                               </tr> 
                           <?php
                           }
                           
                          }else {
                        ?>
                      
                    
                    <div style="width:500px;height:15px;clear:both;" ></div>
        <div class="nofound"  style="width:815px;margin-left: 10px;">
                            <div class="alert alert-danger">
                                <p>No products found</p>
                            </div>
        </div>
 
                    
                        <?php
                    }
                    ?>            
                       </tbody>
               </table>

               </div>
                </div>
	
    </div>

            <?php
            $this->widget('CLinkPager', array(
                'pages' => $pages,
                'cssFile' => Yii::app()->theme->baseUrl . "/css/bootstrap.css",
                'firstPageLabel' => '&lt;&lt;',
                'prevPageLabel' => '&lt;',
                'nextPageLabel' => '&gt;',
                'lastPageLabel' => '&gt;&gt;',
                'header' => '',
                'htmlOptions' => array('class' => 'pagination pull-right'),
            ));
            
            ?>
            
</div>

</div>
</div>

<script>
    function insertParam(key, value)
    {
        key = encodeURI(key);
        value = encodeURI(value);

        var kvp = document.location.search.substr(1).split('&');

        var i = kvp.length;
        var x;
        while (i--)
        {
            x = kvp[i].split('=');

            if (x[0] == key)
            {
                x[1] = value;
                kvp[i] = x.join('=');
                break;
            }
        }

        if (i < 0) {
            kvp[kvp.length] = [key, value].join('=');
        }

        //this will reload the page, it's likely better to store this until finished
        document.location.search = kvp.join('&');
    }
</script>

<?php

   $max=Product::model()->find(array('condition'=>'category_id = 8', 'order'=>'price desc'))->price;

?>

 <script>
  $(function() {
    $( "#slider-price" ).slider({
      range: true,
      min: 0,
      max: <?php echo $max; ?>,
      <?php
            if(isset($_REQUEST['price']))
            {
                $arr=  explode('_', $_REQUEST['price']);
                $slide_min = $arr[0];
                $slide_max = $arr[1];
            }
            else
            {
                $slide_min = 0;
                $slide_max = $max;
            }
            ?>
      values: [<?=$slide_min?>, <?=$slide_max?>],
      slide: function( event, ui ) {
        $( "#price" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
         insertParam("price", ui.values[ 0 ]+"_"+ui.values[ 1 ]);
      }
    });
    $( "#price" ).val( "$" + $( "#slider-price" ).slider( "values", 0 ) +
      " - $" + $( "#slider-price" ).slider( "values", 1 ) );
  });
  
  </script>
  

