
</div>
</div>
<?php
$controller = Yii::app()->controller->id;
?>


<div class="container">
    <div class="wrap">

        <div class="col-md-12 col-xs-12 search animated pulse">
            <p class="form-title">find the car you want now</p>
            <form class="form-horizontal search-form" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true) . '/' . $controller; ?>/search">
                <?php // $makn=$_REQUEST['Search']['make'];?>
                <div class="form-group">

                    <div class="col-md-3 col-sm-6 col-xs-12">
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
                    <div class="col-md-3 col-sm-6 col-xs-12" id='makemodel'>
                        <select class="form-control" name="Search[model]">
                            <option value=""> Model(any)</option>
                            <?php
                            //if (isset($_POST['mks'])) {

                                //echo "test";die;
                                // $motormodls=  MotorModel::model()->findAll();

                                $motormodls = MotorModel::model()->findAll();
                                //print_r($motormodls);
                           /// } else {
                               // $motormodls = $motormodels;
                         //   }


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



                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="text" name="Search[min_price]" placeholder="Min Price"  id="inputEmail3" class="form-control" value="<?php echo $nprice; ?>">
                    </div>

                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="text" name="Search[max_price]" placeholder="Max Price" id="inputEmail3" class="form-control" value="<?php echo $xprice; ?>">
                    </div>


                    <a href="#" class=" col-md-2 col-sm-6 col-xs-12 collapsed more-options " data-toggle="collapse" data-target="#srch-select">more options</a>


                </div>



                <div class="collapse" id="srch-select">

                    <div class="form-group">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[gas]">
                                <option value=""> Gas(any)</option>
