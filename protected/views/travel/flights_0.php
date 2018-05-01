<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>


<div class="search">
    <div class="container">
        <div class="wrap">

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
                            <a href="javascript:void(0)" id="one-way">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                            <a href="javascript:void(0)" class="refresh" id="round-trip">
                                <i class="fa fa-refresh"></i>
                            </a>
 <input name="type" type="hidden" value="<?php echo $type; ?>" id="type" />
                        </div>
                    </div> 

                <script>
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
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="page-headers">
                <ul class="page_path">
                    <li class="active"><a href="#flights" data-toggle="tab">Flights</a></li>
                    <li><a href="#airline" data-toggle="tab">Airlines</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>



<div id="myTabContent" class="tab-content content-tab-block">

    <div class="tab-pane fade active in" id="flights">

        <div class="container">
            <div class="wrap">

                <div class="col-sm-3 col-xs-12 ">
            <div class="left-pan">
                <!--<span>Find hotel name </span>
                <input class="form-control left-input" value=""  type="text">-->

<!--                <span>Price Alert </span>
                <div class="airline-alert">
                    <i class="fa fa-cubes"></i>
                    <h4>Receive Price Alerts</h4>
                    <p>We will email you the best fares for this search</p>
                </div>-->

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

                                    <input type="text" class="price" id="price-amount">
                                </p>
                                <div class="slider-price" id="slider-price"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading bg-coll" role="tab" id="headingTwo">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span>
                                        Auto-Filter Airfares
                                        <a href="#" class="clear">clear</a>
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">

                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Apply Wego science
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
                        <div class="panel-heading bg-coll" role="tab" id="headingsix">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapseTwo">
                                    <span>
                                        Stops

                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix">
                            <div class="panel-body">

                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input name="stops" class="stops" value="none" type="checkbox"> Direct

                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <a href="#" style="top: 25px;" class="clear">$500</a>

                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input name="stops" class="stops" value="one" type="checkbox"> 1 stop

                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <a href="#" style="top: 60px;" class="clear">$500</a>

                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input name="stops" class="stops" value="two_plus" type="checkbox">2 stops

                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <a href="#" style="top: 100px;" class="clear">$500</a>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading bg-coll" role="tab" id="heading6">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    <span>Depart</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
                            <div class="panel-body">

                                <p class="amount"  >

                                    <input type="text"   class="price" id="depart-amount">
                                </p>
                                <div class="slider-price" id="depart-price"></div>

                                <!--<div class="clearfix"></div>-->

<!--                                <div class="table-responsive">
                                    <table class="table airlines-logos">
                                        <tr>
                                            <td><a href="#">Morning</a></td>
                                            <td><a href="#">Afternoon</a></td>
                                            <td><a href="#">Evening</a></td>
                                        </tr>
                                    </table>
                                </div>-->

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading bg-coll" role="tab" id="headingseven">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
                                    <Span>Return</Span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven">
                            <div class="panel-body">

                                <p class="amount">

                                    <input type="text"  class="price" id="return-amount">
                                </p>
                                <div class="slider-price" id="return-price"></div>

<!--                                <div class="clearfix"></div>

                                <div class="table-responsive">
                                    <table class="table airlines-logos">
                                        <tr>
                                            <td><a href="#">Morning</a></td>
                                            <td><a href="#">Afternoon</a></td>
                                            <td><a href="#">Evening</a></td>
                                        </tr>
                                    </table>
                                </div>-->

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading bg-coll" role="tab" id="heading8">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap8" aria-expanded="false" aria-controls="collap8">
                                    <span>Stopover Duration</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collap8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
                            <div class="panel-body">

                                <p class="amount" >

                                    <input type="text" class="price" id="stop-amount">
                                </p>
                                <div class="slider-price" id="stop-slider"></div>

