</div>
</div>

<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>
<div class="container">
    <div class="wrap">
        <div class="col-md-12 col-xs-12">
            <ul class="page_path wp4 delay-05s animated fadeInRight">
                <li><a href="<?= Yii::app()->request->baseUrl ?>">Home</a> >></li>
                <li><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>"><?= $controller ?></a> >></li>
                <?php if (isset($_REQUEST['cat_id'])) { ?>
                    <li class="active"><a href="javascript:void(0);"><?php echo ProductCategory::model()->findByPk($_REQUEST['cat_id'])->title; ?></a></li>
                <?php } ?>
            </ul>
        </div>

    </div>
</div>




<div class="container">
    <div class="wrap">
        <div class="col-md-12">
            <div class="categ-title"><?php echo ProductCategory::model()->findByPk($_REQUEST['cat_id'])->title; ?>

                <div class="btn-group pull-right">
                    <a class="btn btn-default toggle-big1 active" href="#"><i class="fa fa-th"></i></a>
                    <a class="btn btn-default toggle-big2" href="#"><i class="fa fa-th-large"></i></a>
                    <a class="btn btn-default toggle-big3" href="#"><i class="fa fa-align-justify"></i></a>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="wrap">
        <div class="col-md-12">
            <div class="sort">
                <span>sort by:</span>
                <select class="form-control sort-select" onchange="insertParam('sort', this.value)">
                    <option value="title asc">Product name (ASC)</option>
                    <option value="title desc">Product name (DESC)</option>
                    <option value="id asc">Recently added (ASC)</option>
                    <option value="id desc">Recently added (DESC)</option>
                </select>

                <!--                <ul class="featured_pag pagination wp4 animated fadeInRight">
                                      <li><a href="#">«</a></li>
                                      <li class="active"><a href="#">1</a></li>
                                      <li><a href="#">2</a></li>
                                      <li><a href="#">3</a></li>
                                      <li><a href="#">4</a></li>
                                      <li><a href="#">5</a></li>
                                      <li><a href="#">»</a></li>
                                    </ul>-->
                <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'htmlOptions' => array('class' => 'featured_pag pagination wp4 animated fadeInRight'),
                    'firstPageLabel' => '&lt;&lt;',
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

<div class="container">
    <div class="wrap">


        <div class="col-md-3 col-xs-12 left-pan">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    if (isset($_REQUEST['cat_id'])) {
                        echo ProductCategory::model()->findByPk($_REQUEST['cat_id'])->title;
                        $subCats = SubCategory::model()->findAll(array('condition' => 'product_category_id=' . $_REQUEST['cat_id']));
                    } else {
                        echo $controller;
                        $cats = ProductCategory::model()->findAll(array('condition' => 'category_id=4'));
                    }
                    ?></div>
                <div class="panel-body left-menu">
                    <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav1">SUB-CATEGORIES</button>

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
                        </ul>

                    </div>

 <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav2">
                            BRAND
                        </button>

                        <div id="nav2" class="collapse">
                            <ul class="nav nav-pills nav-stacked">
                                <?php
                                if ($brands) {
                                    foreach ($brands as $brand) {
                                        echo '<li><a href="javascript:void(0);" onclick="insertParam(\'brand\',' . $brand->id . ')">' . $brand->title . '</a></li>';
                                    }
                                }
                                ?>
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

                    <!--                    <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav3">
                                            discount
                                        </button>
                    
                                        <div id="nav3" class="collapse">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#">30%</a></li>
                                                <li><a href="#">30%</a></li>
                                                <li><a href="#">50%</a></li>
                                                <li><a href="#">40%</a></li>
                                                <li><a href="#">20%</a></li>
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
        $sizes=Sizes::model()->findAll(array('condition' => 'category_id=4'));
        foreach ($sizes as $size) {
      
            ?>
<!--  <li><a onclick="insertParam('size2',<?php   echo $size->title  ; ?>)"    href="javascript:void(0);"   ><?php // echo $size->title  ; ?></a></li>-->
  
  <li><a href="javascript:void(0);" onclick="insertParam('size',<?= $size->id ?>)"> <?= $size->title ?></a></li>
         

        <?php
        }
        
        ?>
        

    </ul>

