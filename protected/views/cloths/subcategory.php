
<div class="col-md-12">
    <ul class="page_path wp4 delay-05s animated fadeInRight">
        <li><a href="#">Categories</a>  &gt;&gt;</li>
        <li class="active"><a href="#">Clothes &amp; Accessories</a>  &gt;&gt;</li>

    </ul>
</div>

<div class="col-md-3 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">
           <?php
                    if (isset($_REQUEST['cat_id'])) {
                        echo ProductCategory::model()->findByPk($_REQUEST['cat_id'])->title;
                        $subCats = SubCategory::model()->findAll(array('condition' => 'product_category_id=' . $_REQUEST['cat_id']));
                    } else {
                        echo $controller;
                        $cats = ProductCategory::model()->findAll(array('condition' => 'category_id=1'));
                    }
                    ?>  
            
        </div>
       
        <div class="panel-body left-menu">
            <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav5">CATEGORIES </button>

            <div id="nav5" class="collapse in">
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
                            
                </ul>
            </div>
            
            <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav6">Brands </button>

                      <div id="nav6" class="collapse">
                <ul class="nav nav-pills nav-stacked">
  
                             <?php
                            if ($brands) {
                                foreach ($brands as $brand) {
                                    ?>
                                    <li><a href="javascript:void(0);" onclick="insertParam('brand',<?= $brand->id ?>)"><?= $brand->title ?></a></li>
                                    <?php
                                }
                            }                 ?>
                            
                </ul>
            </div>
            
            <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav7">Shops </button>

                      <div id="nav7" class="collapse">
                <ul class="nav nav-pills nav-stacked">
  
                             <?php
                            if ($users) {
                                foreach ($users as $user) {
                                    $user_details = UserDetails::model()->find("user_id=$user->id");
                                    if($user_details ->shop_name != '')
                                    ?>
                                    <li><a href="javascript:void(0);" onclick="insertParam('shop',<?= $user->id ?>)"><?= $user_details->shop_name ?></a></li>
                                    <?php
                                }
                            }                 ?>
                            
                </ul>
            </div>
            
<!--            <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav2">Sizes</button>
            <div id="nav2" class="collapse">
                <ul class="nav nav-pills nav-stacked">
                    <?php
                    /*
                    $sizes = Size::model()->findAll(array('condition' => 'product_id in (select product_id from product_details where sub_category_id=3)'));
//                                   
                    foreach ($sizes as $size) {
                        ?>
                        <li><a href="javascript:void(0);" onclick="insertParam('size',<?= $size->product_id ?>)"><?= $size->title ?></a></li>

                        
                        


                    <?php 
                    
                    }
                    */
                    ?>
                </ul>

            </div>-->