<!--                                <div class="clearfix"></div>

                                <div class="table-responsive">
                                    <table class="table airlines-logos">
                                        <tr>
                                            <td><a href="#">Morning</a></td>
                                            <td><a href="#">Afternoon</a></td>
                                            <td><a href="#">Evening</a></td>
                                        </tr>
                                    </table>
                                </div>-->


                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading bg-coll" role="tab" id="trip">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap9" aria-expanded="false" aria-controls="collap9">
                                    <span>Trip Duration</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collap9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="trip">
                            <div class="panel-body">

                                <p class="amount" >

                                    <input type="text" class="price" id="trip-amount">
                                </p>
                                <div class="slider-price" id="trip-duration-price"></div>

<!--                                <div class="clearfix"></div>

                                <div class="table-responsive">
                                    <table class="table airlines-logos">
                                        <tr>
                                            <td><a href="#">Morning</a></td>
                                            <td><a href="#">Afternoon</a></td>
                                            <td><a href="#">Evening</a></td>
                                        </tr>
                                    </table>
                                </div>-->


                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading bg-coll" role="tab" id="heading9">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap10" aria-expanded="false" aria-controls="collap10">
                                    <span>Airlines</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collap10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading10">
                            <div class="panel-body">

                                <?php foreach ($airlines as $airline){
                                    //print_r($airlines);
                                    $airline_ = explode('--', $airline);
                                    ?>
                                <div class="check-block">

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="<?= $airline_[1] ?>" name="airline_filter" class='airline_filter'><?= $airline_[0] ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--<a href="#" class="col-sm-2 clear" style="position: relative;top: 15px;">$600</a>-->

                                </div>

                                <?php  } ?>
                                <div class="check-block">

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox">Uk Airways
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="#" class="col-sm-2 clear" style="position: relative;top: 15px;">$600</a>

                                </div>



                                <div class="clearfix"></div>

                                <div class="table-responsive">
                                    <table class="table airlines-logos">
                                        <tr>
                                            <td><a href="#"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/EK.png" alt="" /></a></td>
                                            <td><a href="#"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/EK.png" alt="" /></a></td>
                                            <td><a href="#"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/EK.png" alt="" /></a></td>
                                            <td><a href="#"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/EK.png" alt="" /></a></td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div> 

                    <div class="panel panel-default">
                        <div class="panel-heading bg-coll" role="tab" id="heading11">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap11" aria-expanded="false" aria-controls="collap11">
                                    <span>Departure</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collap11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading11">
                            <div class="panel-body">

                                <?php foreach ($departures as $dep){
                                    $dep_ = explode('--', $dep)
                                    ?>
                                <div class="check-block">

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="<?= $dep_[1] ?>" name="airport-filter" class="airport-filter"><?= $dep_[0]?> Airport
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="#" class="col-sm-2 clear" style="position: relative;top: 15px;">$600</a>

                                </div>
<?php } ?>
                                



                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>


                    <div class="panel panel-default">
                        <div class="panel-heading bg-coll" role="tab" id="heading12">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap12" aria-expanded="false" aria-controls="collap12">
                                    <span>Arrival</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collap12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading12">
                            <div class="panel-body">
<?php foreach ($arrivals as $arrival){
    $arr_ = explode('--', $arrival);
    ?>
                                <div class="check-block">

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="arrival-airport-filter" class="arrival-airport-filter" value="<?= $arr_[1] ?>"><?= $arr_[0] ?> Airport
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--<a href="#" class="col-sm-2 clear" style="position: relative;top: 15px;">$600</a>-->

                                </div>

<?php } ?>

                            </div>
                        </div>
                    </div>


                    <div class="clearfix"></div> 

