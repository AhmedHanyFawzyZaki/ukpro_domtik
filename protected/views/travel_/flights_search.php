<?php
$this->pageTitle = Yii::app()->name . ' - Flights Search';
?>

<script type='text/javascript' src='http://openx.wayfareinteractive.com/openx/www/delivery/spcjs.php?id=420&amp;zones=14410'></script>
<script type='text/javascript'>OA_show(14410);</script>

<?php
Yii::app()->clientScript->registerScript('vdet', '
    var flag = true;
    $(".view_details").click(function(){
        if(flag){
            flag = false;
            var ths = $(this);
            var summ = ths.attr("summ");
            var det = ths.attr("detail");
            if($(summ).is(":visible")){
                $(det).show();
                $(summ).hide();
                //ths.html("Flight Details -");
                flag = true;
            }else{
                $(det).hide();
                $(summ).show();
                //ths.html("Flight Details +");
                flag = true;
            }
        }
    });
    
    $("#find_flight").click(function(){
        if($("#from_ap").val() == "" && $("#from_ap").val() == ""){
            alert("you must select the origin and the destination of the flight");
            return false;
        }
    });
    
    $(".togg").click(function(){
        var ths = $(this);
        $(".togg").removeClass("active");
        ths.addClass("active");
        if(ths.attr("id") == "oneWay"){
            $("#ret_date").hide();
        }else{
            $("#ret_date").show();
        }
        $("#type").val(ths.attr("id"));
    });
    
    
    $("#dep").change(function(){
        $("#ret12").val(chk_date($(this).val(),7));
        $("#ret12").datepicker("option", "minDate", $(this).val());
    });
    
    $("#ret12").change(function(){
        var dateParts = $(this).val().split("/");
        var date_obj = new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
        
        var dateParts2 = $("#dep").val().split("/");
        var date_obj2 = new Date(dateParts2[2], (dateParts2[1] - 1), dateParts2[0]);
        
        if(date_obj2.getTime() >= date_obj.getTime()){
            $("#ret12").val(chk_date($("#dep").val(),7));
        }
    });

    function chk_date(old_date,plus){
        var dateParts = old_date.split("/");
        var date_obj = new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
        date_obj.setDate(date_obj.getDate() + plus);
        
        var dd = date_obj.getDate();
        var mm = date_obj.getMonth()+1;
        var yyyy = date_obj.getFullYear();
        
        if(dd < 10){
            dd = "0" + dd;
        }
        if(mm < 10){
            mm = "0" + mm;
        }

        var newd = dd + "/" + mm + "/" + yyyy;
        
        return newd;
    }

    $(".cal_ico").click(function(){
        var ths = $(this);
        if($(ths.attr("cd")).datepicker("widget").is(":visible")){
            $(ths.attr("cd")).datepicker("hide");
        }else{
            $(ths.attr("cd")).datepicker("show");
        }
    });
');
?>

<?php if($_GET['flag']==1){ ?>
<script> window.location = "<?=Yii::app()->createUrl('travel/flight_results', array('search_id' => $_GET['search_id'], 'trip_id' => $_GET['trip_id'], 'currency' => $_GET['currency']))?>"; </script>
<?php } ?>

<!-- content
        ================================================== --> 
<div class="row-fluid">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">

                <div class="row-fluid" id="onetwodiv" >
                    <div class="span12 top50px bottom10px">

                        <div class="row-fluid">
                            <div class="row-fluid">
                                <div class="span12"  style="font-size: 18px;">
                                    <span class="words" style="font-size: 20px;letter-spacing: normal;"><?php echo $from_airport; ?></span>&nbsp;&nbsp;To&nbsp;&nbsp;<span class="words" style="font-size: 20px;"><?php echo $to_airport; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <i class="site_hint" style="font-size: 15px;">Departing </i>
                                <span class="site_color"><?php echo $depart; ?></span>
                                <?php if ($type == "roundTrip") { ?>
                                    <i class="site_hint" style="font-size: 15px;"> and Returning </i>
                                    <span class="site_color"><?php echo $return; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <button id="onetwobtn" class="searchSahdowfull span2 margin pull-right"><span class="srchptn">CHANGE</span></button>
                    </div>
                </div>

                <div class="row-fluid" id="onetwosrch">
                    <div class="span12 color_div top50px">
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
                        <div class="row-fluid controls_f">
                            <div style="float: left;width:80%">
                                <div style="float: left;width:100%;margin-bottom:5px;">
                                    <div class="btn-group">

                                        <button type="button" id="roundTrip" class="btn togg <?php
                                        if ($type == "roundTrip") {
                                            echo 'active';
                                        }
                                        ?>"><i class="icon-refresh"></i></button>
                                        <button type="button" id="oneWay" class="btn togg <?php
                                        if ($type == "oneWay") {
                                            echo 'active';
                                        }
                                        ?>"><i class="icon-repeat"></i></button>
                                    </div>
                                    <input name="type" type="hidden" value="<?php echo $type; ?>" id="type" />
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
                                            'class' => 'span2',
                                            'placeholder' => 'Flying From ..',
                                        ),
                                    ));
                                    ?>
                                    <input name="from" type="hidden" value="<?php echo $from; ?>" id="from_ap" />

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
                                            'class' => 'span2',
                                            'placeholder' => 'Going To ..',
                                        ),
                                    ));
                                    ?>
                                    <input name="to" type="hidden" value="<?php echo $to; ?>" id="to_ap" />
                                    <div class="input-append date">
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
                                                'class' => 'w110px',
                                                'style' => 'cursor:pointer;'
                                            ),
                                        ));
                                        ?>
                                        <span class="add-on cal_ico" cd="#dep" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                    </div>  
                                    <?php
                                    $str = "display:none;";
                                    if ($type == "roundTrip") {
                                        $str = "";
                                    }
                                    ?>
                                    <div class="input-append date" id="ret_date" style="<?php echo $str; ?>">
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
                                                'class' => 'w110px',
                                                'style' => 'cursor:pointer;'
                                            ),
                                        ));
                                        ?>
                                        <span class="add-on cal_ico" cd="#ret12" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                    </div>  
                                    <select name="class" class="span2">
                                        <option <?php
                                        if ($cabin == "economy") {
                                            echo 'selected';
                                        }
                                        ?> value="economy">Economy Class</option>
                                        <option <?php
                                        if ($cabin == "business") {
                                            echo 'selected';
                                        }
                                        ?> value="business">Business Class</option>
                                        <option <?php
                                        if ($cabin == "first") {
                                            echo 'selected';
                                        }
                                        ?> value="first">First Class</option>
                                    </select>
                                </div>


                                <select name="adults" class="span2">
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <?php
                                        $sel = "";
                                        if ($i == $adults) {
                                            $sel = "selected";
                                        }
                                        $str = "Adults";
                                        if ($i == 1) {
                                            $str = "Adult";
                                        }
                                        ?>
                                        <option <?php echo $sel; ?> value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                    <?php } ?>
                                </select>
                                <select name="children" class="span2">
                                    <?php for ($i = 0; $i <= 10; $i++) { ?>
                                        <?php
                                        $sel = "";
                                        if ($i == $childs) {
                                            $sel = "selected";
                                        }
                                        $str = "Children";
                                        if ($i == 1) {
                                            $str = "Child";
                                        }
                                        ?>
                                        <option <?php echo $sel; ?> value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                    <?php } ?>
                                </select>
                                <select name="currency" class="span2" style="width: 240px;">
                                    <?php
                                    $criteria1 = new CDbCriteria;
                                    $criteria1->order = 'id desc';
                                    $currencies = Currency::model()->findAll($criteria1);
                                    ?>
                                    <?php if ($currencies) { ?>
                                        <?php foreach ($currencies as $curr) { ?>
                                            <?php
                                            $str = "";
                                            if ($curr->iso_code == $user_currency) {
                                                $str = "selected";
                                            }
                                            ?>
                                            <option <?php echo $str; ?> value="<?php echo $curr->iso_code; ?>"><?php echo $curr->title . " (" . $curr->iso_code . ")"; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>

                            <button type="submit" id="find_hotel" class="searchSahdowfull span2 margin pull-right"><span class="srchptn">SEARCH</span></button>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>


                <?php if ($flights) { ?>
                    <div class="row-fluid">
                        <div class="span12 flight_res srchdiv" style="margin-top: 30px;">
                            <div class="row-fluid">
                                <div class="span12 color_div flightitem">
                                    <!--<a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => 'duration', 'order' => $order)); ?>" class="btn btn-site btn-large search_filter <?php echo $filter_key == 'duration' ? "selected_filter" : ""; ?>">Duration</a>
                                    <a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => 'depart', 'order' => $order)); ?>" class="btn btn-site btn-large search_filter <?php echo $filter_key == 'depart' ? "selected_filter" : ""; ?>">Departure Time</a>
                                    <a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => 'price', 'order' => $order)); ?>" class="btn btn-site btn-large search_filter <?php echo $filter_key == 'price' ? "selected_filter" : ""; ?>">Price</a>

                                    <a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => $filter, 'order' => 'asc')); ?>" class="btn btn-site btn-large search_order <?php echo $order == 'asc' ? "selected_filter" : ""; ?>">&#x25B2;</a>
                                    <a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => $filter, 'order' => 'desc')); ?>" class="btn btn-site btn-large search_order <?php echo $order == 'desc' ? "selected_filter" : ""; ?>">&#x25BC;</a>-->
                                    
                                    <span style="font-size: 25px;letter-spacing: normal;margin-right:10px;" class="words">Sort By: </span>
                                    <div class="btn-group">
                                        <a class="btn-info dropdown-toggle  btn-large" data-toggle="dropdown" href="#">
                                            <?
											    $cl='';
												if(isset($filter_key))
												{
													switch($filter_key)
													{
														case 'price':
															echo 'Price - '; 
															echo $order=='asc'?'low to high':'high to low';
															$cl="pr_".$order;
															break;
														case 'duration':
															echo 'Duration - '; 
															echo $order=='asc'?'Shortest first':'Highest first';
															$cl="dur_".$order;
															break;
														case 'depart':
															echo 'Departure Time - '; 
															echo $order=='asc'?'Earliest first':'Latest first';
															$cl="dep_".$order;
															break;
													}
												}
												else
												{
													echo "Price - low to high";
												}
                                            ?>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                        <!-- dropdown menu links -->
                                        	<li <?= $cl=="" || $cl=="pr_asc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => 'price', 'order' => 'asc')); ?>">Price - low to high</a></li>
                                            <li <?= $cl=="pr_desc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => 'price', 'order' => 'desc')); ?>">Price - high to low</a></li>
                                            <li <?= $cl=="dur_asc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => 'duration', 'order' => 'asc')); ?>">Duration - shortest first</a></li>
                                            <li <?= $cl=="dur_desc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => 'duration', 'order' => 'desc')); ?>">Duration - longest first</a></li>
                                            <li <?= $cl=="dep_asc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => 'depart', 'order' => 'asc')); ?>">Departure time - earliest first</a></li>
                                            <li <?= $cl=="dep_desc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => 'depart', 'order' => 'desc')); ?>">Departure time - latest first</a></li>
                                        </ul>
                                    </div>

                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="row-fluid">
                    <div class="span12 flight_res srchdiv" style="margin-top: 20px;">

                        <?php if ($flights) { ?>
                            <?php $x = 0; ?>
                            <?php foreach ($flights as $flight) { ?>
                                <?php if ($flight->outbound_segments) { ?>
                                    <div class="row-fluid">
                                        <div class="span12 color_div flightitem">
                                            <div class="page-header">
                                                <div class="row-fluid">
                                                    <div class="span4" style="width: 29%;">
                                                        <a target="_blank" href="<?php echo $flight->best_fare->deeplink; ?>" class="btn btn-site btn-large">Select</a>
                                                        <!--<a id="filghtbtn1" class="btn btn-site btn-large view_details" detail="#det_<?php echo $x; ?>" vis="no" depart="<?php echo $depart; ?>" return="<?php echo $return; ?>" fid="<?php echo $flights[$x]->id; ?>" ins_id="<?php echo $ins_id; ?>" summ="#summ_<?php echo $x; ?>">Flight Details</a>-->
                                                    </div>
                                                    <ul class="span4 ul_block top10px" style="width: 28%;margin-left: 0;">
                                                        <li>
                                                            <?php
                                                            $str = Helper::get_currency_symbol(round(str_replace(',', '', $flight->best_fare->price), 2), $currency);
                                                            ?>
                                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/si1.png" class="i"/>
                                                            <span class="head_txt site_color">Best Price Per Person :&nbsp;</span>
                                                            <span style="color: red;font-weight: bold;"><?php echo $str; ?></span>
                                                        </li>
                                                    </ul>
                                                    <ul class="span4 ul_block top10px" style="width: 19.5%;margin-left: 0;">
                                                        <li>
                                                            <img class="i" src="<?php echo Yii::app()->request->baseUrl; ?>/img/si4.png">
                                                            <span class="head_txt site_color">Number of stops : </span>
                                                            <span>&nbsp;&nbsp;&nbsp;<?php echo count($flight->outbound_segments) - 1; ?></span>
                                                        </li>
                                                    </ul>
                                                    <ul class="span4 ul_block top10px" style="width: 23.5%;margin-left: 0;">
                                                        <li>
                                                            <?php
                                                            $airlines = array();
                                                            foreach ($flight->outbound_segments as $obs) {
                                                                if (!in_array($obs->airline_name, $airlines)) {
                                                                    $airlines[] = $obs->airline_name;
                                                                }
                                                            }
                                                            $airline_name = $airlines[0];
                                                            if (count($airlines) > 1) {
                                                                $airline_name = "Multiple Airlines";
                                                            }

                                                            if ($flight->inbound_segments) {
                                                                $in_airlines = array();
                                                                foreach ($flight->inbound_segments as $ibs) {
                                                                    if (!in_array($ibs->airline_name, $in_airlines)) {
                                                                        $in_airlines[] = $ibs->airline_name;
                                                                    }
                                                                }
                                                                $in_airline_name = $in_airlines[0];
                                                                if (count($in_airlines) > 1) {
                                                                    $in_airline_name = "Multiple Airlines";
                                                                }
                                                            }
                                                            ?>
                                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/si4.png" class="i"/>
                                                            <span class="head_txt site_color" style="min-width: 65px;">Airline : </span>
                                                            <span><?php echo $airline_name; ?></span>
                                                        </li>
                                                    </ul>

                                                </div>

                                            </div>

                                            <div class="row-fluid" id="summ_<?php echo $x; ?>">   
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 20%;">From</th>
                                                            <th style="width: 20%;">Local Departure Time</th>
                                                            <th style="width: 10%;"></th>
                                                            <th style="width: 20%;">To</th>
                                                            <th style="width: 20%;">Local Arrival Time</th>
                                                            <th style="width: 10%;text-align: center;">Airline</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <?php
                                                            $from = IataCodes::model()->findByAttributes(array('iata_code' => $flight->outbound_segments[0]->departure_code, 'app_location_type' => 'Airport'));
                                                            $to = IataCodes::model()->findByAttributes(array('iata_code' => $flight->outbound_segments[count($flight->outbound_segments) - 1]->arrival_code, 'app_location_type' => 'Airport'));

                                                            $loc_d_time = Helper::flight_date($flight->outbound_segments[0]->departure_time);
                                                            $loc_a_time = Helper::flight_date($flight->outbound_segments[count($flight->outbound_segments) - 1]->arrival_time);
                                                            ?>
                                                            <td class="site_color"><?php echo $from->name; ?></td>
                                                            <td><?php echo $loc_d_time; ?></td>
                                                            <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/go.png"></td>
                                                            <td class="site_color"><?php echo $to->name; ?></td>
                                                            <td><?php echo $loc_a_time; ?></td>
                                                            <td style="text-align: center;">
                                                                <?php
                                                                if (count($airlines) > 1) {
                                                                    echo $airline_name;
                                                                } else {
                                                                    echo "<img src='http://www.mediawego.com/images/flights/airlines/120x40t/" . $flight->outbound_segments[0]->airline_code . ".gif'";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php if ($type == "roundTrip") { ?>
                                                            <?php if ($flight->inbound_segments)  ?>
                                                            <tr>
                                                                <?php
                                                                $from = IataCodes::model()->findByAttributes(array('iata_code' => $flight->inbound_segments[0]->departure_code, 'app_location_type' => 'Airport'));
                                                                $to = IataCodes::model()->findByAttributes(array('iata_code' => $flight->inbound_segments[count($flight->inbound_segments) - 1]->arrival_code, 'app_location_type' => 'Airport'));

                                                                $loc_d_time = Helper::flight_date($flight->inbound_segments[0]->departure_time);
                                                                $loc_a_time = Helper::flight_date($flight->inbound_segments[count($flight->inbound_segments) - 1]->arrival_time);
                                                                ?>
                                                                <td class="site_color"><?php echo $from->name; ?></td>
                                                                <td><?php echo $loc_d_time; ?></td>
                                                                <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/go.png"></td>
                                                                <td class="site_color"><?php echo $to->name; ?></td>
                                                                <td><?php echo $loc_a_time; ?></td>
                                                                <td style="text-align: center;">
                                                                    <?php
                                                                    if (count($in_airlines) > 1) {
                                                                        echo $in_airline_name;
                                                                    } else {
                                                                        echo "<img src='http://www.mediawego.com/images/flights/airlines/120x40t/" . $flight->inbound_segments[0]->airline_code . ".gif'";
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <a id="filghtbtn1" class="view_details pull-right" style="margin:30px;cursor: pointer;" detail="#det_<?php echo $x; ?>" vis="no" depart="<?php echo $depart; ?>" return="<?php echo $return; ?>" fid="<?php echo $flights[$x]->id; ?>" ins_id="<?php echo $ins_id; ?>" summ="#summ_<?php echo $x; ?>">Details +</a>
                                            </div>

                                            <div class="row-fluid togle" id="det_<?php echo $x; ?>" style="display: none;">   


                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#detailstab_<?php echo $x; ?>" data-toggle="tab">Details</a>
                                                    </li>
                                                    <li class="px3left_tap">
                                                        <a href="#farestab_<?php echo $x; ?>" data-toggle="tab">Fares</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content tab_bg">
                                                    <div class="tab-pane active" id="detailstab_<?php echo $x; ?>">


                                                        <?php if ($flight->outbound_segments) { ?>
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 20%;">From</th>
                                                                        <th style="width: 20%;">Local Departure Time</th>
                                                                        <th style="width: 10%;"></th>
                                                                        <th style="width: 20%;">To</th>
                                                                        <th style="width: 20%;">Local Arrival Time</th>
                                                                        <th style="width: 10%;text-align: center;">Airline</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($flight->outbound_segments as $lst) { ?>
                                                                        <?php
                                                                        $os_from = IataCodes::model()->findByAttributes(array('iata_code' => $lst->departure_code, 'app_location_type' => 'Airport'));
                                                                        $os_to = IataCodes::model()->findByAttributes(array('iata_code' => $lst->arrival_code, 'app_location_type' => 'Airport'));

                                                                        $os_loc_d_time = Helper::flight_date($lst->departure_time);
                                                                        $os_loc_a_time = Helper::flight_date($lst->arrival_time);
                                                                        ?>
                                                                        <tr>
                                                                            <td class="site_color"><?php echo $os_from->name; ?></td>
                                                                            <td><?php echo $os_loc_d_time; ?></td>
                                                                            <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/go.png"></td>
                                                                            <td class="site_color"><?php echo $os_to->name; ?></td>
                                                                            <td><?php echo $os_loc_a_time; ?></td>
                                                                            <td style="text-align: center;"><img src="http://www.mediawego.com/images/flights/airlines/120x40t/<?php echo $lst->airline_code; ?>.gif" /></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        <?php } ?>
                                                        <?php if ($flight->inbound_segments) { ?>
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 20%;">From</th>
                                                                        <th style="width: 20%;">Local Departure Time</th>
                                                                        <th style="width: 10%;"></th>
                                                                        <th style="width: 20%;">To</th>
                                                                        <th style="width: 20%;">Local Arrival Time</th>
                                                                        <th style="width: 10%;text-align: center;">Airline</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($flight->inbound_segments as $lst) { ?>
                                                                        <?php
                                                                        $is_from = IataCodes::model()->findByAttributes(array('iata_code' => $lst->departure_code, 'app_location_type' => 'Airport'));
                                                                        $is_to = IataCodes::model()->findByAttributes(array('iata_code' => $lst->arrival_code, 'app_location_type' => 'Airport'));

                                                                        $is_loc_d_time = Helper::flight_date($lst->departure_time);
                                                                        $is_loc_a_time = Helper::flight_date($lst->arrival_time);
                                                                        ?>
                                                                        <tr>
                                                                            <td class="site_color"><?php echo $is_from->name; ?></td>
                                                                            <td><?php echo $is_loc_d_time; ?></td>
                                                                            <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/go.png"></td>
                                                                            <td class="site_color"><?php echo $is_to->name; ?></td>
                                                                            <td><?php echo $is_loc_a_time; ?></td>
                                                                            <td style="text-align: center;"><img src="http://www.mediawego.com/images/flights/airlines/120x40t/<?php echo $lst->airline_code; ?>.gif" /></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        <?php } ?>


                                                    </div>

                                                    <div class="tab-pane" id="farestab_<?php echo $x; ?>" style="max-height: 300px;overflow-y: scroll;">

                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 30%;">Provider</th>
                                                                    <th style="width: 25%;">Price Per Person</th>
                                                                    <th style="width: 25%;">Total Price</th>
                                                                    <th style="width: 20%;text-align: center;">Book</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($flight->fares as $fr) { ?>
                                                                    <tr>
                                                                        <?php
                                                                        $str = Helper::get_currency_symbol(round(str_replace(',', '', $fr->price), 2), $currency);
                                                                        $str1 = Helper::get_currency_symbol(round(str_replace(',', '', $fr->price) * ($adults + $childs), 2), $currency);
                                                                        ?>
                                                                        <td style="width: 30%;" class="site_color"><?php echo $fr->provider_code; ?></td>
                                                                        <td style="width: 25%;"><?php echo $str; ?></td>
                                                                        <td style="width: 25%;"><?php echo $str1; ?></td>
                                                                        <td style="width: 20%;text-align: center;"><a target="_blank" href="<?php echo $fr->deeplink; ?>" class="btn btn-site btn-large">Book</a></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                                
                                                <a id="filghtbtn1" class="view_details pull-right" style="margin:30px;cursor: pointer;" detail="#det_<?php echo $x; ?>" vis="no" depart="<?php echo $depart; ?>" return="<?php echo $return; ?>" fid="<?php echo $flights[$x]->id; ?>" ins_id="<?php echo $ins_id; ?>" summ="#summ_<?php echo $x; ?>">Details -</a>

                                            </div>
                                        </div>
                                    </div>
                                    <?php $x++; ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="row-fluid">
                                <div class="span12 color_div flightitem">
                                    <h3 style="color: #3C9DBE; margin-left: 40px;margin-bottom: 60px;margin-top: 60px;font-size: 22px;">Unfortunately we were unable to find an exact match for your search requirements.<br />Please check that you selected an option from our drop-down lists for all search boxes (including a hotel location if searching for flights + hotel).</h3>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>


                <?php if ($total_pages) { ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="pagination pagination-centered">
                                <div class="pagination">
                                    <ul>
                                        <?php if ($page > 1) { ?>
                                            <li class=""><a href="<?php echo Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $user_currency, 'trip_id' => $trip_id, 'filter' => $filter_key, 'order' => $order, 'page' => ($page - 1))); ?>">Prev</a></li>
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
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
<!--=================================== end content -->
