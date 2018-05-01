<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>



<div class="container">
<div class="wrap inner-bg">
<div class="col-sm-4 col-xs-12 slid-hotel">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
     <li data-target="#carousel-example-generic" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
      
                                              <?php if ($hotel->images) { $i=0 ; ?>
                                            <?php foreach ($hotel->images as $img) {
                                               
                                                ?>
                                               
      
      <div class="item <?php if($i==0){ ?>active<?php } ?>">
      <img style="width: 356px;height: 300px;" src="<?php echo $img->url; ?>" />
      <div class="carousel-caption">
       
      </div>
    </div>
      
                                            <?php $i++;} ?>
                                        <?php } ?>
      
   
  </div>

  <!-- Controls -->
  
</div>


</div><!--end left-slid-->
<div class="col-sm-8 col-xs-12">
<div class="col-sm-12 bg-detail">
<h1><?php echo $hotel->name; ?></h1>
<div class="col-sm-6 col-xs-6">
 <div class="star-r">
   <i class="fa fa-star good"></i>
	 <i class="fa fa-star good"></i>
 <i class="fa fa-star good"></i>
<i class="fa fa-star good"></i>
<i class="fa fa-star poor"></i>
    </div>
     <span class="tittel-h"><?php echo $hotel->address ?></span>
    
      <Span class="rat-num"><?php echo $hotel->rooms_count; ?></Span>
       <Span class="rat-p">Rooms</Span> 
       <div class="clearfix"></div>
        <p> <a href="#"  class="review-num"><?php echo $hotel->total_reviews; ?> reviews</a></p> 
</div>
   
   <div class="col-sm-6 deal">
  <p class="pull-right"><?php
                                                                if ($hotel->room_rate_min) {
                                                                    $str = Helper::get_currency_symbol(round(str_replace(',', '', $hotel->room_rate_min->price_str) * $days * $rooms, 2), $hotel->room_rate_min->currency_code);

                                                                    echo $str;
                                                                } else {
                                                                    echo "not available";
                                                                }
//                                                                
                                                                ?></p>
 <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png" class="pull-right">
 <a class="deal-btn pull-right" target="_blank" href="<?php echo Yii::app()->createUrl('travel/book/', array("search_id" => $search_id, 'hotel_id' => $hotel->id, 'room_id' => $hotel->summary_room_rates[0]->id)) ?>">View deal</a>
    </div>
    <div class="clearfix"></div>
    <div class="amenities">
     <h6>Amenities</h6>
     
     
      <?php $i = 0; ?>
                                                        <?php foreach ($hotel->property_amenities as $am) { ?>
                                                            <?php if ($i % 5 == 0 && $i != 0) { ?>
                                                           <i class="fa fa-users good"></i>

 <span> <?php echo $am; ?></span>
                                                           
                                                            <?php } ?>
                                                            
                                                            <?php $i++; ?>
                                                        <?php } ?>
     
     
     <i class="fa fa-users good"></i>

 <span> Babysitting/Child Services</span>
      
<i class="fa fa-users good"></i>

 <span> Meeting/Banquet Facilities</span>
 <i class="fa fa-cutlery good"></i>

 <span> Restaurant </span>
  <i class="fa fa-users good"></i>

 <span> Babysitting/Child Services</span>
      
<i class="fa fa-users good"></i>

 <span> Meeting/Banquet Facilities</span>
 <i class="fa fa-cutlery good"></i>

 <span> Restaurant </span>

</div>



</div>


</div>