<!--
                    <div class="panel panel-default">
                        <div class="panel-heading bg-coll" role="tab" id="heading13">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap13" aria-expanded="false" aria-controls="collap13">
                                    <span>Transit Airports</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collap13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading13">
                            <div class="panel-body">

                                <div class="check-block">

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox">Madrid Airport
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="#" class="col-sm-2 clear" style="position: relative;top: 15px;">$600</a>

                                </div>

                                <div class="check-block">

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox">Barcelona Airport
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="#" class="col-sm-2 clear" style="position: relative;top: 15px;">$600</a>

                                </div>

                                <div class="check-block">

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox">Munich Airport
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="#" class="col-sm-2 clear" style="position: relative;top: 15px;">$600</a>

                                </div>


                                <div class="check-block">

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox">New York Air
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="#" class="col-sm-2 clear" style="position: relative;top: 15px;">$600</a>

                                </div>


                            </div>
                        </div>
                    </div>-->

                    <div class="search-flights">
                        <span class="border">Search Flight Number </span>
                        <input class="form-control left-input" value=""  type="text" id="flight-number">
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading bg-coll" role="tab" id="heading14">
                            <h4 class="panel-title h4-coll">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap14" aria-expanded="false" aria-controls="collap14">
                                    <span>Booking Sites</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collap14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading14">
                            <div class="panel-body">

                                <?php
                                //print_r($providers);die;
                                foreach ($providers as $prov){ ?>
                                <div class="check-block">

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="provider-filter" class="provider-filter" value="<?= $prov ?>"><?= $prov ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--<a href="#" class="col-sm-2 clear" style="position: relative;top: 15px;">$600</a>-->

                                </div>

                              <?php } ?>


                            </div>
                        </div>
                    </div>

                </div>
            </div><!--end left-pan-->

        </div>

                <div class="col-sm-9">

                    
             <?php $i=1;
                    foreach ($flights as $flight){
                        ?>
                    
            <div class="col-sm-12 col-xs-12 right-pan flights-content hotel-bg">

                <div class="flights-header">
                   <?php
                    if($outbound_segments = $flight->outbound_segments){
                   // foreach ($outbound_segments[0] as $obs){ 
                        ?>
                    <div class="col-sm-4 flights-left">
                        <span>Depart: </span>
                        <label><?php echo $outbound_segments[0]->departure_code.' -' .$outbound_segments[0]->arrival_code ?></label>
                    </div>
                    <?php } ?>
                    
                    <?php
                     if($inbound_segments = $flight->inbound_segments){
                    //foreach ($inbound_segments as $ibs){ 
                        ?>
                    
                    <div class="col-sm-4 flights-middle">
                        <span>Return: </span>
                        <label><?php echo $inbound_segments[0]->departure_code.' -' .$inbound_segments[0]->arrival_code ?></label>
                    </div>
                     <?php } ?>

                </div>

                <div class="clearfix"></div>

                <div class="flights-body">

                    <div class="col-sm-4 flights-left">
                                       <?php
                    if($outbound_segments = $flight->outbound_segments){ ?>
                        <a href="#"><img src="http://www.mediawego.com/images/flights/airlines/120x40t/<?= $outbound_segments[0]->airline_code ?>.gif"></a><br />
                       <?php
          
                   // foreach ($outbound_segments as $obs){ 
                        $loc_d_time = Helper::flight_date($outbound_segments[0]->departure_time);
                       $loc_a_time = Helper::flight_date($outbound_segments[0]->arrival_time);
//$seconds = strtotime($loc_a_time) - strtotime($loc_d_time);
//echo $hours = ($seconds );
                        ?>
                        <div>
                            <label><?php echo $outbound_segments[0]->airline_name ?></label>
                            <b><?php echo count($flight->outbound_segments) - 1; ?> Stop</b>
                            <!--<i><?php// echo $hours ?></i>-->
                        </div>
                        <div>
                            <label><?php echo $loc_d_time ?></label>
                            <b> <?php echo $outbound_segments[0]->departure_code ?></b>
                            <label><?php echo $loc_a_time ?></label>
                            <i><?php echo $outbound_segments[0]->arrival_code ?></i>
                        </div>
                   
                    <?php } ?>
 </div>
                    <div class="col-sm-4 flights-middle">
                            <?php
                    if($inbound_segments = $flight->inbound_segments){?>
                        
                        <a href="#"><img src="http://www.mediawego.com/images/flights/airlines/120x40t/<?= $inbound_segments[0]->airline_code ?>.gif"></a><br />
                        
                     <?php
                 //   foreach ($inbound_segments as $ibs){ 
                        $loc_d_time = Helper::flight_date($inbound_segments[0]->departure_time);
                       $loc_a_time = Helper::flight_date($inbound_segments[0]->arrival_time);

//$seconds = strtotime($loc_a_time) - strtotime($loc_d_time);
//$hours = ceil($seconds / 60 /  60);
                        ?>
                        <div>
                            <label><?php echo $inbound_segments[0]->airline_name ?></label>
                            <b><?php echo count($flight->inbound_segments) - 1; ?> stops</b>
                            <i><?php //echo $hours ?></i>
                        </div>
                        <div>
                            <label><?php echo $loc_d_time ?></label>
                            <b> <?php echo $inbound_segments[0]->departure_code ?></b>
                            <label><?php echo $loc_a_time ?></label>
                            <i><?php echo $inbound_segments[0]->arrival_code ?></i>
                        </div>
                    <?php } ?>
                    </div>

                    <div class="col-sm-3 pull-right flights-right deal">
                        <?php $str = Helper::get_currency_symbol(round(str_replace(',', '', $flight->best_fare->price), 2), $currency); ?>
                        <p><?php echo $str ?></p>
                        <a target="_blank" href="<?php echo $flight->best_fare->deeplink; ?>" class="deal-btn" type="submit">View deal</a>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="flights-header">
                    <a href="javascript:void(0);" data-target="#table-collapse<?= $i ?>" data-toggle="collapse" class="show-details">Show Details <i class="fa fa-arrow-circle-down"></i> </a>
                </div>

                <div class="table-responsive hidden-table collapse" id="table-collapse<?= $i ?>">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Airlines</td>
                                <td>Flight NO.</td>
                                <td>From </td>
                                <td>To </td>
                                <td>Duration </td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr style=""><td colspan="5"><span class="">Depart </span></td></tr> 
                            <?php 
                            if($outbound_segments = $flight->outbound_segments){
                    foreach ($outbound_segments as $obs){ 
                                
                               $loc_d_time = Helper::flight_date($obs->departure_time);
                       $loc_a_time = Helper::flight_date($obs->arrival_time);

                         ?>
                            <tr>
                                <td> <a href="#"><img src="http://www.mediawego.com/images/flights/airlines/120x40t/<?= $obs->airline_code ?>.gif"></a><br />
                       </td>
                                <td>
                                    <div class="flights-body">
                                        <label><?php echo $obs->designator_code ?></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="flights-body">
                                        <label><?php echo $loc_d_time ?></label>
                                        <b> <?php echo $obs->departure_code ?></b>
                                    </div>
                                </td>
                                <td>
                                    <div class="flights-body">
                                       
                                        <label><?php echo $loc_a_time ?></label>
                                        <i><?php echo $obs->arrival_code ?></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="flights-body">
                                        <label>4h 25m</label>
                                    </div>
                                </td>
                            </tr>
                            
                    <?php }} ?>   
                            <tr style=""><td colspan="5"><span class="">Return </span></td></tr> 
                                <?php 
                            if($inbound_segments = $flight->inbound_segments){
                    foreach ($inbound_segments as $ibs){ 
                                
                               $loc_d_time = Helper::flight_date($ibs->departure_time);
                       $loc_a_time = Helper::flight_date($ibs->arrival_time);

                         ?>
                            <tr class="">
                                <td> <a href="#"><img src="http://www.mediawego.com/images/flights/airlines/120x40t/<?= $ibs->airline_code ?>.gif"></a><br />
                                   
                       </td>
                                <td>
                                    <div class="flights-body">
                                        <label><?php echo $ibs->designator_code ?></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="flights-body">
                                        <label><?php echo $loc_d_time ?></label>
                                        <b> <?php echo $ibs->departure_code ?></b>
                                    </div>
                                </td>
                                <td>
                                    <div class="flights-body">
                                       
                                        <label><?php echo $loc_a_time ?></label>
                                        <i><?php echo $ibs->arrival_code ?></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="flights-body">
                                        <label>4h 25m</label>
                                    </div>
                                </td>
                            </tr>
                            
                    <?php }} ?>   
                       
                            
                        </tbody>

                    </table>
                </div>

            </div>

            
                    <?php $i++; } ?>
            
            
            
            
            
            
            

            <div class="clearfix"></div>

            <?php if ($total_pages) { ?>
            <div class="pagination">
                <?php if ($page > 1) { ?>
                                            <li><a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => $filter_key, 'order' => $order, 'page' => ($page - 1))); ?>">Prev</a></li>
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
                                            $url = Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => $filter_key, 'order' => $order, 'page' => $i));
                                            if ($i == $page) {
                                                $class = "active";
                                                $url = "javascript:void(0)";
                                            }
                                            ?>
                                            <li class="<?php echo $class ?>"><a href="<?php echo $url; ?>"><?php echo $i; ?></a></li>
                                        <?php } ?>
                                        <?php if ($page < $total_pages) { ?>
                                            <li class=""><a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => $filter_key, 'order' => $order, 'page' => ($page + 1))); ?>">Next</a></li>
                                        <?php } ?>
            </div>
            <?php } ?>


                </div>

            </div>
        </div>

    </div>

    <div class="tab-pane fade" id="airline">


        <div class="container">
            <div class="wrap">

                <div class="col-sm-3 col-xs-12 ">
                    <div class="left-pan">
                        <!--<span>Find hotel name </span>
                        <input class="form-control left-input" value=""  type="text">-->

