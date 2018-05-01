<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>
    
    
    
</div>

</div>


<div class="container">
    <div class="wrap">
        

       <?php 
       /*
       foreach($pag_products as $pag_product){
    echo $pag_product->id."<br/>" ;?>
<!--    // display a model-->

<?php }
*/
?>  
        

<div class="row">
<div class="col-md-12 col-xs-12">
    	<ul class="page_path">
                    <li><a href="#">Categories</a> >> </li>
                  
                     <li><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>"><?= $controller ?></a> >></li>
                    
                      <?php if (isset($_REQUEST['cat_id'])) { ?>
                    <li class="active">
                        <a href="javascript:void(0);"><?php echo ProductCategory::model()->findByPk($_REQUEST['cat_id'])->title; ?></a></li>
                <?php } ?>
                     
                </ul>
    </div>
    
    </div>
    
    <div class="row">
	<div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading" data-toggle="collapse" data-target="#nav1">
                 <?php
                    if (isset($_REQUEST['cat_id'])) {
                        echo ProductCategory::model()->findByPk($_REQUEST['cat_id'])->title;
                        $subCats = SubCategory::model()->findAll(array('condition' => 'product_category_id=' . $_REQUEST['cat_id']));
                    } else {
                        echo $controller;
                        $cats = ProductCategory::model()->findAll(array('condition' => 'category_id=9'));
                    }
                    ?>
            </div>
          <div class="panel-body left-menu">
               
                <div id="nav1" class="collapse in">
                	<ul class="nav nav-pills nav-stacked">
                            
                           <?php
                            if ($subCats) {
                                foreach ($subCats as $sub) {
                                    ?>
                                    <li><a href="javascript:void(0);" onclick="insertParam('subcat_id',<?= $sub->id ?>)"><?= $sub->title ?></a></li>
                                    <?php
                                }
                            } elseif ($cats) {
                                foreach ($cats as $cat) {
                                    ?>
                                    <li><a href="javascript:void(0);" onclick="insertParam('cat_id',<?= $cat->id ?>)"><?= $cat->title ?></a></li>
                                    <?php
                                }
                            }
                            ?>  
                            
<!--                      <li><a href="#">Lorem Ipsum</a></li>-->
                      
                    </ul>
                
                </div> 
              
              
                
          </div>
        </div>
        
            
               <div class="panel panel-default">
          <div class="panel-heading" data-toggle="collapse" data-target="#nav2">Brand</div>
          <div class="panel-body left-menu">
               
                <div id="nav2" class="collapse">
                	<ul class="nav nav-pills nav-stacked">
                            <?php foreach ($brands as $brand){
                                ?>
            <li><a href="javascript:void(0);" onclick="insertParam('brand',<?= $brand->id ?>)"><?= $brand->title ?></a></li> 

                            <?php
                            } ?>
                    </ul>
                
                </div> 
                
          </div>
        </div>
            
            
            <div class="panel panel-default">
          <div class="panel-heading" data-toggle="collapse" data-target="#nav3">Shops</div>
          <div class="panel-body left-menu">
               
                <div id="nav3" class="collapse">
                	<ul class="nav nav-pills nav-stacked">
                            <?php foreach ($users as $user){
      $user_details = UserDetails::model()->find("user_id=$user->id");
                                ?>
            <li><a href="javascript:void(0);" onclick="insertParam('shop',<?= $user->id ?>)"><?= $user_details->shop_name ?></a></li> 

                            <?php
                            } ?>
                    </ul>
                
                </div> 
                
          </div>
        </div>
            
<!--         <div class="panel panel-default">
          <div class="panel-heading" data-toggle="collapse" data-target="#nav2">Location</div>
          <div class="panel-body left-menu">
               
                <div id="nav2" class="collapse">
                	<ul class="nav nav-pills nav-stacked">
                      <li><a href="#">Lorem Ipsum</a></li>
                       <li><a href="#">Lorem Ipsum</a></li>
                       <li><a href="#">Lorem Ipsum</a></li>
                       <li><a href="#">Lorem Ipsum</a></li>
                       <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                
                </div> 
                
          </div>
        </div>-->
        
            
<!--            
        <div class="panel panel-default">
          <div class="panel-heading" data-toggle="collapse" data-target="#nav3">Price</div>
          <div class="panel-body left-menu">
               
                <div id="nav3" class="collapse">
                	<ul class="nav nav-pills nav-stacked">
                      <li><a href="#">Lorem Ipsum</a></li>
                       <li><a href="#">Lorem Ipsum</a></li>
                       <li><a href="#">Lorem Ipsum</a></li>
                       <li><a href="#">Lorem Ipsum</a></li>
                       <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                
                </div> 
                
          </div>
        </div>-->
            
            
            
            
        
    <p class="amount" >
  <label for="price">Price range:</label>
  <input type="text" id="price" readonly>
