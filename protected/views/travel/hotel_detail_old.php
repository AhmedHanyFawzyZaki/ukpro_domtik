<?php
$this->pageTitle = Yii::app()->name . ' - ' . $hotel->name;
?>



<!-- content
        ================================================== --> 
<div class="row-fluid">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">

                <p class="words top50px"><?php echo $hotel->name; ?></p> 

                <div class="row-fluid">
                    <div class="span12 color_div">

                        <div class="row-fluid">
                            <div class="span12">
                                <p class="catin_header">
                                    Room Types and Pricing Offers
                                </p>
                                <div style="max-height: 500px;overflow-y: scroll;border-bottom: 1px solid #3C9DBE;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Provider</th>
                                                <th>Cost Per Night Per Room</th>
                                                <th>Total Cost</th>
                                                <th>Book</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rates as $rate) { ?>
                                                <tr>
                                                    <td style="width: 40%;"><?php echo $rate->description; ?></td>
                                                    <td><?php echo $rate->provider_name; ?></td>
                                                    <?php
                                                    $str1 = Helper::get_currency_symbol(round(str_replace(',', '', $rate->price_str), 2), $rate->currency_code);
                                                    $str2 = Helper::get_currency_symbol(round(str_replace(',', '', $rate->price_str) * $days * $rooms, 2), $rate->currency_code);
                                                    ?>
                                                    <td><?php echo $str1; ?></td>
                                                    <td><?php echo $str2; ?></td>
                                                    <td><a href="<?php echo Yii::app()->createUrl('travel/book/', array("search_id" => $search_id, 'hotel_id' => $hotel->id, 'room_id' => $rate->id)) ?>" class="btn btn-site">Book Room</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        </div>  

                        <div class="row-fluid top10px">
                            <div class="span4">
                                <!-- Place somewhere in the <body> of your page -->
                                <div id="slider" class="flexslider">
                                    <ul class="slides">
                                        <?php if ($hotel->images) { ?>
                                            <?php foreach ($hotel->images as $img) { ?>
                                                <li>
                                                    <img style="width: 356px;height: 300px;" src="<?php echo $img->url; ?>" />
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div id="carousel" class="flexslider mini_slid">
                                    <ul class="slides">
                                        <?php if ($hotel->images) { ?>
                                            <?php foreach ($hotel->images as $img) { ?>
                                                <li style="margin-right: 2px;">
                                                    <img style="width: 100px;height: 100px;" src="<?php echo $img->url; ?>" />
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>                                   

                            <div class="span8">

                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#detailstab1" data-toggle="tab"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/10.png" />Description</a>
                                    </li>
                                    <li class="px3left_tap">
                                        <a href="#detailstab2" data-toggle="tab"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/9.png" />Users Reviews</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab_bg">
                                    <div class="tab-pane active" id="detailstab1">
                                        <p><?php echo $hotel->desc; ?></p>
                                    </div>

                                    <div class="tab-pane" id="detailstab2">
                                        <div id="bg" style="width: 100%;margin-left: 10px;max-height: 415px;overflow-y: scroll;min-height: 295px;">
                                            <ul class="span12" style="width: 100%;">
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
                                                                <div style="float: left;width: 95%;margin-left: 10px;"><?php echo trim($sum->text); ?></div>
                                                                <div style="clear: both;"></div>
                                                            </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div> 
                                </div>

                                <div class="clear"></div>
                            </div>
                        </div> 

                        <div class="row-fluid top10px">
                            <div class="span12">
                                <p class="catin_header">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/10.png" />
                                    Position on Map
                                </p>
                                <div class="row-fluid">
                                    <div class="span12 tab_bg" style="min-height:200px;">
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
                        </div> 


                        <div class="row-fluid top10px">
                            <div class="span12">

                                <div class="accordion hotel_static bg" id="accordion3">

                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="site accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse1">
                                                Hotel Facilities<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/arr.png" class="pull-right arr" />
                                            </a>
                                        </div>
                                        <div id="collapse1" class="accordion-body collapse in">
                                            <div class="accordion-inner">
                                                <div class="row-fluid">    
                                                    <ul class="span4" style="margin-left: 0;">
                                                        <?php $i = 0; ?>
                                                        <?php foreach ($hotel->property_amenities as $am) { ?>
                                                            <?php if ($i % 5 == 0 && $i != 0) { ?>
                                                            </ul>
                                                            <ul class="span4" style="margin-left: 0;">
                                                            <?php } ?>
                                                            <li><?php echo $am; ?></li>
                                                            <?php $i++; ?>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="site accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse2">
                                                Room Facilities<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/arr.png" class="pull-right arr" />
                                            </a>
                                        </div>
                                        <div id="collapse2" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                                <div class="row-fluid">    
                                                    <ul class="span4" style="margin-left: 0;">
                                                        <?php $i = 0; ?>
                                                        <?php foreach ($hotel->room_amenities as $rm) { ?>
                                                            <?php if ($i % 5 == 0 && $i != 0) { ?>
                                                            </ul>
                                                            <ul class="span4" style="margin-left: 0;">
                                                            <?php } ?>
                                                            <li><?php echo $rm; ?></li>
                                                            <?php $i++; ?>
                                                        <?php } ?>
                                                    </ul>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div> 
                        </div>  


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!--=================================== end content -->