<!--                        <span>Price Alert </span>
                        <div class="airline-alert">
                            <i class="fa fa-cubes"></i>
                            <h4>Receive Price Alerts</h4>
                            <p>We will email you the best fares for this search</p>
                        </div>-->

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

                                            <input type="text" id="price">
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
                                            <span>
                                                Auto-Filter Airfares
                                                <a href="#" class="clear">clear</a>
                                            </span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> Apply Wego science
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
                                <div class="panel-heading bg-coll" role="tab" id="headingsix">
                                    <h4 class="panel-title h4-coll">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapseTwo">
                                            <span>
                                                Stops

                                            </span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> Apply Wego science

                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="#" style="top: 25px;" class="clear">$500</a>

                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="panel panel-default">
                                <div class="panel-heading bg-coll" role="tab" id="heading6">
                                    <h4 class="panel-title h4-coll">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                            <span>Depart</span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
                                    <div class="panel-body">

                                        <p class="amount" >

                                            <input type="text" class="price">
                                        </p>
                                        <div class="slider-price"></div>

                                        <div class="clearfix"></div>

                                        <div class="table-responsive">
                                            <table class="table airlines-logos">
                                                <tr>
                                                    <td><a href="#">Morning</a></td>
                                                    <td><a href="#">Afternoon</a></td>
                                                    <td><a href="#">Evening</a></td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="panel panel-default">
                                <div class="panel-heading bg-coll" role="tab" id="headingseven">
                                    <h4 class="panel-title h4-coll">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
                                            <Span>Return</Span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven">
                                    <div class="panel-body">

                                        <p class="amount" >

                                            <input type="text" class="price">
                                        </p>
                                        <div class="slider-price"></div>

                                        <div class="clearfix"></div>

                                        <div class="table-responsive">
                                            <table class="table airlines-logos">
                                                <tr>
                                                    <td><a href="#">Morning</a></td>
                                                    <td><a href="#">Afternoon</a></td>
                                                    <td><a href="#">Evening</a></td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="panel panel-default">
                                <div class="panel-heading bg-coll" role="tab" id="heading8">
                                    <h4 class="panel-title h4-coll">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap8" aria-expanded="false" aria-controls="collap8">
                                            <span>Stopover Duration</span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collap8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
                                    <div class="panel-body">

                                        <p class="amount" >

                                            <input type="text" class="price">
                                        </p>
                                        <div class="slider-price"></div>

                                        <div class="clearfix"></div>

                                        <div class="table-responsive">
                                            <table class="table airlines-logos">
                                                <tr>
                                                    <td><a href="#">Morning</a></td>
                                                    <td><a href="#">Afternoon</a></td>
                                                    <td><a href="#">Evening</a></td>
                                                </tr>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="panel panel-default">
                                <div class="panel-heading bg-coll" role="tab" id="heading9">
                                    <h4 class="panel-title h4-coll">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap9" aria-expanded="false" aria-controls="collap9">
                                            <span>Airlines</span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collap9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading9">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">Uk Airways
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="#" style="top: 25px;" class="clear">$500</a>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">swiss international
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="#" style="top: 62px;" class="clear">$700</a>

                                        <div class="clearfix"></div>

                                        <div class="table-responsive">
                                            <table class="table airlines-logos">
                                                <tr>
                                                    <td><a href="#"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/EK.png" alt="" /></a></td>
                                                    <td><a href="#"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/EK.png" alt="" /></a></td>
                                                    <td><a href="#"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/EK.png" alt="" /></a></td>
                                                    <td><a href="#"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/EK.png" alt="" /></a></td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div> 

                        </div>
                    </div><!--end left-pan-->

                </div>
                <div class="col-sm-9">
                    
                    <?php  
