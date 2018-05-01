</div>
</div>
<?php
$controller = Yii::app()->controller->id;
?>
<div class="container">
    <div class="wrap">

        <div class="col-md-3 col-md-offset-0 col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 search animated pulse">
            <p class="form-title">find the car you want</p>
            <form class="form-horizontal" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true) . '/' . $controller; ?>/search">
              
<!--                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" name="Search[make]">
                            <option value="">Select Make...</option>
                            <?php
                            if ($makes) {
                                foreach ($makes as $make) {
                                    ?>
                                    <option value="<?php echo $make->id; ?>"><?php echo $make->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" name="Search[model]">
                            <option value="">Select Model...</option>
                            <?php
                            if ($motormodels) {
                                foreach ($motormodels as $motormodel) {
                                    ?>
                                    <option value="<?php echo $motormodel->id; ?>"><?php echo $motormodel->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
               
                -->
                  
 <div class="form-group">
     <div class="col-sm-12">
                        <select class="form-control" name="Search[make]" id="makee" onchange="calldropdown()">

                            <option value=""> Make(any)</option>

                            <?php
                            if ($makes) {
                                foreach ($makes as $make) {


                                    if ($make->id == $mak) {

                                        $selected = 'selected';
                                    } else {

                                        $selected = '';
                                    }
                                    ?>
                                    <option  value="<?php echo $make->id; ?> "   <?php echo $selected ?> ><?php echo $make->title; ?></option>
                                    <?php
                                }
                            }
                            ?>

                        </select>
     </div>
                    </div>
                
                    <div class="form-group" id='makemodel'>
                        <div class="col-sm-12">
                        <select class="form-control" name="Search[model]">
                            <option value=""> Model(any)</option>
                            <?php
                            
                                $motormodls = MotorModel::model()->findAll();
                              


                            if ($motormodls) {
                                foreach ($motormodls as $motormodel) {


                                    if ($motormodel->id == $mod) {

                                        $selected = 'selected';
                                    } else {

                                        $selected = '';
                                    }
                                    ?>
                                    <option value="<?php echo $motormodel->id; ?>   " <?= $selected ?>><?php echo $motormodel->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        </div>
                    </div>

              
                <div class="form-group">

                    <div class="col-sm-6">
                        <input type="text" name="Search[min_price]"  placeholder="Min Price" id="inputEmail3" class="form-control">
                    </div>

                    <div class="col-sm-6">
                        <input type="text" name="Search[max_price]"  placeholder="Max Price" id="inputEmail3" class="form-control">
                    </div>
                </div>
                
                
                <a href="#" class="collapsed more-options" data-toggle="collapse" data-target="#srch-select">more options</a>
                
                <div class="collapse" id="srch-select">
                  <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" name="Search[gas]">
                            <option value="">Select Gas...</option>
                            <?php
                            if ($gass) {
                                foreach ($gass as $ga) {
                                    ?>
                                    <option value="<?php echo $ga->id; ?>"><?php echo $ga->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                                    <option value="">Unlisted</option>
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" name="Search[door]">
                            <option value="">Select Doors...</option>
                            <?php
                            if ($doors) {
                                foreach ($doors as $door) {
                                    ?>
                                    <option value="<?php echo $door->id; ?>"><?php echo $door->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                                    <option value="">Unlisted</option>
                        </select>
                    </div>
                </div>
                

                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" name="Search[kmage]">
                            <option value="">Select Kmages...</option>
                            <?php
                            if ($kmages) {
                                foreach ($kmages as $kmage) {
                                    ?>
                                    <option value="<?php echo $kmage->id; ?>"><?php echo $kmage->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                                    <option value="">Unlisted</option>
                        </select>
                    </div>
                </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" name="Search[age]">
                            <option value="">Select Ages...</option>
                            <?php
                            if ($ages) {
                                foreach ($ages as $age) {
                                    ?>
                                    <option value="<?php echo $age->id; ?>"><?php echo $age->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                   <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" name="Search[emission]">
                            <option value="">Select emissions...</option>
                            <?php
                            if ($emissions) {
                                foreach ($emissions as $emission) {
                                    ?>
                                    <option value="<?php echo $emission->id; ?>"><?php echo $emission->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                                    <option value="">Unlisted</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" name="Search[engine]">
                            <option value="">Select engines...</option>
                            <?php
                            if ($engines) {
                                foreach ($engines as $engine) {
                                    ?>
                                    <option value="<?php echo $engine->id; ?>"><?php echo $engine->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                                    <option value="">Unlisted</option>
                        </select>
                    </div>
                </div>
                    
                     <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" name="Search[power_engine]">
                            <option value="">Select power engines...</option>
                            <option value="1">100cv</option>
                            <option value="2">200cv</option>

                        </select>
                    </div>
                </div>
  <div class="form-group">
      <label class="col-md-12 col-sm-4 col-xs-12 control-label " style=" text-align:left !important;" > Motor Status</label>
<div class="col-sm-12">
          <label class=" " >

    <input type="checkBox" name="Search[motor_status1]" value="1"> 
    Used </label>   
    <label class=" " >
    <input type="checkBox" name="Search[motor_status2]" value="2">
    Nearly new</label>   
    
    <label class=" " >

    <input type="checkBox" name="Search[motor_status3]" value="3">
    New</label>
    </div>
       
  </div>
  
  </div>
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-default search-bt" type="submit">search</button>
                    </div>
                </div>


                
            </form>

        </div><!--end search-->

        <div class="col-md-9 col-xs-12 car-slider">
            <div id="carousel" class="carousel slide animated pulse" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php
                    if ($slides) {
                        foreach ($slides as $i => $slide) {
                            $class = '';
                            if ($i == 0) {
                                $class = 'active';
                            }
                            echo '<li data-target="#carousel" data-slide-to="' . $i . '" class="' . $class . '"></li>';
                        }
                    }
                    ?>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php
                    if ($slides) {
                        foreach ($slides as $i => $slide) {
                            $class = 'item';
                            if ($i == 0) {
                                $class = 'item active';
                            }
                            if ($slide->link) {
                                $link = $slide->link;
                            } else {
                                $link = Yii::app()->request->baseUrl . '/' . $controller . '/item?id=' . $slide->product_id;
                            }
                            echo '<div class="' . $class . '">
                                    <a href="' . $link . '"><img src="' . Yii::app()->request->baseUrl . '/media/categoryslider/' . $slide->image . '" alt="..."></a>
                                </div>';
                        }
                    }
                    ?>
                </div>


            </div>
        </div>

    </div>
</div>
<div class="container">
    <div class="wrap">
        
        <div class="row ads">
    <?php if($ads){
     foreach ($ads as $ad){
             if($ad->product_id !=null){
                   $link = Yii::app()->getBaseUrl(true)."/motor/item?id=$ad->product_id";
               }else{
                   $link = $ad->link;
               }
         ?>
    <a href="<?= $link ?>" class="col-md-4"><img src="<?php echo Yii::app()->request->baseUrl ."/media/ads/$ad->image"?>"></a>
      
    <?php
     }
    } ?>

       
        
        </div>
       
    </div>
</div>

<div class="container">
    <div class="wrap">
        <div class="row">
            <div class="col-md-12 col-xs-12 title">new cars</div>
            <div class="col-md-12 col-xs-12 items animated wp2">

                <?php
                // print_r($products);
                 if($products != null){
                foreach ($products as $newproduct) {
                    $prodetails = ProductDetails::model()->findByAttributes(array('product_id' => $newproduct->id));
                   $favs = count(Favourite::model()->findAll("product_id = $newproduct->id"));
                    ?>
                    <div href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $newproduct->id ?>" class="col-md-4 col-sm-4 col-xs-12 car-item">
                        <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $newproduct->id ?>" class="item-img">
                          <?php if($newproduct->flag != 1){ ?>
                            <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $newproduct->main_image ?>" alt="<?= $newproduct->title ?>" />
                          <?php }else{
                              ?>
                            <img src="<?php echo $newproduct->main_image ?>" alt="<?= $newproduct->title ?>" />
                            <?php
                          } ?>
                        </a>

                        <div class="col-md-11 col-xs-11 item-details">
                            <?php
                            if (!empty(Yii::app()->user->id)) {
                                $check = Helper::checkFav($newproduct->id);
                                if ($check == 1) {
                                    ?>
             <a class="fav_star rate_solid" href="javascript:void(0);" id="<?php echo $newproduct->id ?>"></a>
             <div class="fav-number"><span><?php echo $favs ?></span></div>

                                <?php } else { ?>
             <a class="fav_star rate" href="javascript:void(0);" id="<?php echo $newproduct->id ?>" ></a>
              <div class="fav-number"><span><?php echo $favs ?></span></div>

                                    <?php
                                }
                            } else {
                                ?>
                                <a data-target="#login-modal" data-toggle="modal" id="<?php echo $product->id ?>" data-dismiss="modal" class="fav_star rate" ></a>
                                 <div class="fav-number"><span><?php echo $favs ?></span></div>
                            <?php } ?>
                            <div class="col-md-12 col-xs-12 data">
                                <div class="col-md-6 col-xs-12 data2">
<!--                                    <span><?= $newproduct->title ?></span>-->
                                    
                                    <span>   <a href="<?php echo Yii::app()->getBaseUrl(true) . '/motor/item/' . $newproduct->id; ?>"><?= $newproduct->title ?></a></span>

                                    <span><?= $prodetails->make->title ?></span>
                                    <span><?= $prodetails->motorModel->title ?></span>
                                </div>

                                <div class="col-md-5 col-xs-12 details-link">
                                    <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $newproduct->id ?>" class="btn btn-default" type="button">view details</a>
                                </div><!--end details-link-->
                            </div>
                        </div>
                    </div>
                <?php } } ?>



            </div><!--end items-->

        </div>
    </div>
</div>


</div>
</div>




<script>
   // function getProdcutId(p) {
       <?php  //echo die; ?>
      //   var product_id=p;
        $(function(){
          $(document).delegate(".rate","click",function(){ 
              var $this  = $(this);
        var pro_id = $(this).attr('id');  
        $.ajax({
            url:"<?php echo Yii::app()->request->getBaseUrl(true)?>/home/addFav",
            type:"post",
            data:"pro_id="+pro_id ,       
            success:function (data){
                
                console.log(data);
                $this.next(".fav-number").text(data);
                
       // $(this).toggleClass('add_fav');
        //$this.attr('class',"fav_icon add_fav"');
         $this.prop('class',"fav_star rate_solid");
    
                //return true;
            } 
        });
        });
        
        
          $(document).delegate(".rate_solid","click",function(){  
           var $this  = $(this);
        var pro_id = $(this).attr('id');  
        $.ajax({
          url:"<?php echo Yii::app()->request->getBaseUrl(true)?>/home/removeFav/",
            type:"post",
            data:"pro_id="+pro_id ,       
            success:function (data){
               
                console.log(data);
                 $this.next(".fav-number").text(data);
                
       //$this.attr('class',"fav_icon add_fav_solid"');
         $this.prop('class',"fav_star rate");
//        $(this).toggleClass('add_fav_solid');
   
             //   return true;
            } 
        });
        });
        
    });
    
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


<script>
    function calldropdown() {
        var mks = document.getElementById("makee").selectedIndex;
        $.ajax({
            url:"<?=Yii::app()->request->baseUrl?>/index.php/motor/Getmodel?id="+mks,
            success: function(data) {
               // $('#makemodel').val(data);
           document.getElementById('makemodel').innerHTML = data;
              // alert(mks);
            }
        }
        );

    }

</script>