<div class="clearfix"></div>
<Div class="col-sm-12 tab-del">
<!--tab-->
<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
   <li role="presentation" class="active"><a href="#Description" aria-controls="Description" role="tab" data-toggle="tab">Description</a></li>
    <li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a></li>
    <li role="presentation"><a href="#map" aria-controls="map" role="tab" data-toggle="tab">Map</a></li>
   
  </ul>

  <!-- Tab panes -->
  <div class="tab-content tab-d">
    <div role="tabpanel" class="tab-pane active" id="Description">
        <?php echo $hotel->desc; ?>
    </div>
    <div role="tabpanel" class="tab-pane tab-reviews" id="reviews">
   		<h3>Guest Review Highlights</h3>
                
                
                  <?php if ($hotel->reviews->summary) { ?>
                                                    <?php foreach ($hotel->reviews->summary as $sum) { ?>
                                                        <?php $rev = trim($sum->text); ?>
                                                        <?php if ($rev) { ?>
                                                            <li style="margin-bottom: 5px;">
                                                                <?php if ($sum->score > 0) { ?>
                                                                    <i class="icon-thumbs-up" style="float: left;"></i>
                                                                <?php } else { ?>
                                                                    <i class="icon-thumbs-down" style="float: left;"></i>
                                                                <?php } ?>
                                                                 <p><i class="fa fa-thumbs-up like-up"></i><?php echo $sum->text ?></p>
                                                            </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                
                
<!--      <p><i class="fa fa-thumbs-up like-up"></i>Location is acceptable.</p>
<p><i class="fa fa-thumbs-up like-up"></i> Service is ok. 70% said the reception staff was great. Only 58% found the staff to be friendly enough.</p>
<p><i class="fa fa-thumbs-down like-down"></i>
 Substandard restaurant. Expensive restaurant For 75%, the dining experience was not enjoyable.</p>
<p><i class="fa fa-thumbs-up like-up"></i> Hotel is ok.</p>
 <p><i class="fa fa-thumbs-up like-up-g"></i>Price is reasonable.</p>
<p><i class="fa fa-thumbs-down like-down"></i> Awful rooms. 76% complained about the bathroom. Poorly-maintained rooms</p>
<p><i class="fa fa-thumbs-down like-down"></i> Ambiance is not good. Insufficient entertainment options, thought 78%.</p>
<p> <i class="fa fa-thumbs-down like-up-g"></i> Nice grounds. Pool was lovely, according to 85%.</p>
 <p><i class="fa fa-thumbs-down like-down"></i> Building is not very nice. 100% thought the facilities needed updating. </p>
   -->
    </div>
    <div role="tabpanel" class="tab-pane" id="map">
        <!--<iframe class="map" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d4966.741959096974!2d-0.09417869077553938!3d51.5064096194227!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1409665025989" ></iframe>-->
    
         <?php
                                        Yii::import('ext.gmap.*');
                                        $gMap = new EGMap();
                                        $gMap->setWidth("100%");
                                        $gMap->setHeight(300);
                                        $gMap->zoom = 14;
                                        $mapTypeControlOptions = array(
                                            'position' => EGMapControlPosition::RIGHT_TOP,
                                            'style' => EGMap::MAPTYPECONTROL_STYLE_HORIZONTAL_BAR
                                        );

                                        $gMap->mapTypeId = EGMap::TYPE_ROADMAP;
                                        $gMap->mapTypeControlOptions = $mapTypeControlOptions;

                                        $info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>" . $hotel->name . "</div>");

                                        $icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/hotel.png");

                                        $icon->setSize(32, 37);
                                        $icon->setAnchor(16, 16.5);
                                        $icon->setOrigin(0, 0);

                                        if ($hotel->latitude && $hotel->longitude) {

                                            $marker = new EGMapMarker($hotel->latitude, $hotel->longitude, array('title' => $hotel->name,
                                                'icon' => $icon, 'draggable' => false), 'marker');
                                            $marker->addHtmlInfoWindow($info_window_a);
                                            $gMap->addMarker($marker);
                                            $gMap->setCenter($hotel->latitude, $hotel->longitude);
                                            $gMap->zoom = 14;
                                        }
                                        $gMap->renderMap(array(), Yii::app()->language);
                                        ?>

    </div>
  
  </div>

</div>
<!--end tab-->
</Div>
</div>
</div>

