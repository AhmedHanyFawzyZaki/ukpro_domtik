<div class="row">
    <div class="col-md-9">
        <div id="carousel-example-generic" class="carousel slide animated fadeInUp clothes_slider delay-05s" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">

                <?php
                $i = 0;
                foreach ($catsliders as $catslider):
                    if ($i == 0) {
                        $class = "active";
                    } else
                        $class = "";
                    ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php echo $class; ?>"></li>


                    <?php
                    $i++;
                endforeach;
                ?>

            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">



                <?php
                $i = 0;
                foreach ($catsliders as $catslider) {

                    if ($i == 0) {
                        $class = "active";
                    } else {
                        $class = "";
                    }


                    if (!empty($catslider->link)) {
                        $link = $catslider->link;
                    } else {
                        $link = Yii::app()->request->baseUrl . '/' . 'cloths' . '/item/' . $catslider->product_id;
                    }
                    ?> 
                    <div class="item <?php echo $class; ?>">
                        <a href="<?php echo $link; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/media/categoryslider/<?php echo $catslider->image; ?>" alt=""></a>
<!--                        <div class="carousel-caption">
                            <a href="<?php echo $link; ?>">
                                <p class="slider_title"><?php echo $catslider->title; ?></p>
                                <p class="slider_sub_text"><?php echo $catslider->description; ?></p>
                            </a>
                        </div>-->
                    </div>


                    <?php
                    $i++;
                }
                ?>


            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <div class="halfCircleRight"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/left_arrow.png"/> </div>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <div class="halfCircleLeft"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/right_arrow.png"/> </div>
            </a>
        </div>
    </div>
    <div class="col-md-3 animated pulse ad1">
           <?php if($main_ad){ 
               if($main_ad->product_id !=null){
                   $link = Yii::app()->getBaseUrl(true)."/cloths/item/$main_ad->product_id";
               }else{
                   $link = $main_ad->link;
               }
               ?>
        
            <a href="<?= $link?>"><img src="<?php echo Yii::app()->request->baseUrl ."/media/ads/$main_ad->image"?>"></a>
           <?php  } ?>
        </div>
</div>

<div class="row ads">
    <?php if($ads){
     foreach ($ads as $ad){
         if($ad->product_id !=null){
                   $link = Yii::app()->getBaseUrl(true)."/cloths/item/$ad->product_id";
               }else{
                   $link = $ad->link;
               }
         ?>
    <a href="<?= $link ?>" class="col-md-3"><img src="<?php echo Yii::app()->request->baseUrl ."/media/ads/$ad->image"?>"></a>
      
    <?php
     }
    } ?>
        
<!--        <a href="#" class="col-md-3"><img src="<?=Yii::app()->request->baseUrl?>/img/cosmetic/ad1.jpg"></a>
        <a href="#" class="col-md-3"><img src="<?=Yii::app()->request->baseUrl?>/img/cosmetic/ad1.jpg"></a>
        <a href="#" class="col-md-3"><img src="<?=Yii::app()->request->baseUrl?>/img/cosmetic/ad1.jpg"></a>
   -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-3 specials">
            <p class="sections_title">Specials</p>



            <?php
            $criteria = new CDbCriteria;
            $criteria->condition = 'category_id=1 and old_price != "" ';
           // $criteria->condition = ' and old_price != "" ';
            $criteria->limit = '2';
            $prods = Product::model()->findAll($criteria);
           // print_r($prods);die;

            foreach ($prods as $product) {
               
                ?>
                <div class="one_special_item animated flipInX delay-05s">

                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/id/<?php echo $product->id; ?>">
                        <div class="special_item">
                            <div class="inner_item">
                                <?php if($product->flag != 1){ ?>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $product->main_image; ?>" width="480"/>
                                <?php }else{ ?>
                               <img src="<?php echo $product->main_image ?>" width="480"/> 
                                <?php } ?>
                            </div>
                        </div>

                        <div class="sale_tag">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/sale.png" />
                        </div>

                        <div class="price_tag">
                            <p class="item_name"><?php echo $product->title; ?></p>
                            <p class="item_price"><?php echo $product->price; ?> GBP</p>
                            <p class="item_before_price"><?php echo $product->old_price; ?> GBP</p>
                        </div>
                    </a>
                </div>


<?php } ?>


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