</p>

        </div>
        <div class="col-md-9"> 
            <?php //print_r($products) ?>
            <div class="toggle-div1 open row"> 
                <div class="row items">
                    <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12 item-box">
                                    <div href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="col-md-12 col-sm-12 col-xs-12 item-img">
                                        <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="prod-img">
                                          <?php if($product->flag != 1){ ?>
                                            <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>" alt=""/>
                                          <?php }else{ ?>
                                              
                                              <img src="<?php echo $product->main_image ?>" alt=""/>
                                          
<?php 
                                          } ?>
                                        </a>

                                        <div class="item-cart"><a class="add" href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>">
                                                <i><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/jewelry/item-cart.png"></i>ADD TO CART</a>

                                        </div><!--end item-cart-->


                                    </div>



                                    <div class="item-info">
                                        
                              <a class="item-name" href="<?php echo Yii::app()->getBaseUrl(true) . '/jewelry/item/' . $product->id; ?>"><?= $product->title ?></a>

                                        <span class="item-price"><?= $product->price ?> GBP</span>
                                    </div><!--end item-info-->

                                </div><!--end item-box-->


                            </div>
                            <?php
                        }
                    } else {
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

            <div class="toggle-div2 row"> 
                <div class="row items">
                    <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            ?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12 item-box">
                                    <div href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="col-md-12 col-sm-12 col-xs-12 item-img">
                                        <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="prod-img">
                                            <?php if($product->flag != 1){ ?>
                                            <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>" alt="<?= $product->title ?>"/>
                                            <?php }else{
                                                ?>
                                            <img src="<?php echo $product->main_image ?>"/>
                                            <?php
                                            } ?>
                                        </a>

                                        <div class="item-cart"><a class="add" href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>">
                                         
                                                <i><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/jewelry/item-cart.png"></i>ADD TO CART</a>
                                         
                                    
                                        </div><!--end item-cart-->


                                    </div>



                                    <div class="item-info">
                                        
                          <a class="item-name" href="<?php echo Yii::app()->getBaseUrl(true) . '/jewelry/item/' . $product->id; ?>"><?= $product->title ?></a>

                                        <span class="item-price"><?= $product->price ?> GBP</span>
                                    </div><!--end item-info-->

                                </div><!--end item-box-->


                            </div>

                            <?php
                        }
                    } else {
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

            <div class="toggle-div3 row"> 
                <?php if (!empty($products)) { ?>
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
                                    <td><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="item-img">
                                            <?php if($product->flag != 1){ ?>
                                            <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>" class="table-img">
                                            <?php }else{ ?>
                                            <img src="<?php echo $product->main_image ?>" class="table-img" />
                                            <?php } ?>
                                            <span><?= $product->title ?></span></a></td>
                                    <td><span><?= $product->price ?> GBP</span></td>
                                    <td>
                                        <?php
                                        if (!empty(Yii::app()->user->id)) {
                                            $check = Helper::checkFav($product->id);
                                            if ($check == 1) {
                                                ?>
                                                <a href="javascript:void(0);">In my favorite</a>
                                            <?php } else { ?>
                                                <a href="<?php echo Yii::app()->getBaseUrl(true) . '/home/addFav/' . $product->id; ?>">Add to favorite</a>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <a data-target="#login-modal" data-toggle="modal" data-dismiss="modal" >Add to favorite</a>
                                        <?php } ?>
                                    </td>
                                    <td><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>">Add to cart</a></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                    <?php
                } else {
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
    </div>
</div>
<?php



    $slider_max_price=Product::model()->find(array('condition'=>'category_id = 4', 'order'=>'price desc'))->price;

?>
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