</p>
<div id="slider-price"></div>
         


   

    </div>
    <div class="col-md-9">
    	

	<div class="head">subcategory name
    <div class="btn-group pull-right">
                      <a class="toggler toggle-big1 active" href="#"><i class="fa fa-th"></i></a>
                      <a class="toggler toggle-big2" href="#"><i class="fa fa-th-large"></i></a>
                      <a class="toggler toggle-big3" href="#"><i class="fa fa-align-justify"></i></a>
                      
                    </div>
    </div>
    <div class="sorting">
    <div class="pull-left">
    Sort By:          
  <!--                        <select>
    			   <option>Product name</option>
                           <option>Product name</option>
                           <option>Product name</option>
    			</select>-->
    
                   <select  onchange="insertParam('sort', this.value)">
                    <option value="">select sorting type</option>
                    <option value="title asc">Product name (ASC)</option>
                    <option value="title desc">Product name (DESC)</option>
                    <option value="id asc">Recently added (ASC)</option>
                    <option value="id desc">Recently added (DESC)</option>
                </select>
   </div>
        
<!--        
                <ul class="pagination pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
        -->
        
           
                <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'htmlOptions' => array('class' => 'pagination pull-right'), // class of pag div
                    'firstPageLabel' => '&lt;&lt;',
                    //'prevPageLabel' => '»',
                    //'nextPageLabel' => '«',
                    'lastPageLabel' => '&gt;&gt;',
                    'header' => '',
                ))
                ;
                ?>
        
        
                </div>
                
     <div class="toggle-div1 open row">           
    <div class="row product-row">
    
        
           <?php
                    if (!empty($pag_products)) {
                       // foreach ($products as $product) {
                       foreach($pag_products as $pag_product){
                            ?>
                          
    <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $pag_product->id ?>" class="col-md-4 col-xs-12">
    	<div class="place">
            <?php if($pag_product->flag != 1){ ?>
    	<img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $pag_product->main_image ?>">
            <?php }else{
                ?>
        <img src="<?= $pag_product->main_image ?>">
        <?php
            } ?>
        <h3 class="title"><?= $pag_product->title ?><span><?= $pag_product->price ?> GBP</span></h3>
        
    
        </div>
    </a>
        
        
        
                            <?php
                        }
                    } else {
                        ?>
        
        <div style="width:500px;height:2px;clear:both;" ></div>
        <div class="nofound"  style="width:815px;margin-left: 10px;">
                            <div class="alert alert-danger">
                                <p>No products found</p>
                            </div>
        </div>
                        <?php
                    }
                    ?>
        
        
<!--    <a href="#" class="col-md-4 col-xs-12">
    	<div class="place">
    	<img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/place.jpg">
        <h3 class="title">Place name<span>200 GBP</span></h3>
        
    
        </div>
    </a>-->
    
        
    </div>
    
     
    </div>
   
        
        
        
        
        
        
    <!--  second view of products -->
   	<div class="toggle-div2 row">
    <div class="row product-row">
       
         <?php
                    if (!empty($pag_products)) {
                        foreach ($pag_products as $pag_product) {
                            ?>
                          
    <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $pag_product->id ?>" class="col-md-6 col-xs-12">
    	<div class="place">
    	<?php if($pag_product->flag != 1){ ?>
            <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $pag_product->main_image ?>">
        <?php }else{
            ?>
            <img src="<?= $pag_product->main_image ?>">
            <?php
        } ?>
        <h3 class="title"><?= $pag_product->title ?><span><?= $pag_product->price ?> GBP</span></h3>
        
    
        </div>
    </a>
        
        
                            <?php
                        }
                    } else {
                        ?>
        
        <div style="width:500px;height:2px;clear:both;" ></div>
        <div class="nofound"  style="width:815px;margin-left: 10px;">
                            <div class="alert alert-danger">
                                <p>No products found</p>
                            </div>
        </div>
                        <?php
                    }
                    ?>
        
    