<?php
if ($gass) {
    foreach ($gass as $ga) {

        if ($ga->id == $gas) {

            $selected = 'selected';
        } else {

            $selected = '';
        }
        ?>
                                        <option value="<?php echo $ga->id; ?>" <?= $selected ?>><?php echo $ga->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option value="">Unlisted</option>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[door]">
                                <option value=""> Doors(any)</option>
<?php
if ($doors) {
    foreach ($doors as $door) {


        if ($door->id == $dor) {

            $selected = 'selected';
        } else {

            $selected = '';
        }
        ?>
                                        <option value="<?php echo $door->id; ?>" <?= $selected ?>><?php echo $door->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option value="">Unlisted</option>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[kmage]">
                                <option value=""> Kmages(any)</option>
<?php
if ($kmages) {
    foreach ($kmages as $kmage) {

        if ($kmage->id == $mage) {

            $selected = 'selected';
        } else {

            $selected = '';
        }
        ?>
                                        <option value="<?php echo $kmage->id; ?>" <?= $selected ?>><?php echo $kmage->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option value="">Unlisted</option>
                            </select>
                        </div>
                    </div>






                    <div class="form-group">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[age]">
                                <option value=""> Ages(any)</option>
<?php
if ($ages) {
    foreach ($ages as $age) {
        if ($age->id == $ge) {

            $selected = 'selected';
        } else {

            $selected = '';
        }
        ?>
                                        <option value="<?php echo $age->id; ?>" <?= $selected ?>><?php echo $age->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[emission]">
                                <option value="">emissions(any)</option>
                                <?php
                                if ($emissions) {
                                    foreach ($emissions as $emission) {
                                        if ($emission->id == $emiss) {

                                            $selected = 'selected';
                                        } else {

                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?php echo $emission->id; ?>" <?= $selected ?>><?php echo $emission->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option value="">Unlisted</option>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[engine]">
                                <option value="">engines(any)</option>
                                <?php
                                if ($engines) {
                                    foreach ($engines as $engine) {

                                        if ($engine->id == $eng) {

                                            $selected = 'selected';
                                        } else {

                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?php echo $engine->id; ?> <?= $selected ?>"><?php echo $engine->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option value="">Unlisted</option>
                            </select>
                        </div>


                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">

                        <div class="form-group">
                            <select class="form-control" name="Search[power_engine]">
                                <option value="">Select power engines...</option>
                                <option value="1">100cv</option>
                                <option value="2">200cv</option>

                            </select>
                        </div>  
                    </div>
                    <br/><br/>
                    <div class="col-md-6 col-xs-6">
                        <label class="col-md-4 col-sm-4 col-xs-12 control-label "  style="text-align:left !important;">Motor Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px !important;">
                            <label class=" " >
                                <input type="checkBox" name="Search[motor_status1]" value="1"  <?php if (!empty($mot_1)) {
                                    echo "checked";
                                } ?> >
                                Used
                            </label>   
                            <label class=" " >
                                <input type="checkBox" name="Search[motor_status2]" value="2" <?php if (!empty($mot_2)) {
                                    echo "checked";
                                } ?>>
                                Nearly New  
                            </label>      
                            <label class=" " >      
                                <input type="checkBox" name="Search[motor_status3]" value="3" <?php if (!empty($mot_3)) {
                                    echo "checked";
                                } ?>>
                                New</label>  
                        </div>

                    </div>
                </div>

                <div class="form-group">

                    <div class="col-md-12 col-xs-12">




                        <div class="col-md-6 col-xs-6">

                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <button class="btn btn-default search-bt" type="submit">search</button>
                            </div>

                        </div>

                    </div>



                </div>



            </form>

        </div><!--end search-->



    </div>
</div>


<div class="container">
    <div class="wrap">
        <div class="row">

            <div class="col-md-12 col-xs-12 items animated wp2">
<?php
foreach ($products as $product) {
  //  $prodetails = ProductDetails::model()->findAll(array('product_id' => $product->id));
    $favs = count(Favourite::model()->findAll("product_id = $product->id"));
    ?>
                    <div href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="col-md-4 col-sm-4 col-xs-12 car-item">
                        <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="item-img">
                          <?php if($product->flag != 1){ ?>
                            <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>" alt="<?= $product->title ?>" />
                          <?php }else{
                             ?>
                            <img src="<?php echo $product->main_image ?>" alt="<?= $product->title ?>" />
                            <?php
                          } ?>
                        </a>

                        <div class="col-md-11 col-xs-11 item-details">
    <?php
    if (!empty(Yii::app()->user->id)) {
        $check = Helper::checkFav($product->id);
        if ($check == 1) {
            ?>
                                    <a class="fav_star rate_solid" href="javascript:void(0);" id="<?php echo $product->id ?>"></a><div class="fav-number"><span><?php echo $favs ?></span></div>
                                <?php } else { ?>
                                    <a class="fav_star rate" href="javascript:void(0);" id="<?php echo $product->id ?>" ></a><div class="fav-number"><span><?php echo $favs ?></span></div>
                                    <?php
                                }
                            } else {
                                ?>
                                <a data-target="#login-modal" data-toggle="modal" data-dismiss="modal" id="<?php echo $product->id ?>" class="fav_star rate"><div class="fav-number"><span><?php echo $favs ?></span></div></a>
                            <?php } ?>
                            <div class="col-md-12 col-xs-12 data">
                                <div class="col-md-6 col-xs-12 data2">
                                    <span><?= $product->title ?></span>
                                    <span><?= $prodetails->make->title ?></span>
                                    <span><?= $prodetails->motorModel->title ?></span>
                                </div>

                                <div class="col-md-5 col-xs-12 details-link">
                                    <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="btn btn-default" type="button">view details</a>
                                </div><!--end details-link-->
                            </div>
                        </div>
                    </div>
<?php } ?>


                <div class="col-md-12 col-xs-12">
                <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'htmlOptions' => array('class' => 'featured_pag pagination wp4 animated fadeInRight pull-right', 'style' => 'margin-top:20px'),
                    'firstPageLabel' => '<<',
                    //'prevPageLabel' => '»',
                    //'nextPageLabel' => '«',
                    'lastPageLabel' => '&gt;&gt;',
                    'header' => '',
                ))
                ;
                ?>

                </div>

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

<script>//
//    function getProdcutId(p) {
//<?php //echo die;  ?>
//        var product_id = p;
//
//        $.ajax({
//            url: "<?= Yii::app()->request->baseUrl ?>/home/addFav/" + product_id,
//            success: function(data) {
//                return true;
//            }
//        });
//    }
//
//</script>

<script>//
//    function removefav(p) {
//<?php //echo die;  ?>
//        var product_id = p;
//
//        $.ajax({
//            url: "<?= Yii::app()->request->baseUrl ?>/home/removeFav/" + product_id,
//            success: function(data) {
//                return true;
//            }
//        });
//    }
//
//</script>

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