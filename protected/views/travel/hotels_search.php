<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<div class="search">
<div class="container">
<div class="wrap">
<!--
<form role="form" class="form-horizontal fligh-form ">
      <div class="form-group">
       <div class="col-sm-3 first-input">
          <input type="text" placeholder="Paris, France" id="" class="form-control">
        </div>
        
        <div class="col-sm-2 second-input">
          <input type="email" placeholder="Depart" id="" class="form-control departure">
          <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/calender.png"></i>
        </div> 
        
         <div class="col-sm-2 second-input">
          <input type="email" placeholder="Return" id="" class="form-control departure">
          <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/calender.png"></i>
        </div> 
        
        <div class="col-sm-2 second-input">
          <select class="form-control">
        <option>1 room</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
        </div> 
        
        <div class="col-sm-2 second-input">
          <select class="form-control">
        <option>2 guests</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
        </div> 
        
        <div class="col-sm-1 search-input"><button class="btn btn-default" type="submit">search</button></div>
       
      </div>
      
 
      
    </form>-->


 <?php
                        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'hotel-search-form',
                            'action' => Yii::app()->request->baseUrl . "/travel/search_hotels",
                            'method' => 'get',
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array(
                                'class' => 'form-horizontal fligh-form',
                            ),
                        ));
                        ?>
                        <div class="form-group">
                                    
                                    <div class="col-sm-3 first-input">
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'search_keyword',
                                        'value' => $search_keyword,
                                        'source' => Yii::app()->request->baseUrl . '/travel/location_search',
                                        'options' => array(
                                            'minLength' => '1', // min chars to start search
                                            'select' => 'js:function(event, ui) { 
                                                $("#loc").val(ui.item.id);
                                                $("#h_sk").removeClass("sb_error");
                                            }'
                                        ),
                                        'htmlOptions' => array(
                                            'class' =>'form-control',
                                            'placeholder' => 'Destination ..',
                                            'style' => 'width:215px;',
                                            'id' => 'h_sk',
                                        ),
                                    ));
                                    ?>
                                        </div>
                                    <input name="location_id" type="hidden" value="<?php echo $location_id; ?>" id="loc" />
<!--                                    <div class="col-sm-2 second-input">
                                    <input type="text" name="name" class="form-control" placeholder="Hotel Name ( Optional )" value="<?php echo $name; ?>" style="width: 215px;" />
                                    </div>-->
                                    
                                    <div class="col-sm-2 second-input">
                                    <select name="rooms" id="h_rms" class="form-control">
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <?php
                                            $sel = "";
                                            if ($i == $rooms) {
                                                $sel = "selected";
                                            }
                                            $str = "Rooms";
                                            if ($i == 1) {
                                                $str = "Room";
                                            }
                                            ?>
                                            <option <?php echo $sel; ?> value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                    
                                    <div class="col-sm-2 second-input">
                                    <select name="guests" id="h_gst" class="form-control">
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <?php
                                            $sel = "";
                                            if ($i == $guests) {
                                                $sel = "selected";
                                            }
                                            $str = "Guests";
                                            if ($i == 1) {
                                                $str = "Guest";
                                            }
                                            ?>
                                            <option <?php echo $sel; ?> value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                        <?php } ?>
                                    </select>  
                                </div>
                               <div class="col-sm-2 second-input">
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'name' => 'check_in',
                                        'value' => $from,
                                        // additional javascript options for the date picker plugin
                                        'options' => array(
                                            'showAnim' => 'fold',
                                            'dateFormat' => 'dd/mm/yy',
                                            'minDate' => date('d/m/Y'),
                                        ),
                                        'htmlOptions' => array(
                                            'size' => '16',
                                            'readonly' => true,
                                            'id' => 'cin',
                                            'class' => 'form-control',
                                            'style' => 'cursor:pointer;'
                                        ),
                                    ));
                                    ?>
                                    <!--<span class="add-on cal_ico" cd="#cin" style="cursor: pointer;"><i class="icon-calendar"></i></span>-->
                              <i class="calender"><img src=<?php echo Yii::app()->getBaseUrl(true)."/image/travel/calender.png" ?> alt=""></i>
                               </div>
                                    
                                    <div class="col-sm-2 second-input">
                                <select name="currency" class="form-control" style="width: 240px;">
                                    <?php
                                    $criteria1 = new CDbCriteria;
                                    $criteria1->order = 'id desc';
                                    $currencies = Currency::model()->findAll($criteria1);
                                    ?>
                                    <?php if ($currencies) { ?>
                                        <?php foreach ($currencies as $curr) { ?>
                                            <?php
                                            $str = "";
                                            if ($curr->iso_code == $currency) {
                                                $str = "selected";
                                            }
                                            ?>
                                            <option <?php echo $str; ?> value="<?php echo $curr->iso_code; ?>"><?php echo $curr->title . " (" . $curr->iso_code . ")"; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                
                                </div>
                               <div class="col-sm-2 second-input">
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'name' => 'check_out',
                                        'value' => $to,
                                        // additional javascript options for the date picker plugin
                                        'options' => array(
                                            'showAnim' => 'fold',
                                            'dateFormat' => 'dd/mm/yy',
                                            'minDate' => $from,
                                        ),
                                        'htmlOptions' => array(
                                            'size' => '16',
                                            'readonly' => true,
                                            'id' => 'cout',
                                            'class' => 'form-control',
                                            'style' => 'cursor:pointer;'
                                        ),
                                    ));
                                    ?>
                                    <!--<span class="add-on cal_ico" cd="#cout" style="cursor: pointer;"><i class="icon-calendar"></i></span>-->
                                <i class="calender"><img src=<?php echo Yii::app()->getBaseUrl(true)."/image/travel/calender.png" ?> alt=""></i>
                               </div>
                               
                            
                                <div class="col-sm-1 search-input"><button type="submit" id="find_hotel" class="searchSahdowfull btn btn-default">SEARCH</button></div>
                        <?php $this->endWidget(); ?>
                   