<!--  
    <a href="#" class="col-md-6 col-xs-12">
    	<div class="place">
    	<img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/place.jpg">
        <h3 class="title">Place name<span>200 GBP</span></h3>
        
    
        </div>
    </a>-->
        
        
        
    </div>
     </div>
    
   	<div class="toggle-div3 row">     
    <div class="col-md-12 product-row">
    	

     <?php   
 if (!empty($pag_products)) {
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
                   
                      foreach ($pag_products as $pag_product) {
                            ?>
                          
            
                <tr>
                    <td><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $pag_product->id ?>" class="item-img"><img  style="width:70px;height: 70px;"  src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $pag_product->main_image ?>" class="table-img"><span><?= $pag_product->title ?></span></a></td>
                      <td><span> <?= $pag_product->price ?>   GBP </span></td>
                    <td><span><?= $pag_product->description ?></span></td>
                    <td><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $pag_product->id ?>">Add to cart</a></td>
                </tr>
        
        
                            <?php
                        }
                    } else {
                        ?>
        
        <div style="width:500px;height:2px;clear:both;" ></div>
        <div class="nofound"  style="width:815px;margin-left: 10px;">
                            <div class="alert alert-danger">
                                <p>No products found</p>
                            </div>
        </div>
                        <?php
                    }
                    ?>
        
                
                
            
<!--                <tr>
                    <td><a href="#" class="item-img"><img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/product-img.png" class="table-img"><span>Name</span></a></td>
                    <td><span>$200.00</span></td>
                    <td><span>Lorem Ipsum is simply dummy</span></td>
                    <td><a href="#">Add to cart</a></td>
                </tr>
                -->
               
            </tbody>
    </table>
        
    </div>
    
    
   	<hr>
    </div>
    
<!--    
 <ul class="pagination pull-right">
  <li><a href="#">&laquo;</a></li>
  <li><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#">&raquo;</a></li>
</ul>-->


    
      <?php
      
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'htmlOptions' => array('class' => 'pagination pull-right'), // class of pag div
                    'firstPageLabel' => '&lt;&lt;',
                    //'prevPageLabel' => '»',
                    //'nextPageLabel' => '«',
                    'lastPageLabel' => '&gt;&gt;',
                    'header' => '',
                ))
                ;
                
                ?>



    

<!--// display pagination-->
<?php 
/*
 $this->widget('CLinkPager', array(
 
    'pages' => $pages,
))
 * 
 */
  ?>
 

        
    
    </div>
</div>

        
       

    </div>
</div>


<?php

     $slider_max_price=Product::model()->find(array('condition'=>'category_id = 9', 'order'=>'price desc'))->price;

?>
<script>
    
      //dynamic  js to slider 
    $(function() {
        $("#slider-price").slider({
            range: true,
            min: 0,
            max: <?= $slider_max_price ?>,
<?php
if (isset($_REQUEST['price'])) {
    $arr = explode('_', $_REQUEST['price']);
    $min = $arr[0];
    $max = $arr[1];
} else {
    $min = 0;
    $max = $slider_max_price;
}
?>
            values: [<?= $min ?>, <?= $max ?>],
            slide: function(event, ui) {
                $("#price").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
                insertParam("price", ui.values[ 0 ] + "_" + ui.values[ 1 ]);
            }
        });
        $("#price").val("$" + $("#slider-price").slider("values", 0) +
                " - $" + $("#slider-price").slider("values", 1));
    });




     //second slider for age
    $(function() {
        $("#slider-age").slider({
            range: true,
            min: 0,
            max: 80,
            values: [0, 80],
            slide: function(event, ui) {
                $("#age").val(ui.values[ 0 ] + " - " + ui.values[ 1 ] + "Years");
            }
        });
        $("#age").val($("#slider-age").slider("values", 0) + " - " + $("#slider-age").slider("values", 1) +
                "Years");
    });
    
    
</script>





    <script>
        
        //static js to slider
       /* 
  $(function() {
    $( "#slider-price" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#price" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#price" ).val( "$" + $( "#slider-price" ).slider( "values", 0 ) +
      " - $" + $( "#slider-price" ).slider( "values", 1 ) );
  });
  
  $(function() {
    $( "#slider-age" ).slider({
      range: true,
      min: 0,
      max: 80,
      values: [ 0, 80 ],
      slide: function( event, ui ) {
        $( "#age" ).val(  ui.values[ 0 ]+ " - " + ui.values[ 1 ]+ "Years" );
      }
    });
    $( "#age" ).val(  $( "#slider-age" ).slider( "values", 0 ) + " - " + $( "#slider-age" ).slider( "values", 1 )+
      "Years"  );
  });
  
  
  */
  </script>


  
 
  
<script>
    //  onclick="insertParam('subcat_id',<?= $sub->id ?>)
    
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