<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>




<div class="search">
    <div class="container">
        <div class="wrap">

<!--            <form role="form" action="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights" class="form-horizontal fligh-form ">
                <div class="form-group">
                    <div class="col-sm-1">
                        <i class="fa fa-plane flight-logo"></i>
                    </div>
                    <div class="col-sm-3 col-xs-12 first-input">
                        <input type="text" placeholder="From" id="" class="form-control">
                    </div>
                    <div class="col-sm-3 col-xs-12 first-input">
                        <input type="text" placeholder="To" id="" class="form-control">
                    </div>

                    <div class="col-sm-2 col-xs-12 second-input">
                        <div class="airline-go">
                            <a href="#">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                            <a href="#" class="refresh">
                                <i class="fa fa-refresh"></i>
                            </a>

                        </div>
                    </div> 

                    <div class="col-sm-2 col-xs-12 second-input">
                        <input type="email" placeholder="Depart" id="" class="form-control departure">
                        <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/calender.png"></i>
                    </div> 

                    <div class="col-sm-2 col-xs-12 second-input">
                        <input type="email" placeholder="Return" id="" class="form-control departure">
                        <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/calender.png"></i>
                    </div> 

                    <div class="col-sm-1 search-input"><button class="btn btn-default" type="submit">search</button></div>

                </div>



            </form>-->

            
            <?php
                        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'flight-search-form',
                            'action' => Yii::app()->request->baseUrl . "/travel/search_flights",
                            'method' => 'get',
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array(
                                'class' => 'margin0px',
                            ),
                        ));
                        ?>
            
            <div class="form-group">
                    <div class="col-sm-3 col-xs-12 first-input">
                         <?php
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'from_airport',
                                        'value' => $from_airport,
                                        'source' => Yii::app()->request->baseUrl . '/travel/iata_search',
                                        'options' => array(
                                            'minLength' => '1', // min chars to start search
                                            'select' => 'js:function(event, ui) { 
                                                            $("#from_ap").val(ui.item.id);
                                                        }'
                                        ),
                                        'htmlOptions' => array(
                                            'class' => 'span2 form-control',
                                            'placeholder' => 'Flying From ..',
                                        ),
                                    ));
                                    ?>
                                    <input name="from" type="hidden" value="<?php echo $from; ?>" id="from_ap" />

                    </div>
                    <div class="col-sm-3 col-xs-12 first-input">
                        <?php
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'to_airport',
                                        'value' => $to_airport,
                                        'source' => Yii::app()->request->baseUrl . '/travel/iata_search',
                                        'options' => array(
                                            'minLength' => '1', // min chars to start search
                                            'select' => 'js:function(event, ui) { 
                                                            $("#to_ap").val(ui.item.id);
                                                        }'
                                        ),
                                        'htmlOptions' => array(
                                            'class' => 'span2 form-control',
                                            'placeholder' => 'Going To ..',
                                        ),
                                    ));
                                    ?>
                                    <input name="to" type="hidden" value="<?php echo $to; ?>" id="to_ap" />
                                  
                    </div>

                    <div class="col-sm-2 col-xs-12 second-input">
                        <div class="airline-go">
                            <a href="#" id="one-way">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                            <a href="#" class="refresh" id="round-trip">
                                <i class="fa fa-refresh"></i>
                            </a>
 <input name="type" type="hidden" value="<?php echo $type; ?>" id="type" />
                        </div>
                    </div> 

                <script>roundTrip
                $(function(){
                   $("#one-way").click(function(){
                       $("#type").val('oneWay');
                   }) ;
                   
                    $("#round-trip").click(function(){
                       $("#type").val('roundTrip');
                   }) ;
                });
                </script>
                
                    <div class="col-sm-2 col-xs-12 second-input">
                        <?php
                                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'name' => 'depart',
                                            'value' => $depart,
                                            'options' => array(
                                                'showAnim' => 'fold',
                                                'dateFormat' => 'dd/mm/yy',
                                                'minDate' => date('d/m/Y'),
                                            ),
                                            'htmlOptions' => array(
                                                'size' => '16',
                                                'readonly' => true,
                                                'id' => 'dep',
                                                'class' => 'form-control',
                                                'style' => 'cursor:pointer;'
                                            ),
                                        ));
                                        ?>
                        <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/calender.png"></i>
                    </div> 

                    <div class="col-sm-2 col-xs-12 second-input">
                        <?php
                                        $rtv = date('d/m/Y', Helper::time_date($depart) + (60 * 60 * 24));
                                        if ($return) {
                                            $rtv = $return;
                                        }
                                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'name' => 'return',
                                            'value' => $rtv,
                                            'options' => array(
                                                'showAnim' => 'fold',
                                                'dateFormat' => 'dd/mm/yy',
                                                'minDate' => $depart,
                                            ),
                                            'htmlOptions' => array(
                                                'size' => '16',
                                                'readonly' => true,
                                                'id' => 'ret12',
                                                'class' => 'form-control',
                                                'style' => 'cursor:pointer;'
                                            ),
                                        ));
                                        ?>
                        <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/calender.png"></i>
                    </div> 

                    <div class="col-sm-1 search-input"><button class="btn btn-default" id="find_hotel" type="submit">search</button></div>
 <!--<button type="submit" id="find_hotel" class="searchSahdowfull span2 margin pull-right"><span class="srchptn">SEARCH</span></button>-->
                </div>

 <?php $this->endWidget(); ?>


        </div>
    </div>