</div>
</div>
</div><!--end search-->


<div class="container">
<div class="wrap">

<div class="col-md-12 col-xs-12 page-headers">
    	<ul class="page_path">
                    <li><a href="#">home</a> >></li>
                    <li><a href="#">cheap hotels</a> >></li>
                    <li><a href="#">destinations</a> >></li>
                    <li><a href="#">europe</a> >></li>
                    <li><a href="#">france</a> >></li>
                     <li class="active"><a href="#">Paris Hotels & Accommodation</a></li>
                     
                </ul>
    </div>
    
<div class="col-sm-3 col-xs-12 ">
<div class="left-pan">
<span class="border">Find hotel name </span>
<input class="form-control left-input" id="filter-input" value=""  type="text">
<!--end find-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="headingOne">
      <h4 class="panel-title h4-coll">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
  <span>Price</span>
        </a>
      </h4>
    </div>
<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
       <p class="amount" >
  
  <input type="text" id="price" readonly>
</p>
<div id="slider-price"></div>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="headingTwo">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <span>Star Ratings</span>
        </a>
      </h4>
    </div>
 <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
 <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" class="star_filter" value="5"> <div class="star-r">
   <i class="fa fa-star good" ></i>
	 <i class="fa fa-star good"></i>
 <i class="fa fa-star good"></i>
<i class="fa fa-star good"></i>
<i class="fa fa-star good"></i>
    </div>
        </label>
      </div>
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" class="star_filter" value="4"> <div class="star-r">
   <i class="fa fa-star good"></i>
	 <i class="fa fa-star good"></i>
 <i class="fa fa-star good"></i>
<i class="fa fa-star good"></i>
<i class="fa fa-star poor"></i>
    </div>
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" class="star_filter" value="3"> <div class="star-r">
   <i class="fa fa-star good"></i>
	 <i class="fa fa-star good"></i>
 <i class="fa fa-star good"></i>
<i class="fa fa-star poor"></i>
<i class="fa fa-star poor"></i>
    </div>
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" class="star_filter" value="2"> <div class="star-r">
   <i class="fa fa-star good"></i>
	 <i class="fa fa-star good"></i>
<i class="fa fa-star poor"></i>
<i class="fa fa-star poor"></i>
<i class="fa fa-star poor"></i>

    </div>
        </label>
      </div>
    </div>
  </div>
   </div>
  </div>
  </div>
  <!--rating end-->
  <div class="clearfix"></div>
   <div class="panel panel-default">
<!--    <div class="panel-heading bg-coll" role="tab" id="headingsix">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
         <span>Themes</span>
        </a>
      </h4>
    </div>-->
<!--    <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix">
      <div class="panel-body">
 
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox">  Business Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Family Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Romantic Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> City Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group" >
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div></div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div>
  </div>
   </div>
    </div>-->
  </div>
