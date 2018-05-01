</div>
</div>

<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>
<div class="container">
    <div class="wrap">
        <ol class="breadcrumb">
            <li><a href="<?= Yii::app()->request->baseUrl ?>/home">Home</a></li>
            <li><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>"><?= $controller ?></a></li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php
                        if (isset($_REQUEST['cat_id'])) {
                            echo ProductCategory::model()->findByPk($_REQUEST['cat_id'])->title;
                            $subCats = SubCategory::model()->findAll(array('condition' => 'product_category_id=' . $_REQUEST['cat_id']));
                        } else {
                            echo $controller;
                            $cats = ProductCategory::model()->findAll(array('condition' => 'category_id=3'));
                        }
                        ?></div>
                    <div class="panel-body left-menu">
                        <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#nav1">SUB-CATEGORIES</button>

                        <div id="nav1" class="collapse in">
                            <ul class="nav nav-pills nav-stacked">
                                <?php
                                if ($subCats){
                                    foreach ($subCats as $sub){
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
                                        echo '<li><a href="javascript:void(0);" onclick="insertParam(\'brand_id\',' . $brand->id . ')">' . $brand->title . '</a></li>';
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
        $sizes=Sizes::model()->findAll(array('condition' => 'category_id=3'));
        foreach ($sizes as $size) {
      
            ?>
  
  <li><a href="javascript:void(0);" onclick="insertParam('size',<?= $size->id ?>)"> <?= $size->title ?></a></li>
         

        <?php
        }
        
        ?>
        

    </ul>
            </p>
            
       <label for="price">Gender:</label> <br> 
       <div class="gender-radio" >
           <input type="radio" name="gender" value="male" onclick="insertParam('gender',0)">Men</div>
       <div class="gender-radio" >
           <input type="radio" name="gender" value="female" onclick="insertParam('gender',1)">Women</div>
<div class="clearfix"></div>

                <div class="panel panel-default">
                    <div class="panel-heading">SPECIAL</div>
                    <div class="panel-body special">
                        <?php
                        if ($featured_products) {
                            foreach ($featured_products as $i => $fp) {
                                if ($fp->price) {
                                    $price = $fp->price . ' GBP';
                                } else {
                                    $min_price = Size::model()->find(array('condition' => 'product_id=' . $fp->id, 'order' => 'price asc'))->price;
                                    $price = 'Starting from ' . $min_price . 'GBP';
                                }
                                ?>
                                <div class="products">
                                    <a href="javascript:void(0)" class="product-img"><img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $fp->main_image ?>"></a>
                                    <span class="price"><?= $price ?></span>
                                     <a class="title" href="<?php echo Yii::app()->getBaseUrl(true) . '/cosmetic/item/' . $fp->id; ?>"><?php echo $fp->title; ?></a>
                                    <span class="desc"><?= substr($fp->description, 0, 50) ?></span>
                                    <span class="cart-btn"><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="add-cart">Details</a></span>
                                </div>
                                <?php
                                if ($i == 0) {
                                    echo '<hr>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
            <div class="col-md-9">


                <div class="head">Eye
                    <div class="btn-group pull-right">
                        <a class="toggler toggle-big1 active" href="javascript:void(0)"><i class="fa fa-th"></i></a>
                        <a class="toggler toggle-big2" href="javascript:void(0)"><i class="fa fa-th-large"></i></a>
                        <a class="toggler toggle-big3" href="javascript:void(0)"><i class="fa fa-align-justify"></i></a>

                    </div>

                </div>
                
                
                
                <div class="sorting">
                    <div class="pull-left">
                        Sort By: <select onchange="insertParam('sort', this.value)">
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
                    'firstPageLabel' => '&lt;&lt;',
                    //'prevPageLabel' => '»',
                    //'nextPageLabel' => '«',
                    'lastPageLabel' => '&gt;&gt;',
                    'header' => '',
                ))
                ;
                ?>
              
              
                        <?php
                        /*
                        $this->widget('CLinkPager', array(
                            'pages' => $pages,
                            'cssFile' => Yii::app()->theme->baseUrl . "/css/bootstrap.css",
                            'firstPageLabel' => '&lt;&lt;',
                            'prevPageLabel' => '&lt;',
                            'nextPageLabel' => '&gt;',
                            'lastPageLabel' => '&gt;&gt;',
                            'header' => '',
                        ))
                        ;
                        */
                        ?>
                    
                </div>
                
                
                   <div class="toggle-div1 open row"> 
                    <div class="row product-row">
                        <?php
                        if($products){
                            foreach ($products as $i => $product) {
                                if ($product->price) {
                                    $pro_price = $product->price . ' GBP';
                                } else {
                                    $pro_min_price = Size::model()->find(array('condition' => 'product_id=' . $product->id, 'order' => 'price asc'))->price;
                                    $pro_price = 'Starting from ' . $pro_min_price . 'GBP';
                                }
                                if(($i % 3) == 0 && $i != 0){
                                    ?>
                                </div>
                                <hr>
                                <div  class="row product-row">
                                <?php
                                }
                                ?>
                                <div class="col-md-4">
                                    <div class="products">
                                        <a href="javascript:void(0)" class="product-img">
                                               <?php if($product->flag != 1){ ?>
                                    <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>">
                                <?php }else{
                                    ?>
                                    <img src="<?= $product->main_image ?>">
                                    <?php
                                } ?>
                                        </a>
                                        <span class="price"><?= $pro_price ?></span>
                         <a class="title" href="<?php echo Yii::app()->getBaseUrl(true) . '/cosmetic/item/' . $product->id; ?>"><?php echo $product->title; ?></a>
                            
                                        <span class="desc"><?= substr($product->description, 0, 50) ?></span>
                                        <!--<span class="cart-btn"><a href="javascript:void(0)" class="add-cart"><img src="<?= Yii::app()->request->baseUrl ?>/img/<?= Yii::app()->controller->id ?>/add-cart.png">Add to cart</a></span>-->
                                        <span class="cart-btn"><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="add-cart">Details</a></span>
                                    </div>
                                </div>
                        <?php
                            }
                        }else{
                            ?>
                                <div class="nofound">
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
                    <div class="row product-row">
                        <?php
                        if($products)
                        {
                            foreach ($products as $i => $product) {
                                if ($product->price) {
                                    $pro_price = $product->price . ' GBP';
                                } else {
                                    $pro_min_price = Size::model()->find(array('condition' => 'product_id=' . $product->id, 'order' => 'price asc'))->price;
                                    $pro_price = 'Starting from ' . $pro_min_price . 'GBP';
                                }
                                if (($i % 2) == 0 && $i != 0) {
                                    ?>
                                </div>
                                <hr>
                                <div  class="row product-row">
                                    <?php
                                }
                                ?>
                                <div class="col-md-6">
                                    <div class="products">
                                        <a href="javascript:void(0)" class="product-img">
                                                <?php if($product->flag != 1){ ?>
                                    <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>">
                                <?php }else{
                                    ?>
                                    <img src="<?= $product->main_image ?>">
                                    <?php
                                } ?>
                                        </a>
                                        <span class="price"><?= $pro_price ?></span>
                        <a class="title" href="<?php echo Yii::app()->getBaseUrl(true) . '/cosmetic/item/' . $product->id; ?>"><?php echo $product->title; ?></a>

                                        <span class="desc"><?= substr($product->description, 0, 50) ?></span>
                                        <!--<span class="cart-btn"><a href="javascript:void(0)" class="add-cart"><img src="<?= Yii::app()->request->baseUrl ?>/img/<?= Yii::app()->controller->id ?>/add-cart.png">Add to cart</a></span>-->
                                        <span class="cart-btn"><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="add-cart">Details</a></span>
                                    </div>
                                </div>
                                <?php
                            }
                        }else{
                            ?>
                                    <div class="nofound">
                                    <div class="alert alert-danger">
                                    <p>No products found</p>
                                    </div></div>
                            <?php
                        }
                        ?>
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
                                    $ids=array();
                                    if($products)
                                    {
                                        foreach ($products as $product)
                                        {
                                            if ($product->price) {
                                                $pro_price = $product->price . ' GBP';
                                            } else {
                                                $pro_min_price = Size::model()->find(array('condition' => 'product_id=' . $product->id, 'order' => 'price asc'))->price;
                                                $pro_price = 'Starting from ' . $pro_min_price . 'GBP';
                                            }
                                            $ids[]=$product->id;
                                ?>
                                            <tr>
                                                <td><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="table-img">
                                                            <?php if($product->flag != 1){ ?>
                                                        <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>" class="table-img">
                                <?php }else{
                                    ?>
                                    <img src="<?= $product->main_image ?>">
                                    <?php
                                } ?>
                                                        <span><?php echo Helper::limit_words($product->title, 5); ?>></span></a></td>
                                                <td><span><?= $pro_price ?></span></td>
                                                <td><?= substr($product->description, 0, 50) ?></td>
                                                <td><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>">details</a></td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                        ?>
                                        	<div class="nofound">
                                    <div class="alert alert-danger">
                                    <p>No products found</p>
                                    </div></div>
                                        <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                </div>
            
                
                
                
                </div>

             
            
            
<!--             <ul class="pagination pull-right">
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
        </div>

        <!-- InstanceEndEditable -->



    </div>
</div>
<?php
if($ids)
{
    $slider_max_price=Size::model()->find(array('condition'=>'product_id in (select id from product where category_id=3)', 'order'=>'price desc'))->price;
}
?>
<script>
    $(function() {
        $("#slider-price").slider({
            range: true,
            min: 0,
            max: <?=$slider_max_price?>,
            <?php
                if(isset($_REQUEST['price']))
                {
                    $arr=  explode('_', $_REQUEST['price']);
                    $min= $arr[0];
                    $max=$arr[1];
                }
                else
                {
                    $min=0;
                    $max=$slider_max_price;
                }
            ?>
            values: [<?=$min?>, <?=$max?>],
            slide: function(event, ui) {
                $("#price").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
                insertParam("price", ui.values[ 0 ]+"_"+ui.values[ 1 ]);
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