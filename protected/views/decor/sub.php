
<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>
</div>
</div>





<div class="container">
    <div class="wrap">
        <div class="col-md-3 col-sm-3 col-xs-12 left-menu">

            <?php
              if (isset($_REQUEST['cat_id'])) {
                        $title =  ProductCategory::model()->findByPk($_REQUEST['cat_id'])->title;
                        $subCats = SubCategory::model()->findAll(array('condition' => 'product_category_id=' . $_REQUEST['cat_id']));
                    } else {
                        echo $controller;
                        $cats = ProductCategory::model()->findAll(array('condition' => 'category_id=1'));
                    }
                    ?> 
            
            
            
              <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
                <li class="menu-title"><?php echo $title ?></li>

                <?php
                $i = 1;
                foreach ($subCats as $subCat) {
                    if ($type_id == $i) {
                        $class = "active";
                    }
                    else
                        $class = "";
                    $i++;
                    ?>
                    <li class="<?= $class; ?>"><a href="javascript:void(0);" onclick="insertParam('subcat_id',<?= $subCat->id ?>)" href="<?= Yii::app()->request->baseUrl; ?>/decor/sub?subcat_id=<?= $subCat->id ?>"><?= $subCat->title; ?></a></li>
<?php } ?>
            </ul>
            
            <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
                <li class="menu-title">HOME DÉCOR Type</li>

                <?php
                $i = 1;
                foreach ($decortypes as $decortype) {
                    if ($type_id == $i) {
                        $class = "active";
                    }
                    else
                        $class = "";
                    $i++;
                    ?>
                    <li class="<?= $class; ?>"><a href="javascript:void(0);" onclick="insertParam('type_id',<?= $decortype->id ?>)" href="<?= Yii::app()->request->baseUrl; ?>/decor/sub?type_id=<?= $decortype->id ?>"><?= $decortype->title; ?></a></li>
<?php } ?>
            </ul>

            <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
                <li class="menu-title">Home Décor Style</li>

                <?php
                $i = 1;
                foreach ($decorstyles as $decorstyle) {
                    if ($style_id == $i) {
                        $class = "active";
                    }
                    else
                        $class = "";
                    $i++;
                    ?>
                    <li class="<?= $class; ?>"><a href="javascript:void(0);" onclick="insertParam('style_id',<?= $decorstyle->id ?>)" href="<?= Yii::app()->request->baseUrl; ?>/decor/sub?style_id=<?= $decorstyle->id ?>"><?php echo $decorstyle->title; ?></a></li>
<?php } ?>


            </ul>
            
             <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
                <li class="menu-title">Brand</li>

                <?php
             if ($brands) {
                                    foreach ($brands as $brand) { ?>
                    <li class="<?= $class; ?>"><a href="javascript:void(0);" onclick="insertParam('brand',<?= $brand->id ?>)" href="<?= Yii::app()->request->baseUrl; ?>/decor/sub?style_id=<?= $brand->id ?>"><?php echo $decorstyle->title; ?></a></li>
             <?php } }?>


            </ul>
            
            
             <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
                <li class="menu-title">Shops</li>

                 <?php 
                            if ($users) {
                                foreach ($users as $user) {
                                    $user_details = UserDetails::model()->find("user_id=$user->id");
                                    if($user_details ->shop_name != '')
                                    ?>
                    <li class="<?= $class; ?>"><a href="javascript:void(0);" onclick="insertParam('shop',<?= $user->id ?>)" href="<?= Yii::app()->request->baseUrl; ?>/decor/sub?style_id=<?= $user->id ?>"><?php echo $user_details->shop_name; ?></a></li>
                            <?php }} ?>


            </ul>
            
            
            
            
    <p class="amount" >
        <label for="price">Price range:</label>
        <input type="text" id="price" readonly>
    </p>

    <div id="slider-price"></div>


    <p class="amount" >
        <label for="price">Sizes:</label>

    <ul class="sizes">
        
        <?php
        $sizes=Sizes::model()->findAll(array('condition' => 'category_id=6'));
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

            
            
        </div><!--end menu-->



        <div class="col-md-9 col-sm-9 col-xs-12 latets-design">
            <span class="menu-title">Search Result</span>

            <div class="col-md-12 col-xs-12 items">

<?php foreach ($prods as $prod) { ?>
                <div class="col-md-6 col-xs-12">
                    <div href="#" class="item-design">
                        <a href="<?= Yii::app()->request->baseUrl; ?>/decor/details/id/<?= $prod->id ?>">
                           <?php if($prod->flag != 1){ ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?= $prod->main_image; ?>"  alt="" />
                           <?php }else{
                               ?>
                           <img src="<?= $prod->main_image; ?>"  alt="" /> 
                            <?php
                           } ?>
                        </a>
                        <div class="col-md-11 col-xs-11 item-name">
                            <a href="<?= Yii::app()->request->baseUrl; ?>/decor/details/id/<?= $prod->id ?>"><?php echo Helper::limit_words($prod->title, 2); ?></a>
                        </div>

                        <div class="price_tag">
                            <p class="item_price"><?php echo $prod->price; ?> GBP</p>

                        </div>

                    </div>
                    </div>
<?php } ?>

            </div><!--end items-->




            <div class="col-md-12 col-xs-12">

                <!--    
                <ul style="margin-top:20px;" class="featured_pag pagination wp4 animated fadeInRight pull-right">
                                      <li><a href="#">«</a></li>
                                      <li class="active"><a href="#">1</a></li>
                                      <li><a href="#">2</a></li>
                                      <li><a href="#">3</a></li>
                                      <li><a href="#">4</a></li>
                                      <li><a href="#">5</a></li>
                                      <li><a href="#">»</a></li>
                                    </ul>-->


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
                    'htmlOptions' => array('style' => 'margin-top:20px;',
                        '                   class' => 'featured_pag pagination wp4 animated fadeInRight pull-right'), // class of pag div
                    'firstPageLabel' => '&lt;&lt;',
                    //'prevPageLabel' => '»',
                    //'nextPageLabel' => '«',
                    'lastPageLabel' => '&gt;&gt;',
                    'header' => '',
                ))
                ;
                ?>



            </div>
        </div><!--end latest-design-->
    </div>
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





<?php
    $slider_max_price=Product::model()->find(array('condition'=>'category_id = 6', 'order'=>'price desc'))->price;

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

<style>
    
    
/* ---- sizes --- */
.sizes{
    padding: 0;
}
.sizes li{
    float: left;
    list-style-type: none;
    margin: 0 5px 5px 0;
}

.sizes li a{
    border: 1px solid #D12B49;
    text-align: center;
    display: block;
    width: 45px;
    height: 25px;
    line-height: 25px;
    transition: all .5s ease-in-out;
}

.sizes li a:hover{
    background: #D12B49;
    border: 1px solid #f6f6f6;
    color: #FFF;
}
/* ---- sizes --- */

/* --- color --- */
.colors{
    padding: 0;
}

.colors li {
    width:25px;
    height:25px;
    float:left;
    list-style:none;
    margin: 2px;
}

.colors a {
    width:25px;
    height:25px;
    display: block;
    width: 100%;
    height: 100%;
}
/* --- color --- */
.seller-link
{
	float:right !important;
	font-size:18px;
	font-weight:600;
}


</style>