</div><!--end search-->


<div class="container">
    <div class="wrap">


        <div class="col-md-12 col-xs-12 listing">
            <p class="col-md-12 col-xs-12 list-title">Top Domestic Flight Destinations</p>
<!--            http://localhost/2014/domtik/travel/search_flights?from=CAI&to=LON&type=roundTrip&depart=21%2F12%2F2014&return=28%2F12%2F2014&adults=1&children=0-->
            
            <?php
             $depart2 = date('d-m-Y');
             $return2 = date("d-m-Y", time()+(86400*7)); 
            foreach ($cities as $city){ ?>
            <div class="col-md-4 col-sm-8 col-xs-12 flight">
                <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight.png"></a>

                <div class="col-md-11 col-xs-11 flight-details">

                    <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
                    <a href="#" class="flight-name"><?php echo $city->country_name ?></a>
                    <span class="place"><?php echo $city->name ?></span>
                    <!--<span class="price">£325</span>-->
                    <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true) ?>/travel/search_flights?from=LON&to=<?= $city->iata_code?>&type=roundTrip&depart=<?= $depart2?>&return=<?= $return2?>&adults=1&children=0">Search Flights</a>
                </div>
            </div><!--end flight-->
            
            <?php } ?>
            <div id="appended" class="appended">

            </div>
            <div class="col-md-12 col-xs-12 show"><button onclick="doAjax()" class="btn btn-default more">show more</button></div>
        </div>


    </div><!--end img-->
    <Div class="clearfix"></Div>
    <!--tap-->
