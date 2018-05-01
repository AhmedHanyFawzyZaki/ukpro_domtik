<div class="row"> 
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-left side-menu">
        <ul class=mtree>
            <li><a href=""><?php echo $category->title; ?></a>
                <ul>
                    <?php
                    if($allsub){
                   
                    foreach($allsub as $sub){ ?>
                        <li><a href="javascript:void(0);" onclick="insertParam('subcat_id', '<?= $sub->id; ?>')"><?= $sub->title ; ?></a></li>
                    <?php
                    }
                     }
                    ?>
                </ul>
            </li>
        </ul>
        
         <ul class=mtree>
            <li><a href="">Brand</a>
                <ul>
                    <?php
                    if($brands){
                   
                    foreach($brands as $brand){ ?>
                        <li><a href="javascript:void(0);" onclick="insertParam('brand', '<?= $brand->id; ?>')"><?= $brand->title ; ?></a></li>
                    <?php
                    }
                     }
                    ?>
                </ul>
            </li>
        </ul>
        
           <ul class=mtree>
            <li><a href="">Shops</a>
                <ul>
                    <?php
                    if($users){
                   
                    foreach($users as $user){
                         $user_details = UserDetails::model()->find("user_id=$user->id");
                         ?>
                        <li><a href="javascript:void(0);" onclick="insertParam('shop', '<?= $user->id; ?>')"><?= $user_details->shop_name ; ?></a></li>
                    <?php
                    }
                     }
                    ?>
                </ul>
            </li>
        </ul>
        
        <p class="amount" >
            <label for="price">Price range:</label>
            <input type="text" id="price" readonly>
        </p>
        <div id="slider-price"></div>
        
        
        
       
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

    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 contents pull-right">
        <div class="product-content">
            <h1 class="category-name">
                <?php echo $category->title; ?> 
            </h1>
            <div class="category-top">
                <div class="pagination col-sm-6 col-xs-12">
                    <?php
//                    $this->widget('CLinkPager', array(
//                        'pages' => $pages,
//                        'cssFile' => Yii::app()->theme->baseUrl . "/css/bootstrap.css",
//                        'firstPageLabel' => '&lt;&lt;',
//                        'prevPageLabel' => '&lt;',
//                        'nextPageLabel' => '&gt;',
//                        'lastPageLabel' => '&gt;&gt;',
//                        'header' => '',
//                    ))
                   // ;
                    ?>
                </div>
                <div class="select-cat col-sm-6 col-xs-12 pull-left">
                    <label>Sort By : </label>
                    <select class="form-control custom" onchange="insertParam('sort', this.value)">
                        <option value="title desc">product Name</option>
                        <option value="id desc">product Date</option>
                        <option value="price asc">product Price</option>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
                <div class="cbp-vm-options">
                    <a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Grid View</a>
                    <a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">List View</a>
                </div>
                <?php
                if($products){
                ?>
                    <ul>
                        <?php
                        foreach($products as $product){ ?>
                            <li>
                                <div class="product-block wp4">
                                    <a class="cbp-vm-image" href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?= $product->id; ?>">
                                      <?php if($product->flag != 1){ ?>
                                        <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?= $product->main_image; ?>" alt="">
                                      <?php }else{ ?>
                                        <img src="<?= $product->main_image; ?>" alt="">
                                      <?php } ?>
                                    </a>
                                    <a class="cbp-vm-add" href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?= $product->id; ?>">
                                        <span class="boot-tooltip">
                                            <i data-toggle="tooltip" data-original-title="Add to Cart" class="fa fa-shopping-cart"></i>
                                        </span>
                                    </a>
                                    <div class="clearfix"></div>
                                    <h3 class="cbp-vm-title"><?php echo Helper::limit_words($product->title , 10); ?></h3>
                                    <div class="cbp-vm-price"><?= $product->price; ?>GBP</div> 
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                <?php
                }else{ ?>
                    <div class="nofound">
                        <div class="alert alert-danger">
                        <p>No products found</p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="clearfix"></div>
            <div class="pagination">
            <?php
//            $this->widget('CLinkPager', array(
//                'pages' => $pages,
//                'cssFile' => Yii::app()->theme->baseUrl . "/css/bootstrap.css",
//                'firstPageLabel' => '&lt;&lt;',
//                'prevPageLabel' => '&lt;',
//                'nextPageLabel' => '&gt;',
//                'lastPageLabel' => '&gt;&gt;',
//                'header' => '',
//            ))
//            ;
            ?>
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

<?php
$max=Product::model()->find(array('condition'=>'category_id = 7', 'order'=>'price desc'))->price;

?>
<link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/electronic/jquery-ui.css">

  <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/jquery-ui.js"></script>
 <script>
  $(function() {
    $("#slider-price").slider({
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
  </script>
  <?php
if($products)
{
    $max=Product::model()->find(array('condition'=>'category_id = 7', 'order'=>'price desc'))->price;
}
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