<?php foreach ($products as $product) { 
    $favs = count(Favourite::model()->findAll("product_id = $product->id"));
    ?>	


                    <div class="col-md-4 wp4 one_featured_item">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/<?php echo $product->id; ?>" class="item_img">
                          <?php  if($product->flag != 1){ ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $product->main_image; ?>">
                          <?php }else{
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
                        <a class="fav_icon add_fav_solid" href="javascript:void(0);" id="<?php echo  $product->id;?>"><span class="fav-number"><?php echo $favs ?></span></a>
                            <?php } else { ?>
                                <a class="add_fav fav_icon" href="javascript:void(0);" id="<?php echo  $product->id;?>"><span class="fav-number"><?php echo $favs ?></span></a>
                                <?php
                            }
                        } else {
                            ?>
                            <a data-target="#login-modal" data-toggle="modal" data-dismiss="modal" id="<?php echo  $product->id;?>" class="add_fav fav_icon"><span class="fav-number"><?php echo $favs ?></span></a>
                        <?php } ?>   

                        <div class="price_tag">
                        <a class="item_name" href="<?php echo Yii::app()->getBaseUrl(true) . '/cloths/item/' . $product->id; ?>"><?php echo $product->title; ?></a>
                            <p class="sp_item_price item_price"><?php echo $product->price; ?> GBP</p>
                        </div>






                    </div>

<?php } ?>   


            </div>

            <div class="toggle-div2 row">                    
<?php foreach ($products as $product) {
        $favs = count(Favourite::model()->findAll("product_id = $product->id"));
    ?>	


                    <div class="col-md-4 wp4 one_featured_item">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/<?php echo $product->id; ?>" class="item_img">
                            <?php  if($product->flag != 1){ ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $product->main_image; ?>">
                            <?php }else{
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
                        <a class="fav_icon add_fav_solid" href="javascript:void(0);" id="<?php echo  $product->id;?>"><span class="fav-number"><?php echo $favs ?></span></a>
                            <?php } else { ?>
                                <a class="add_fav fav_icon" href="javascript:void(0);" id="<?php echo  $product->id;?>" ><span class="fav-number"><?php echo $favs ?></span></a>
                                <?php
                            }
                        } else {
                            ?>
                            <a data-target="#login-modal" data-toggle="modal" data-dismiss="modal" id="<?php echo  $product->id;?>" class="add_fav fav_icon"></a>
                        <?php } ?>   
                        <div class="price_tag">
                        <a class="item_name" href="<?php echo Yii::app()->getBaseUrl(true) . '/cloths/item/' . $product->id; ?>"><?php echo $product->title; ?></a>
                            <p class="sp_item_price item_price"><?php echo $product->price; ?> GBP</p>
                        </div>






                    </div>

<?php } ?>   


            </div>

            <div class="toggle-div3 row">
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

<?php foreach ($products as $product) { 
    $favs = count(Favourite::model()->findAll("product_id = $product->id"));
    ?>
                            <tr>
                                <td><a href="<?php echo Yii::app()->getBaseUrl(true) . '/cloths/item/' . $product->id; ?>" class="item-img">
                                        <?php if($product->flag != 1){ ?>
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $product->main_image; ?>" class="table-img">
                                        <?php }else{
                                            ?>
                                        <img src="<?php echo $product->main_image; ?>" class="table-img">
                                        <?php
                                        } ?>
                                        <span><?php echo Helper::limit_words($product->title , 10); ?></span></a></td>
                                <td><span><?php echo $product->price; ?></span></td>

                                <td>
    <?php
    if (!empty(Yii::app()->user->id)) {
        $check = Helper::checkFav($product->id);
        if ($check == 1) {
            ?>
            <a  href="javascript:void(0);" id="<?php echo $product->id ?>" >Remove from favorite</a>

                                        <?php } else { ?>
                                <a  href="javascript:void(0);" id="<?php echo $product->id ?>" >Add To Favourite</a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a  data-target="#login-modal" data-toggle="modal" id="<?php echo $product->id ?>" data-dismiss="modal" >Add to favorite</a>
                                    <?php } ?>
                                </td>                                       

                                <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/id/<?php echo $product->id; ?>">Add to cart</a></td>
                            </tr>

<?php } ?>
                    </tbody>
                </table>

            </div>

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
    </div>
</div>
<div class="row">
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
foreach ($arrivls as $arrivl) {
    if ($s == 5) {
        $s = 1;
        ?>
                        </div>
                        <div class="item">
                            <?php
                        }
                        ?>

                        <div class="col-md-3 col-xs-6 text-center">
                            <a href="<?= Yii::app()->request->baseUrl; ?>/cloths/item/id/<?= $arrivl->id ?>" class="new_arr_item">
                                <div class="item_img">
                                    <?php if($arrivl->flag !=1){ ?>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $arrivl->main_image; ?>"/>
                                    <?php }else{ ?>
                                    <img src="<?php echo $arrivl->main_image; ?>"/>
                                    <?php } ?>
                                </div>
                                <p class="item_name"><?= $arrivl->title ?></p>
                                <p class="new_arr_price"><?= $arrivl->price; ?> GBP</p>
                            </a>
                        </div>


    <?php
    $s++;
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


<!--<script>
    function getProdcutId(p) {
       <?php  //echo die; ?>
         var product_id=p;
        
        $.ajax({
            url:"<?=Yii::app()->request->baseUrl?>/home/addFav/"+product_id,
            success:function (data){
                console.log(data);
                console.log($(this).attr('class'));
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