<div class="clearfix"></div>
 <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="heading6">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
         <span>Accommodation Type</span>
        </a>
      </h4>
    </div>
    <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
      <div class="panel-body">

 
 <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
            <input type="checkbox" class="property_type" value="1">  Hotel
        </label>
      </div>
    </div>
  </div>
          <div class="form-group">
              <div class="col-sm-12">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" class="property_type" value="2">  Hostel / Backpackers
                      </label>
                  </div>
              </div>
          </div>
          
          
          <div class="form-group">
              <div class="col-sm-12">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" class="property_type" value="3">  bed and breakfast
                      </label>
                  </div>
              </div>
          </div>
          
 <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="property_type" value="4"> apartment
        </label>
      </div>
    </div>
  </div> 
 <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="property_type" value="5">Resort
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="property_type" value="6"> Villa

        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="property_type" value="3">Motel
        </label>
      </div>
    </div>
  </div>	
</div>
</div>
</div>
<div class="clearfix"></div>
 <div class="panel panel-default">
<!--    <div class="panel-heading bg-coll" role="tab" id="headingseven">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
     <Span>Districts/Areas</Span>
        </a>
      </h4>
    </div>-->
<!--    <div id="collapseseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven">
      <div class="panel-body">

<div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Balboa Park
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Balboa Park
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Balboa Park
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Balboa Park
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  </div>
  </div>-->
  </div>
   <div class="clearfix"></div>
   <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="heading8">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap8" aria-expanded="false" aria-controls="collap8">
    <span>Hotel Amenities</span>
        </a>
      </h4>
    </div>
    <div id="collap8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
      <div class="panel-body">
   
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
            <input type="checkbox" class="aminity_filter" value="1">Internet access
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
            <input type="checkbox" class="aminity_filter" value="2">pool
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
            <input type="checkbox" class="aminity_filter" value="3">parking
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
            <input type="checkbox" class="aminity_filter" value="4">restaurant
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
            <input type="checkbox" class="aminity_filter" value="5">fitness center/spa
        </label>
      </div>
    </div>
  </div>
          
  </div>
  </div>
  </div>
     <div class="clearfix"></div>
     <div class="panel panel-default">
<!--    <div class="panel-heading bg-coll" role="tab" id="heading9">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap9" aria-expanded="false" aria-controls="collap9">
  <span>Hotel Chains & Brands</span>
        </a>
      </h4>
    </div>-->
<!--    <div id="collap9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading9">
      <div class="panel-body">
 
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Best Value Inn and Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Inns
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Courtyard by Marriot
        </label>
      </div>
    </div>
  </div>
   <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Best Value Inn and Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Inns
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Courtyard by Marriot
        </label>
      </div>
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Best Value Inn and Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Inns
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Courtyard by Marriot
        </label>
      </div>
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Best Value Inn and Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Inns
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Courtyard by Marriot
        </label>
      </div>
    </div>
  </div>
  </div>
  </div>-->
  </div>
	
<div class="clearfix"></div> 
<!--  <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="heading10">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap10" aria-expanded="false" aria-controls="collap10">
<span>Legend</span>
        </a>
      </h4>
    </div>
    <div id="collap10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading10">
      <div class="panel-body">

<p>
Prices shown are per room, per night and include all taxes and other applicable fees unless otherwise indicated upon booking.
++
<br/>
<br/>
These prices do not include all taxes and other applicable fees upon booking.
 </p>  



   
</div>
</div>
</div>-->
</div>
</div><!--end left-pan-->

  
    <!--end right-pan-->
   





    