<!--            <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav3">Colors</button>
            <div id="nav3" class="collapse">
                <ul class="nav nav-pills nav-stacked">
                    <?php
                    /*
                    $colors = Color::model()->findAll(array('condition' => 'product_id in (select product_id from product_details where sub_category_id=3)'));
//                                   
                    foreach ($colors as $color) {
                        ?>
                                                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/subCategory/id/<?php echo $subcat->id; ?>&color=<?= $color->title ?>"><?php echo $color->title; ?></a></li>
                        <li><a href="javascript:void(0);" onclick="insertParam('color',<?= $color->product_id ?>)"><?= $color->title ?></a></li>



                    <?php } 
                    */
                    ?>
                </ul>

            </div>-->
            
            
            
            
        </div>








    </div>


    <p class="amount" >
        <label for="price">Price range:</label>
        <input type="text" id="price" readonly>
    </p>

    <div id="slider-price"></div>


    <p class="amount" >
        <label for="price">Sizes:</label>

    <ul class="sizes">
        
        <?php
        $sizes=Sizes::model()->findAll(array('condition' => 'category_id=1'));
        foreach ($sizes as $size) {
      
            ?>
<!--  <li><a onclick="insertParam('size2',<?php   echo $size->title  ; ?>)"    href="javascript:void(0);"   ><?php // echo $size->title  ; ?></a></li>-->
  
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
<div class="clearfix"></div>
<label for="price" style="margin-top:20px;">Gender:</label> <br> 
       <div class="gender-radio" >
           <input type="radio" name="gender" value="male" onclick="insertParam('gender',0)">Men</div>
       <div class="gender-radio" >
           <input type="radio" name="gender" value="female" onclick="insertParam('gender',1)">Women</div>


</div>




<div class="col-md-9 featured_items">
    <p class="sections_title col-md-6">Featured items</p>
    <div class="btn-group pull-right">
        
        <a class="btn btn-default toggle-big1 active" href="javascript:void(0)"><i class="fa fa-th"></i></a>
        <a class="btn btn-default toggle-big2" href="javascript:void(0)"><i class="fa fa-th-large"></i></a>
        <a class="btn btn-default toggle-big3" href="javascript:void(0)"><i class="fa fa-align-justify"></i></a>

    </div>
    <div class="seprator_line"></div>




    <div class="toggle-div1 open row">
        <?php
        if($products){
            foreach ($products as $product) {
                $favs = count(Favourite::model()->findAll("product_id = $product->id"));
                ?>

                <div class="col-md-3 wp4 one_featured_item">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/id/<?php echo $product->id; ?>" class="item_img">
                   <?php if($product->flag != 1){ ?>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $product->main_image; ?>">
                   <?php  }else{
                       ?>
              <img src="<?php echo $product->main_image; ?>">
                         
                        <?php
                   } ?> 
                    </a>

                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/id/<?php echo $product->id; ?>" class="add_to_cart">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/add_to_cart.png"/>
                        ADD TO CART
                    </a>


                    <?php
                    if (!empty(Yii::app()->user->id)) {
                        $check = Helper::checkFav($product->id);
                        if ($check == 1) {
                            ?>
                        <a class="fav_icon add_fav_solid" href="javascript:void(0);" id="<?php echo $product->id ?>"><span class="fav-number"><?php echo $favs ?></span></a>
                        <?php } else { ?>
                                <a class="add_fav fav_icon" href="javascript:void(0);" id="<?php echo $product->id ?>" ><span class="fav-number"><?php echo $favs ?></span></a>
                            <?php
                        }
                    } else {
                        ?>
                        <a data-target="#login-modal" data-toggle="modal" data-dismiss="modal" id="<?php echo $product->id ?>" class="add_fav fav_icon"></a>
                    <?php } ?>                          


                    <div class="price_tag">
                        <a class="item_name" href="<?php echo Yii::app()->getBaseUrl(true) . '/cloths/item/' . $product->id; ?>"><?php echo Helper::limit_words($product->title , 10); ?></a>
                        <p class="sp_item_price item_price"><?php echo $product->price; ?> GBP</p>
                    </div>



                </div>

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
        
        
       
    </div>



    <div class="toggle-div2 row">              
        <?php
        if($products){

            foreach ($products as $product) {
                 $favs = count(Favourite::model()->findAll("product_id = $product->id"));
                ?>

                <div class="col-md-3 wp4 one_featured_item">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/id/<?php echo   $product->id; ?>" class="item_img">
                    <?php if($product->flag != 1){ ?>  
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo  $product->main_image; ?>">
                    <?php }else{ ?>
                        <img src="<?php echo  $product->main_image; ?>">
                    <?php } ?>
                    </a>

                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/id/<?php echo  $product->id; ?>" class="add_to_cart">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/add_to_cart.png"/>
                        ADD TO CART
                    </a>


                    <?php
                    if (!empty(Yii::app()->user->id)) {
                        $check = Helper::checkFav($product->id);
                        if ($check == 1) {
                            ?>
                        <a class="fav_icon add_fav_solid" href="javascript:void(0);" id="<?php echo $product->id ?>"><span class="fav-number"><?php echo $favs ?></span></a>
                        <?php } else { ?>
                                <a class="add_fav fav_icon" href="javascript:void(0);" id="<?php echo $product->id ?>" ><span class="fav-number"><?php echo $favs ?></span></a>
                            <?php
                        }
                    } else {
                        ?>
                        <a data-target="#login-modal" data-toggle="modal" id="<?php echo $product->id ?>" data-dismiss="modal" class="add_fav fav_icon"><span class="fav-number"><?php echo $favs ?></span></a>
                    <?php } ?>                             
                    <div class="price_tag">
                        <a class="item_name" href="<?php echo Yii::app()->getBaseUrl(true) . '/cloths/item/' . $product->id; ?>"><?php echo $product->title; ?></a>
                        <p class="sp_item_price item_price"><?php echo $product->price; ?> GBP</p>
                    </div>



                </div>

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
        
        
      
      
    </div>
    <div class="toggle-div3 row">
        <?php
                if($products){
                    ?>
                
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Favorite</th>
                    <th>Buy</th>
                </tr>
            </thead>
            <tbody>

                <?php
                
             
                    foreach ($products as $product) {
                        ?>


                        <tr>
                            <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/id/<?php echo   $product->id; ?>" class="item-img">
                                    <?php if($product->flag != 1){ ?>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $product->main_image; ?>" class="table-img">
                                    <?php }else{ ?>
                                    <img src="<?php echo $product->main_image; ?>" class="table-img">
                                    <?php } ?>
                                    <span><?php echo  $product->title; ?></span></a></td>
                            <td><span><?php echo   $product->price; ?></span></td>
                            <td>
                                <?php
                                if (!empty(Yii::app()->user->id)) {
                                    $check = Helper::checkFav( $product->id);
                                    if ($check == 1) {
                                        ?>
                                        
    <a  href="javascript:void(0);" onclick="removefav(<?php echo  $product->id;?>)">Remove from favorite</a>

                                    <?php } else { ?>
              <a  href="javascript:void(0);" onclick="getProdcutId(<?php echo  $product->id;?>)" >Add to favorite</a>

                                            <?php
                                    }
                                } else {
                                    ?>
                                    <a data-target="#login-modal" data-toggle="modal" data-dismiss="modal" >Add to favorite</a>
                                <?php } ?>
                            </td>
                            <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/id/<?php echo  $product->id; ?>">Add to cart</a></td>
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


    <div class="featured_pag pagination wp4">
        <?php
        $this->widget('CLinkPager', array(
            'currentPage' => $pages->getCurrentPage(),
            'itemCount' => $count_prod,
            'pageSize' => $pages->pageSize,
            'maxButtonCount' => 5,
            //'nextPageLabel'=>'My text >',
            'header' => '',
            'htmlOptions' => array('class' => 'featured_pag pagination wp4'),
        ));
        ?>
    </div> 	

</div>


<div class="col-md-12">
    <p class="sections_title">New Arrivals</p>
    <div class="seprator_line"></div>

    <div id="carousel-example-generic2" class="carousel slide animated fadeInUp new_arriv_slider" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic2" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic2" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic2" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->




        <div class="carousel-inner">


            <div class="item active">
                <?php
                
                $s = 1;
                if($arrivls){
                  
                foreach ($arrivls as $arrivl) {
                    if ($s == 5) {
                        $s = 1;
                        ?>
                    </div>
                    <div class="item">
                        <?php
                    }
                    }
                    ?>

                    <div class="col-md-3 col-xs-6 text-center">
                        <a href="<?= Yii::app()->request->baseUrl; ?>/cloths/item/id/<?= $arrivl->id ?>" class="new_arr_item">
                            <div class="item_img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $arrivl->main_image; ?>"/></div>
                            <p class="item_name"><?php echo $arrivl->title ?></p>
                            <p class="new_arr_price"><?php echo $arrivl->price; ?> GBP</p>
                        </a>
                    </div>



                    <?php
                    $s++;
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


        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic2" role="button" data-slide="prev">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/left_arrow2.png"/>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/right_arrow2.png"/>
        </a>
    </div>
</div>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>




<?php
$slider_max_price = product::model()->find(array('condition' => 'category_id=1', 'order' => 'price desc'))->price;
// $slider_max_price=1000;
// echo $slider_max_price ;
?>




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




<script>

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
   // function getProdcutId(p) {
       <?php  //echo die; ?>
      //   var product_id=p;
        $(function(){
          $(document).delegate(".add_fav","click",function(){ 
              var $this  = $(this);
        var pro_id = $(this).attr('id');  
        $.ajax({
            url:"<?php echo Yii::app()->request->getBaseUrl(true)?>/home/addFav",
            type:"post",
            data:"pro_id="+pro_id ,       
            success:function (data){
                
                console.log(data);
                $this.children(".fav-number").text(data);
                
       // $(this).toggleClass('add_fav');
        //$this.attr('class',"fav_icon add_fav"');
         $this.prop('class',"fav_icon add_fav_solid");
    
                //return true;
            } 
        });
        });
        
        
          $(document).delegate(".add_fav_solid","click",function(){  
           var $this  = $(this);
        var pro_id = $(this).attr('id');  
        $.ajax({
          url:"<?php echo Yii::app()->request->getBaseUrl(true)?>/home/removeFav/",
            type:"post",
            data:"pro_id="+pro_id ,       
            success:function (data){
               
                console.log(data);
                 $this.children(".fav-number").text(data);
                
       //$this.attr('class',"fav_icon add_fav_solid"');
         $this.prop('class',"fav_icon add_fav");
//        $(this).toggleClass('add_fav_solid');
   
             //   return true;
            } 
        });
        });
        
    });
    
</script>







<script>
    /* 
     $(function() {
     $( "#slider-price" ).slider({
     range: true,
     min: 0,
     max: 400,
     values: [ 200, 300 ],
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


<!--
<script>
    function getProdcutId(p) {
       <?php  //echo die; ?>
         var product_id=p;
        
        $.ajax({
            url:"<?=Yii::app()->request->baseUrl?>/home/addFav/"+product_id,
            success:function (data){
                return true;
            } 
        });
    }
    
</script>

<script>
    function removefav(p) {
       <?php  //echo die; ?>
         var product_id=p;
        
        $.ajax({
            url:"<?=Yii::app()->request->baseUrl?>/home/removeFav/"+product_id,
            success:function (data){
                return true;
            } 
        });
    }
    
</script>-->
