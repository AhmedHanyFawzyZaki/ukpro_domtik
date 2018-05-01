<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>

<h5 class="search-title">Find Property For Sale in Place Name</h5>

<div class="search-box animated zoomIn">
<div class="row">
    
    
    
         <form class="form-horizontal search-form" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true) . '/' . realstate; ?>/search">
  <div class="col-md-6">
      <div class="form-group">
            <label class="col-sm-5 control-label">Title:</label>
            <div class="col-sm-7">
                <input type="text" name="Search[titles]" placeholder=""  id="inputEmail3" class="form-control" value="<?php if($_REQUEST['Search']['titles']){echo $_REQUEST['Search']['titles'];}elseif($_REQUEST['title']){echo $tit;} ?>">
                    </div>
        </div>
           
        <div class="form-group">
            <label class="col-sm-5 control-label">Country:</label>
            <div class="col-sm-7">
                <select class="form-control" name="Search[country]" id="count" onchange="calldropdown()" >
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
        <div class="form-group price-max">
            <label class="col-sm-5 control-label">For :</label>
            <div class="col-sm-7">
                <?php  
                if($rnt==0)
                {
                    $sel1="selected";
                    $sel2="";
                }elseif($rnt==1)
                {
                    $sel2="selected";
                    $sel1="";
                }
                ?>
               <input type="radio" name="Search[rent]" value="0" <?= $sel1 ?> >Rent
                

<!--                <span class="price-to">to</span>-->
                <input type="radio" name="Search[rent]" value="1" <?= $sel2 ?> >Sale
            </div>
        </div>
    
    </div>
    <div class="col-md-6 ">
      
        
          <div class="form-group">
            <label class="col-sm-5 control-label">Post Code:</label>
            <div class="col-sm-7">
                <input type="text"  name="postcode" class="form-control" placeholder="Search by post code" value="<?php  if($_REQUEST['postcode']){echo $_REQUEST['postcode']; }?>">
                    </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label"> City:</label>
            <div class="col-sm-7">
                <select class="form-control" name="Search[city]" id="countryid" >
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
       
        <div class="form-group price-max">
            <label class="col-sm-5 control-label">Price Range:</label>
          <div class="col-sm-3">
              <input type="text" name="Search[minprice]" placeholder="Min Price"  id="inputEmail3" class="form-control" value="<?php if($_REQUEST['Search']['minprice']){echo $_REQUEST['Search']['minprice'];} ?>">
                    </div>

                    <div class="col-sm-3">
                        <input type="text" name="Search[maxprice]" placeholder="Max Price" id="inputEmail3" class="form-control" value="<?php if($_REQUEST['Search']['maxprice']){echo $_REQUEST['Search']['maxprice'];} ?>">
                    </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-success btn-lg find-btn">Find Properties</button>
            </div>
          </div>
    </div>


</form>
    
    
    
    
    
</div>

</div>
<?php  if (Yii::app()->user->hasFlash('add-error')) {
                    ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('add-error'); ?>.
                    </div>
                <?php } ?>
<blockquote class="col-md-4">
  <p><?= $count ?> Place Name</p>
</blockquote>
<div class="col-md-8">
    
<!--<ul class="pull-right pagination">
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
  
  <ul class="pull-right pagination">
  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sort by <span class="caret"></span></a>
          <ul class="dropdown-menu sort-menu" role="menu" >
            <li><a href="<?= Yii::app()->request->baseUrl;?>/realstate/search?sort=title asc">Product name (ASC)</a></li>
            <li><a href="<?= Yii::app()->request->baseUrl;?>/realstate/search?sort=title desc">Product name (DESC)</a></li>
            <li><a href="<?= Yii::app()->request->baseUrl;?>/realstate/search?sort=id asc">Recently added (ASC)</a></li>
           
            <li><a href="<?= Yii::app()->request->baseUrl;?>/realstate/search?sort=id desc">Recently added (DESC)</a></li>
          </ul>
          
           
          
        </li>
</ul>
</div>

   <?php foreach ($products as $product){ ?>
<div class="col-md-12 col-sm-12 col-xs-12 search-div">
  <div class="col-md-4 col-sm-12 col-xs-12 search-img">
      <?php if($product->flag != 1){
          ?>
      <img src="<?php  echo Yii::app()->request->baseUrl;?>/media/product/<?=  $product->main_image?>">
      <?php
      }else{
          ?>
      <img src="<?=  $product->main_image?>">
      <?php
      } ?>
      
  </div>
    <div class="col-md-8 col-sm-12 col-xs-12 search-desc">
        
        <h3><a href="<?php echo Yii::app()->getBaseUrl(true) . '/realstate/item/' . $product->id; ?>"><?= $product->title ?></a></h3>
        <h6><?= $product->description ?></h6>
        <hr>
         <div class="col-md-12 book-btns">
<!--          <a href="#" class="btn btn-success pull-right">Book Now</a>-->
            <a href="<?php  echo Yii::app()->request->baseUrl;?>/realstate/item/id/<?= $product->id?>" class="btn btn-success pull-right">Show Details</a>
            <span class="pull-right"><strong>Fixed price :</strong> <?= $product->price ?> GBP</span>
        </div>
    </div>
</div>

<?php } ?>

</div>
</div>


<script>
    function calldropdown() {
        var mks = document.getElementById("count").selectedIndex;
        $.ajax({
            url:"<?=Yii::app()->request->baseUrl?>/index.php/realstate/Getcity?id="+mks,
            success: function(data) {
               // $('#makemodel').val(data);
           document.getElementById('countryid').innerHTML = data;
              // alert(mks);
            }
        }
        );

    }

</script>