<!--
    <div role="tabpanel" class="fly listing">

         Nav tabs 
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#Middle" aria-controls="Middle East" role="tab" data-toggle="tab">Middle East</a></li>
            <li role="presentation">
                <a href="#Europe" aria-controls="Europe" role="Europe" data-toggle="tab">Europe</a></li>
            <li role="presentation"><a href="#North" aria-controls="North America" role="tab" data-toggle="tab">North America</a></li>
            <li role="presentation"><a href="#Asia" aria-controls="Asia" role="tab" data-toggle="tab">Asia</a></li>

            <li role="presentation"><a href="#Africa" aria-controls="Africa" role="tab" data-toggle="tab">Africa</a></li>
            <li role="presentation"><a href="#South" aria-controls="South America" role="tab" data-toggle="tab">South America</a></li>
            <li role="presentation"><a href="#Australia" aria-controls="Australia and Pacific" role="tab" data-toggle="tab">Australia and Pacific</a></li>
        </ul>

         Tab panes 
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="Middle">
                <div class="col-md-12 con-flight">
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>

                </div>


            </div>


            <div role="tabpanel" class="tab-pane" id="Europe"> <div class="col-md-9 con-flight">
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Istanbul </a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to London </a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>

                </div></div>
            <div role="tabpanel" class="tab-pane" id="North"> <div class="col-md-9 con-flight">
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>

                </div></div>
            <div role="tabpanel" class="tab-pane" id="Asia"><div class="col-md-9 con-flight">
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Istanbul </a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to London </a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/flights">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>

                </div></div>

            <div role="tabpanel" class="tab-pane" id="Africa"><div class="col-md-9 con-flight">
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Istanbul </a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to London </a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>

                </div></div>
            <div role="tabpanel" class="tab-pane" id="South America"><div class="col-md-9 con-flight">
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Istanbul </a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to London </a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>

                </div></div>
            <div role="tabpanel" class="tab-pane" id="Australia"><div class="col-md-9 con-flight">
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Istanbul </a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to London </a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="comp"><a href="#">Flights to Jeddah</a></span>
                        <span class="pri">EGP1,555</span>
                    </div>

                </div></div>
        </div>

    </div>-->
    <!--end tap-->


    <div class="wrap">
        <p class="col-md-12 col-xs-12 list-title">Top Flight Destinations by Country</p>
        <div class="col-md-4 col-sm-4 col-xs-12 country">

            <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">

                <?php for($i=0;$i<6 ;$i++){ 
                    $city_of_country = IataCodes::model()->find("country_name = '".$countries[$i]->country_name."' and app_location_type = 'City' ")->iata_code;
                    ?>
                <li><a href="<?php echo Yii::app()->getBaseUrl(true) ?>/travel/search_flights?from=LON&to=<?= $city_of_country ?>&type=roundTrip&depart=<?= $depart2?>&return=<?= $return2?>&adults=1&children=0"><span><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flag1.png">
                        </span>Flights to <?= $countries[$i]->country_name ?>s</a></li>
                <?php } ?>


            </ul>




        </div> <div class="col-md-4 col-sm-4 col-xs-12 country">

            <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">

                 <?php for($i=6;$i<12 ;$i++){ 
                    $city_of_country = IataCodes::model()->find("country_name = '".$countries[$i]->country_name."' and app_location_type = 'City' ")->iata_code;
                    ?>
                <li><a href="<?php echo Yii::app()->getBaseUrl(true) ?>/travel/search_flights?from=LON&to=<?= $city_of_country ?>&type=roundTrip&depart=<?= $depart2?>&return=<?= $return2?>&adults=1&children=0"><span><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flag1.png">
                        </span>Flights to <?= $countries[$i]->country_name ?></a></li>
                <?php } ?>


            </ul>




        </div> <div class="col-md-4 col-sm-4 col-xs-12 country">

            <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">

              <?php for($i=12;$i<18 ;$i++){ 
                    $city_of_country = IataCodes::model()->find("country_name = '".$countries[$i]->country_name."' and app_location_type = 'City' ")->iata_code;
                    ?>
                <li><a href="<?php echo Yii::app()->getBaseUrl(true) ?>/travel/search_flights?from=LON&to=<?= $city_of_country ?>&type=roundTrip&depart=<?= $depart2?>&return=<?= $return2?>&adults=1&children=0"><span><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flag1.png">
                        </span>Flights to <?= $countries[$i]->country_name ?></a></li>
                <?php } ?>


            </ul>




        </div>
    </div>   



</div>

<input type="hidden" name="dom_cities_page" id='dom_cities_page' value="1"/>
<script>
    function doAjax()
    {
       var page =  $("#dom_cities_page").val();
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/travel/loadMoreDomCities",
           type:"POST",
            data: "page="+page,
            success: function (data) {
                //alert("akjahjk");            
                $("#dom_cities_page").val(parseInt(data)+1);
                $("#appended").append(data);
            }
        });
    }
</script>