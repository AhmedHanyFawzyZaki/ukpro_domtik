<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>
    
    
    
</div>

</div>


<div class="container">
    <div class="wrap">
        
  
        
        

<div class="row">
<div class="col-md-12 col-xs-12">
      <ul class="page_path wp4 delay-05s animated fadeInRight">
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
      <div class=" search animated pulse">
            <p class="form-title">Search by location</p>
            <form class="form-horizontal" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true) . '/' . $controller; ?>/search">
             

               <div class="form-group">
            <label class="col-sm-5 control-label">Country:</label>
            <div class="col-sm-7">
                <select class="form-control" name="country" id="count" onchange="calldropdown()" >
                            <option value="">Select Country...</option>
                            <?php
                            if ($countries) {
                                foreach ($countries as $country) {
                                    
                                     if ($country->id == $cou) {

                                        $selected = 'selected';
                                    } else {

                                        $selected = '';
                                    }
                                    ?>
                                    <option value="<?php echo $country->id; ?>" <?= $selected ?>><?php echo $country->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

            </div>
        </div>
    <div class="form-group">
            <label class="col-sm-5 control-label"> City:</label>
            <div class="col-sm-7">
                <select class="form-control" name="city" id="countryid" >
                            <option value="">Select City...</option>
                            <?php
                            if ($cities) {
                                foreach ($cities as $city) {
                                    
                                     if ($city->id == $cit) {

                                        $selected = 'selected';
                                    } else {

                                        $selected = '';
                                    }
                                    ?>
                                    <option value="<?php echo $city->id; ?>" <?= $selected ?>><?php echo $city->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-5 control-label">Post Code:</label>
            <div class="col-sm-7">
      <input type="text"  name="postcode" class="form-control" placeholder="Search by post code"  >
                    </div>
        </div>
                
                      
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-primary search-bt pull-right" type="submit">search</button>
                    </div>
                </div>


                
            </form>

        </div>
<!--end search  -->   



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
    
    
<!--            <select>
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
        
<!--                <ul class="pagination pull-right">
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
                    'firstPageLabel' => '<<',
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
                    if (!empty($products)) {
                        foreach ($products as $product) {
                          $service=0;
                          if($product->type==1){
                           if($product->user->payment_status !=1 or $product->user->end_subscrib_date < $currntdate)
                           {
                             $service=1;
                          }
                          }
                            if($service==0 ){
                            ?>
                         
    <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="col-md-4 col-xs-12">
      <div class="place">
      <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>">
        <h3 class="title"><?= $product->title ?><span><?= $product->price ?> GBP</span></h3>
        
    
        </div>
    </a>
        
        
      <?php } ?>
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
                    if (!empty($products)) {
                        foreach ($products as $product) {
                           if($product->type==1){
                           if($product->user->payment_status=1 and $product->user->end_subscrib_date > $currntdate)
                           {
                             $service=1;
                          }
                           }
                            if($service==1 or $product->type==0 ){
                            ?>
                          
    <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="col-md-6 col-xs-12">
      <div class="place">
      <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>">
        <h3 class="title"><?= $product->title ?><span><?= $product->price ?> GBP</span></h3>
        
    
        </div>
    </a>
      <?php } ?>
        
                            <?php
                        }
                    } else {
                        ?>
                        <div class="nofound">
                            <div class="alert alert-danger">
                                <p>No products found</p>
                            </div></div>
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
                    if (!empty($products)) {
                        foreach ($products as $product) {
                           if($product->type==1){
                           if($product->user->payment_status=1 and $product->user->end_subscrib_date > $currntdate)
                           {
                             $service=1;
                          }
                           }
                            if($service==1 or $product->type==0 ){
                            ?>
                          
            
                <tr>
                    <td><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="item-img"><img  style="width:70px;height: 70px;"  src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>" class="table-img"><span><?= $product->title ?></span></a></td>
                      <td><span> <?= $product->price ?>   GBP </span></td>
                    <td><span><?= $product->description ?></span></td>
                    <td><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>">Add to cart</a></td>
                </tr>
              <?php } ?>
        
                            <?php
                        }
                    } else {
                        ?>
                        <div class="nofound">
                            <div class="alert alert-danger">
                                <p>No products found</p>
                            </div></div>
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
    
<!--  <ul class="pagination pull-right">
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
                    'firstPageLabel' => '<<',
                    //'prevPageLabel' => '»',
                    //'nextPageLabel' => '«',
                    'lastPageLabel' => '&gt;&gt;',
                    'header' => '',
                ))
                ;
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

<script>
    function calldropdown() {
        var mks = document.getElementById("count").selectedIndex;
        $.ajax({
            url:"<?=Yii::app()->request->baseUrl?>/index.php/lifestyle/Getcity?id="+mks,
            success: function(data) {
               // $('#makemodel').val(data);
           document.getElementById('countryid').innerHTML = data;
              // alert(mks);
            }
        }
        );

    }

</script>