<div class="row profile">

    <div class="col-md-12">
        <ol class="breadcrumb">

            <li class="active">profile owner</li>
        </ol>

    </div>



    <div class="col-md-3">
        <div class="profile-img">
            <?php if (!empty($user->image)) { ?>
                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/members/<?php echo $user->image ?>" alt="<?php echo $user->fname . ' ' . $user->lname; ?>" />
            <?php } else { ?>
                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/profile-img.png" alt="<?php echo $user->fname . ' ' . $user->lname; ?>" />
            <?php } ?>
        </div><!--end profile-img-->


        <ul style="max-width: 300px;" class="nav nav-pills nav-stacked profile-menu">
            <li><a href="<?= Yii::app()->request->baseUrl ?>/home/sellerproduct/<?php echo $user->id?>"><i class="fa fa-eye"></i>view products</a></li>
            <?php if (!empty(Yii::app()->user->id)) { ?>
                <li><a href="#message-modal" data-toggle="modal" data-target="#message-modal"><i class="fa fa-envelope-o"></i>send message</a></li>
            <?php } ?>
        </ul>

        <!--send message Modal-->
        <div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">send message</h4>
                    </div>

                    <div class="modal-body">
                        <?php
                        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'add-review',
                            'enableAjaxValidation' => false,
                            'type' => 'vertical',
                            'htmlOptions' => array('role' => 'role', 'enctype' => 'multipart/form-data'
                            ),
                        ));
                        ?>
                        <div class="form-group">   
                            <?php echo $form->textField($message, 'title', array('class' => 'form-control', 'placeholder' => 'Title')); ?>
                        </div>
                        <div class="form-group">   
                            <?php echo $form->textArea($message, 'details', array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'Message')); ?>
                        </div>
                        <?php echo CHtml::submitButton('send', array('class' => 'btn btn-default log-btn')); ?>
                        <?php $this->endWidget(); ?>
                    </div>

                </div>
            </div>
        </div>

        <!--end send message modal-->


    </div>

    <div class="col-md-9">
        <?php
            if (Yii::app()->user->hasFlash('add-success')) {
                ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo Yii::app()->user->getFlash('add-success'); ?>.
                </div>

                <?php
            } elseif (Yii::app()->user->hasFlash('add-error')) {
                ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('add-error'); ?>.
                </div>
            <?php } ?>
        <div class="info">
            <p class="profile-name"><?php echo $user->fname . ' ' . $user->lname; ?></p>
            
            <dl class="dl-horizontal col-md-6">
                <dt>first name:</dt>
                <dd><?php echo $user->fname; ?></dd>
                <dt>last name:</dt>
                <dd><?php echo $user->lname; ?></dd>
                <dt>user name:</dt>
                <dd><?php echo $user->username; ?></dd>
                <dt>E-mail:</dt>
                <dd><?php echo $user->email; ?></dd>
                <dt>Country:</dt>
                <dd><?php echo $userdetails->countryname->title; ?></dd>
                <dt>City:</dt>
                <dd><?php echo $userdetails->city->title; ?></dd>
                <dt>Address:</dt>
                <dd><?php echo $userdetails->address; ?></dd>
                <dt>Post Code:</dt>
                <dd><?php echo $userdetails->zipcode; ?></dd>
                <dt>website:</dt>
                <dd><?php echo $userdetails->website; ?></dd>
                <dt class="m-links">Social Media Links:</dt>
                <dd><ul id="social" class="isocial boot-tooltip pull-right">
                        <li><a target="blanck" href="<?php echo $userdetails->facebook; ?>" data-toggle="tooltip" data-original-title="facebok" class="face"></a></li>
                        <li><a target="blanck" href="<?php echo $userdetails->twitter; ?>" data-toggle="tooltip" data-original-title="twitter" class="twitter"></a></li>
                        <li><a target="blanck" href="<?php echo $userdetails->linkedin; ?>" data-toggle="tooltip" data-original-title="mail" class="linkdin"></a></li>
                        <li><a target="blanck" href="<?php echo $userdetails->instagram; ?>" data-toggle="tooltip" data-original-title="instgram" class="instagram"></a></li>
                        <li><a target="blanck" href="<?php echo $userdetails->google; ?>" data-toggle="tooltip" data-original-title="youtube" class="google"></a></li>

                    </ul></dd>
                <dt>Description:</dt>
                <dd><?php echo $user->details; ?></dd>

               </dl>
                    
               

                <div class="clearfix">

                </div>
                <p class="profile-name col-md-12">Shop Information</p>

                <dl class="dl-horizontal">
                    <dt>shop name:</dt>
                    <dd><?php echo $userdetails->shop_name; ?></dd>
                    <dt>shop address:</dt>
                    <dd><?php echo $userdetails->shop_address; ?></dd>
                    <dt>shop description:</dt>
                    <dd><?php echo $userdetails->shop_description; ?></dd>
                    <dt> Shop Image:</dt>
                    <dd>
                        <?php if ($userdetails->shop_image != '') { ?><img src="<?php echo Yii::app()->getBaseUrl(true) . '/media/shop/' . $userdetails->shop_image; ?>" width="200" alt="<?php echo $userdetails->shop_name; ?>" />
                            <?php
                        } else
                            echo "There is no shop image";
                        ?>
                    </dd>

                </dl>
       
    

     <div class="map_div col-md-6">
                    <div class="control-group" style="margin-top: 15px;">
                        <label class="control-label">Location On Map</label>
                        <div class="controls">
                            <div id="searchAddress">
                                <?php echo CHtml::textField('location', '', array('id' => 'Address', 'class' => 'span8', 'placeholder' => 'Enter address')); ?>
                                <button type='button' class='btn map_search' jsaction="omnibox.search"><i class='icon-search icon-white'></i></button>
                            </div>
                            <?php
                            Yii::import('ext.gmap.*');
                            $gMap = new EGMap();
                            $gMap->setWidth(400);
                            $gMap->setHeight(200);
                            $gMap->zoom = 2;
                            $mapTypeControlOptions = array(
                                'position' => EGMapControlPosition::RIGHT_TOP,
                                'style' => EGMap::MAPTYPECONTROL_STYLE_HORIZONTAL_BAR
                            );

                            $gMap->mapTypeId = EGMap::TYPE_ROADMAP;
                            $gMap->mapTypeControlOptions = $mapTypeControlOptions;
                            $gMap->zoomControl = EGMap::ZOOMCONTROL_STYLE_SMALL;
                            $gMap->streetViewControl = false;
                            $gMap->minZoom = 2;

                            $gMap->htmlOptions = array(
                                'class' => 'map'
                            );