</div>
<div class="col-sm-9">
	
    
    
                <?php if ($hotels) { ?>
                    <div class="row-fluid">
                        <div class="span12 flight_res srchdiv" style="margin-top: 30px;">
                            <div class="row-fluid">
                                <div class="span12 color_div flightitem">
                                	<!--<div style="float:left;">
                                    <span style="font-size: 25px;letter-spacing: normal;margin-right:10px;" class="words">Filter By: </span>
                                    <a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => 'stars', 'order' => $order)); ?>" class="btn btn-site btn-large search_filter <?php echo $filter_key == 'stars' ? "selected_filter" : ""; ?>">Stars</a>
                                    <a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => 'name', 'order' => $order)); ?>" class="btn btn-site btn-large search_filter <?php echo $filter_key == 'name' ? "selected_filter" : ""; ?>">Name</a>
                                    <a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => 'price', 'order' => $order)); ?>" class="btn btn-site btn-large search_filter <?php echo $filter_key == 'price' ? "selected_filter" : ""; ?>">Price</a>
                                    <a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => 'popularity', 'order' => $order)); ?>" class="btn btn-site btn-large search_filter <?php echo $filter_key == 'popularity' ? "selected_filter" : ""; ?>">Popularity</a>
                                    </div>
                                    <div style="float:right">


                                    <a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => $filter, 'order' => 'asc')); ?>" class="btn btn-site btn-large search_order <?php echo $order == 'asc' ? "selected_filter" : ""; ?>">&#x25B2;</a>
                                    <a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => $filter, 'order' => 'desc')); ?>" class="btn btn-site btn-large search_order <?php echo $order == 'desc' ? "selected_filter" : ""; ?>">&#x25BC;</a>
                                    <a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => $filter, 'order' => 'asc')); ?>" class="btn btn-site btn-large search_order <?php echo $order == 'asc' ? "selected_filter" : ""; ?>">Lowest First</a>
                                    <a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => $filter, 'order' => 'desc')); ?>" class="btn btn-site btn-large search_order <?php echo $order == 'desc' ? "selected_filter" : ""; ?>">Highest First</a>
                                    </div>-->
                                    <span style="font-size: 25px;letter-spacing: normal;margin-right:10px;" class="words">Sort By: </span>
                                    <div class="btn-group">
                                        <a class="btn-info dropdown-toggle  btn-large" data-toggle="dropdown" href="#">
                                            <?php
											    $cl='';
												if(isset($filter_key))
												{
													switch($filter_key)
													{
														case 'stars':
															echo 'Rating - ';
															echo $order=='asc'?'low to high':'high to low';
															$cl="st_".$order;
															break;
														case 'price':
															echo 'Price - '; 
															echo $order=='asc'?'low to high':'high to low';
															$cl="pr_".$order;
															break;
														case 'popularity':
															echo "Popularity";
															$cl='';
															break;
													}
												}
												else
												{
													echo "Popularity";
												}
                                            ?>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                        <!-- dropdown menu links -->
                                        	<li <?= $cl==""? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => 'popularity', 'order' => $order)); ?>">Popularity</a></li>
                                            <li <?= $cl=="pr_asc"? "style='display:none;'":""?>> <a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => 'price', 'order' => 'asc')); ?>">Price - low to high</a></li>
                                            <li <?= $cl=="pr_desc"? "style='display:none;'":""?>> <a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => 'price', 'order' => 'desc')); ?>">Price - high to low</a></li>
                                            <li <?= $cl=="st_asc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => 'stars', 'order' => 'asc')); ?>">Rating - low to high</a></li>
                                            <li <?= $cl=="st_desc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => 'stars', 'order' => 'desc')); ?>">Rating - high to low</a></li>
                                        </ul>
                                    </div>

                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                        
                        
    
    
    <?php if ($hotels) { ?>
                            <?php foreach ($hotels as $hotel) { ?>
                        	<div class="col-sm-12 col-xs-12 right-pan hotel-bg">

     <div class="col-sm-3"> <a href="<?php echo Yii::app()->createUrl('travel/hotel_details/', array("search_id" => $search_id, 'currency' => $currency, 'id' => $hotel->id, 'days' => $days, 'rooms' => $rooms)); ?>"><img src="<?php echo $hotel->image; ?>"></a>

    </div>
    <div class="col-sm-6">
     <h3><a href="<?php echo Yii::app()->createUrl('travel/hotel_details/', array("search_id" => $search_id, 'currency' => $currency, 'id' => $hotel->id, 'days' => $days, 'rooms' => $rooms)); ?>"><?php echo $hotel->name; ?> </a></h3>
    <div class="star-r">
        
                <?php 
                 
                if ($hotel->stars) { 
                   
                    ?>
                    <?php for ($i = 0; $i < $hotel->stars; $i++) { ?>
                         <i class="fa fa-star good"></i>
                    <?php } ?>
                <?php } else { ?>
                    <?php echo "no rating."; ?>
                <?php } ?>
        
<!--   <i class="fa fa-star good"></i>
	 <i class="fa fa-star good"></i>
 <i class="fa fa-star good"></i>
<i class="fa fa-star-half-o good"></i>
<i class="fa fa-star poor"></i>-->
    </div>
    <span class="tittel-h"><?php echo $hotel->address; ?></span>
    
      <Span class="rat-num"><?php echo $hotel->rooms_count; ?> </Span>
     
   <Span class="rat-p">Rooms</Span>  
   <div class="clearfix"></div>
   <p> <a href="#"  class="review-num"><?php echo $hotel->total_reviews; ?> reviews</a></p>
   
     
    </div>
    <div class="col-sm-3 deal">
  <p><?php if ($hotel->room_rate_min) {
                                                                    $str = Helper::get_currency_symbol(round(str_replace(',', '', $hotel->room_rate_min->price_str) * $days * $rooms, 2), $hotel->room_rate_min->currency_code);

                                                                    echo $str;
                                                                } else {
                                                                    echo "not available";
                                                                } ?></p>
 <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png">
 <a target="_blank" href="<?php echo Yii::app()->createUrl('travel/book/', array("search_id" => $search_id, 'hotel_id' => $hotel->id, 'room_id' => $hotel->summary_room_rates[0]->id)) ?>" class="deal-btn" type="submit">View deal</a>
   <a target="_blank" href="<?php echo Yii::app()->createUrl('travel/hotel_details/', array("search_id" => $search_id, 'currency' => $currency, 'id' => $hotel->id, 'days' => $days, 'rooms' => $rooms)); ?>" class="deal-btn" type="submit">Hotel Details</a>
   
    </div>
   
    </div>
                        
                        
                        
                        
                            <?php } ?>
                        <?php } else { ?>
                            <div class="row-fluid">
                                <div class="span12 color_div flightitem">
                                    <h3 style="color: #3C9DBE; margin-left: 40px;margin-bottom: 60px;margin-top: 60px;font-size: 22px;">Unfortunately we were unable to find an exact match for your search requirements.<br />Please check that you selected an option from our drop-down lists for all search boxes (including a hotel location if searching for flights + hotel).</h3>
                                </div>
                            </div>
                        <?php } ?>
    
    
    
    
    
    
                <?php if ($total_pages) { ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="pagination-centered">
                                <div class="pagination">
                                    <ul>
                                        <?php if ($page > 1) { ?>
                                            <li class=""><a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => $filter_key, 'order' => $order, 'page' => ($page - 1))); ?>">Prev</a></li>
                                        <?php } ?>

                                        <?php
                                        $tota = $total_pages;
                                        $ind = 1;
                                        if ($total_pages > 10) {
                                            $tota = 10;
                                            if ($page > 6) {
                                                $ind = $page - 5;
                                                $tota += $page - 5;
                                            }
                                        }
                                        ?>
                                        <?php for ($i = $ind; $i <= $tota; $i++) { ?>
                                            <?php
                                            $class = "";
                                            $url = Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => $filter_key, 'order' => $order, 'page' => $i));
                                            if ($i == $page) {
                                                $class = "active";
                                                $url = "javascript:void(0)";
                                            }
                                            ?>
                                            <li class="<?php echo $class ?>"><a href="<?php echo $url; ?>"><?php echo $i; ?></a></li>
                                        <?php } ?>
                                        <?php if ($page < $total_pages) { ?>
                                            <li class=""><a href="<?php echo Yii::app()->createUrl('travel/hotel_results', array('search_id' => $search_id, 'currency' => $currency, 'filter' => $filter_key, 'order' => $order, 'page' => ($page + 1))); ?>">Next</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
    
    
</div>

</div>
</div>



<script>
    
    $(function(){
        
        
        // filter by name
        $("#filter-input").keypress(function(){
            var text_filter = $(this).val();
            insertParam("text_filter" , text_filter);
        });
        
        
        // filter by stars
        $(".star_filter").each(function(){
            $(this).click(function(){
                
            var star_filter = $(this).val();
            var kvp = document.location.search.substr(1)+'&stars[]='+star_filter;
            console.log(kvp);
            document.location.search = kvp;
            //insertParam("stars[]" , star_filter);
            });
        });
      
        

  // filter by aminity
        $(".aminity_filter").each(function(){
            $(this).click(function(){
                
            var amenities_filter = $(this).val();
            var kvp = document.location.search.substr(1)+'&amenities[]='+amenities_filter;
          //  console.log(kvp);
            document.location.search = kvp;
            //insertParam("stars[]" , star_filter);
            });
        });
        
  
  // filter by property type
        $(".property_type").each(function(){
            $(this).click(function(){
                
            var property_types = $(this).val();
            var kvp = document.location.search.substr(1)+'&property_types[]='+property_types;
           // console.log(kvp);
            document.location.search = kvp;
            //insertParam("stars[]" , star_filter);
            });
        });
        
       $("#slider-price").click(function(){ 
           var price = $(".amount #price").val();
           var min_price = price.split(' - ')[0];
           min_price = min_price.replace("$"," ");
           var max_price = price.split(' - ')[1];
           max_price = max_price.replace("$"," ");
          
          
          
          insertParam("price_min" , min_price);
          
          
          insertParam("price_max" , max_price);
       }); 
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