//                    print_r(array_unique($airlines));die;
                    foreach ($airlines as $airline){ 
                        $airline_ = explode('--', $airline);
                        ?>
                    <div class="col-sm-12 col-xs-12 right-pan hotel-bg">

                        <div class="col-sm-3">
                            <a href="#">
                                <?php echo $airline_[0] ?>
                                <img src="http://www.mediawego.com/images/flights/airlines/120x40t/<?= $airline_[1] ?>.gif">
                            </a>

                        </div>

                        <div class="col-sm-6 pull-right deal">
                            <div class="col-sm-6">
                                <!--<p>EGP329</p>-->
                                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png">
                            </div>
                            <div class="col-sm-6">
                                <!--<a href="details" class="deal-btn" type="submit">View deal</a>-->
                            </div>
                        </div>

                    </div>
                    <?php } ?>

                </div>

            </div>
        </div>

    </div>

</div>






<script>
    
    $(function(){
        
          // filter by provider
        $(".provider-filter").each(function(){
            $(this).click(function(){
            var provider_codes = $(this).val();
            var kvp = document.location.search.substr(1)+'&provider_codes[]='+provider_codes;
//          //  console.log(kvp);
            document.location.search = kvp;
        });
//         
        });
        
            // filter by airline
        $(".airline_filter").each(function(){
            $(this).click(function(){
            var airline_codes = $(this).val();
            var kvp = document.location.search.substr(1)+'&airline_codes[]='+airline_codes;
//          //  console.log(kvp);
            document.location.search = kvp;
        });
//         
        });
        
        // filter by departure airport
        $(".airport-filter").each(function(){
            $(this).click(function(){
            var departure_airport_codes = $(this).val();
            var kvp = document.location.search.substr(1)+'&departure_airport_codes[]='+departure_airport_codes;
//          //  console.log(kvp);
            document.location.search = kvp;
        });
//         
        });
        
         // filter by arrival airport
        $(".arrival-airport-filter").each(function(){
            $(this).click(function(){
            var arrival_airport_codes = $(this).val();
            var kvp = document.location.search.substr(1)+'&arrival_airport_codes[]='+arrival_airport_codes;
//          //  console.log(kvp);
            document.location.search = kvp;
        });
//         
        });
        
         // filter by stops
        $(".stops").each(function(){
            $(this).click(function(){
            var stop_types = $(this).val();
            var kvp = document.location.search.substr(1)+'&stop_types[]='+stop_types;
//          //  console.log(kvp);
            document.location.search = kvp;
        });
//         
        });
       
        
        // filter by stars
//        $(".star_filter").each(function(){
//            $(this).click(function(){
//                
//            var star_filter = $(this).val();
//            var kvp = document.lostopscation.search.substr(1)+'&stars[]='+star_filter;
//            console.log(kvp);
//            document.location.search = kvp;
//            //insertParam("stars[]" , star_filter);
//            });
//        });
//      
//        
//
//  // filter by aminity
//        $(".aminity_filter").each(function(){
//            $(this).click(function(){
//                
//            var amenities_filter = $(this).val();
//            var kvp = document.location.search.substr(1)+'&amenities[]='+amenities_filter;
//          //  console.log(kvp);
//            document.location.search = kvp;
//            //insertParam("stars[]" , star_filter);
//            });
//        });
//        
//  
//  // filter by property type
//        $(".property_type").each(function(){
//            $(this).click(function(){
//                
//            var property_types = $(this).val();
//            var kvp = document.location.search.substr(1)+'&property_types[]='+property_types;
//           // console.log(kvp);
//            document.location.search = kvp;
//            //insertParam("stars[]" , star_filter);
//            });
//        });
//        
       $("#slider-price").click(function(){ 
           var price = $("#price-amount").val();
           var min_price = price.split(' - ')[0];
           min_price = min_price.replace("$"," ");
           var max_price = price.split(' - ')[1];
           max_price = max_price.replace("$"," ");
         //  alert(max_price);
           
           var key = encodeURI("price_min");
     var   value = encodeURI(min_price);
     
     
      var key2 = encodeURI("price_max");
     var   value2 = encodeURI(max_price);

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
        
        //############3
        //  kvp = document.location.search.substr(1).split('&');

        var i = kvp.length;
        var x;
        while (i--)
        {
            x = kvp[i].split('=');

            if (x[0] == key2)
            {
                x[1] = value2;
                kvp[i] = x.join('=');
                break;
            }
        }

        if (i < 0) {
            kvp[kvp.length] = [key2, value2].join('=');
        }

        document.location.search = kvp.join('&');
 
//          insertParam("price_min" , min_price);
//          insertParam("price_max" , max_price);
       }); 
       
       
       
       //stopover duration 
        $("#stop-slider").click(function(){ 
           var stopover = $("#stop-amount").val();
           var stopover_duration_min = stopover.split(' - ')[0];
           stopover_duration_min = stopover_duration_min.replace("$"," ");
           var stopover_duration_max = stopover.split(' - ')[1];
           stopover_duration_max = stopover_duration_max.replace("$"," ");
         //  alert(max_price);
           
           var key = encodeURI("stopover_duration_min");
     var   value = encodeURI(stopover_duration_min);
     
     
      var key2 = encodeURI("stopover_duration_max");
     var   value2 = encodeURI(stopover_duration_max);

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
        
        //############3
        //  kvp = document.location.search.substr(1).split('&');

        var i = kvp.length;
        var x;
        while (i--)
        {
            x = kvp[i].split('=');

            if (x[0] == key2)
            {
                x[1] = value2;
                kvp[i] = x.join('=');
                break;
            }
        }

        if (i < 0) {
            kvp[kvp.length] = [key2, value2].join('=');
        }

        document.location.search = kvp.join('&');
 
//          insertParam("price_min" , min_price);
//          insertParam("price_max" , max_price);
       }); 
       
       
       
       
       
       
              //trip duration 
        $("#trip-duration-price").click(function(){ 
           var duration = $("#trip-amount").val();
           var duration_min = duration.split(' - ')[0];
           duration_min = duration_min.replace("$"," ");
           var duration_max = duration.split(' - ')[1];
           duration_max = duration_max.replace("$"," ");
         //  alert(max_price);
           
           var key = encodeURI("duration_min");
     var   value = encodeURI(duration_min);
     
     
      var key2 = encodeURI("duration_max");
     var   value2 = encodeURI(duration_max);

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
        
        //############3
        //  kvp = document.location.search.substr(1).split('&');

        var i = kvp.length;
        var x;
        while (i--)
        {
            x = kvp[i].split('=');

            if (x[0] == key2)
            {
                x[1] = value2;
                kvp[i] = x.join('=');
                break;
            }
        }

        if (i < 0) {
            kvp[kvp.length] = [key2, value2].join('=');
        }

        document.location.search = kvp.join('&');
 
//          insertParam("price_min" , min_price);
//          insertParam("price_max" , max_price);
       }); 
       
       
       
       
       
       //depart slider
         $("#depart-price").click(function(){  
           var price = $("#depart-amount").val();
           var min_price = price.split(' - ')[0];
           var outbound_departure_day_time_min = min_price.replace("$"," ");
           var max_price = price.split(' - ')[1];
           var outbound_departure_day_time_max = max_price.replace("$"," ");
 
  var kvp = document.location.search.substr(1)+'&departure_day_time_filter_type=separate';
  
  var key = encodeURI("outbound_departure_day_time_min");
     var   value = encodeURI(outbound_departure_day_time_min);
     
     
      var key2 = encodeURI("outbound_departure_day_time_max");
     var   value2 = encodeURI(outbound_departure_day_time_max);

         kvp = kvp.split('&');

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
        
        //############3
        //  kvp = document.location.search.substr(1).split('&');

        var i = kvp.length;
        var x;
        while (i--)
        {
            x = kvp[i].split('=');

            if (x[0] == key2)
            {
                x[1] = value2;
                kvp[i] = x.join('=');
                break;
            }
        }

        if (i < 0) {
            kvp[kvp.length] = [key2, value2].join('=');
        }

        document.location.search = kvp.join('&');

       }); 
       
        //return slider
         $("#return-price").click(function(){ 
           var price = $("#return-amount").val();
           var min_price = price.split(' - ')[0];
           var inbound_departure_day_time_min = min_price.replace("$"," ");
           var max_price = price.split(' - ')[1];
           var inbound_departure_day_time_max = max_price.replace("$"," ");
 
 var kvp = document.location.search.substr(1)+'&departure_day_time_filter_type=separate';
 
  var key = encodeURI("inbound_departure_day_time_min");
     var   value = encodeURI(inbound_departure_day_time_min);
     
     
      var key2 = encodeURI("inbound_departure_day_time_max");
     var   value2 = encodeURI(inbound_departure_day_time_max);

         kvp = kvp.split('&');

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
        
        //############3
        //  kvp = document.location.search.substr(1).split('&');

        var i = kvp.length;
        var x;
        while (i--)
        {
            x = kvp[i].split('=');

            if (x[0] == key2)
            {
                x[1] = value2;
                kvp[i] = x.join('=');
                break;
            }
        }

        if (i < 0) {
            kvp[kvp.length] = [key2, value2].join('=');
        }

        document.location.search = kvp.join('&');

//          insertParam("outbound_departure_day_time_min" , inbound_departure_day_time_min);
//          insertParam("outbound_departure_day_time_max" , inbound_departure_day_time_max);
       }); 
       
      
        $("#flight-number").focusout(function(){
            var flight_number = $(this).val();
            insertParam("designator_codes[]" , flight_number);
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