// Preparing InfoWindow with information about our marker.
                            $info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Hi! I'm your marker!</div>");


// Saving coordinates after user dragged our marker.
                            $dragevent = new EGMapEvent('dragend', "function (event) { 
        $('#h_lng').val(event.latLng.lng());
        $('#h_lat').val(event.latLng.lat());    
        }", false, EGMapEvent::TYPE_EVENT_DEFAULT);

// If we have already created marker - show it
                            $lng = $userdetails->lng;
                            $lat = $userdetails->lat;
                            $zoom = 8;
                            if ($user->isNewRecord) {
                                $lng = 30.45994900000005;
                                $lat = 22.358558915985164;
                                $zoom = 2;
                            }

                            $marker = new EGMapMarker($lat, $lng, array('title' => $user->username, 'draggable' => true), $gMap->getJsName() . '_marker', array('dragevent' => $dragevent));
                            $marker->addHtmlInfoWindow($info_window_a);
                            $gMap->addMarker($marker);
                            $gMap->setCenter($lat, $lng);
                            $gMap->zoom = $zoom;

//$gMap->addAutocomplete('Address');
                            $gMap->additionScript = "
          input_address_temp = document.getElementById('Address');
          search_div = document.getElementById('searchAddress');
          {$gMap->getJsName()}.controls[google.maps.ControlPosition.TOP_LEFT].push(search_div);
          var searchBox = new google.maps.places.SearchBox((input_address_temp));
          var markers = [];
            google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();
var place = places[0];
    if (place.geometry.viewport) {
            " . $gMap->getJsName() . ".fitBounds(place.geometry.viewport);
          } else {
            " . $gMap->getJsName() . ".setCenter(place.geometry.location);
            " . $gMap->getJsName() . ".setZoom(17);  
          }
          " . $gMap->getJsName() . "_marker.setPosition(place.geometry.location);
          
          var address = '';
          if (place.address_components) {
            address = [(place.address_components[0] &&
                        place.address_components[0].short_name || ''),
                       (place.address_components[1] &&
                        place.address_components[1].short_name || ''),
                       (place.address_components[2] &&
                        place.address_components[2].short_name || '')
                      ].join(' ');
          }

          " . $gMap->getJsName() . "_info_window.setContent('<div><strong>' + place.name + '</strong><br />' + address);
          " . $gMap->getJsName() . "_info_window.open(" . $gMap->getJsName() . ", " . $gMap->getJsName() . "_marker);
              
        /**edited by Ukpro**/
        $('#h_lng').val(place.geometry.location.lng());
        $('#h_lat').val(place.geometry.location.lat());
        /** end edited by Ukpro **/
        
  });
  

$('.map_search').click(function(){
        $('#Address').trigger('keypress');
        console.log($('#Address'));
        google.maps.event.trigger(autocomplete, 'place_changed');
        return false;
    });

          ";

                            $gMap->renderMap(array(), Yii::app()->language);
                            ?>
                      
                 </div> </div>
</div><div class="clearfix"></div> 
</div>

 </div><!--end info-->

<!--appear-->
<?php $this->renderpartial('../home/sponsor', array('sponsers' => $sponsers)); ?>
<!--end appear-->


</div>
</div>
</div>