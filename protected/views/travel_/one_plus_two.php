<?php
$this->pageTitle = Yii::app()->name . ' - 1plus2';
?>




<?php
$sign = Helper::get_currency_symbol("", $user_currency);

Yii::app()->clientScript->registerScript('ot_sel', '

var flight = 0;
var hotel = 0;
var flight_link = "";
var hotel_link = "";
var curr = "' . $sign . '";
    
$("#tot_pr").html(curr + " 0");

$(".ot_f_sel").click(function(){
    var ths = $(this);
    $(".block_travel").removeClass("active");
    ths.parent(".block_travel").addClass("active");
    flight = ths.attr("pr");
    flight_link = ths.attr("blk");
    calc();
});

$(".ot_h_sel").click(function(){
    var ths = $(this);
    $(".block_hotel").removeClass("active");
    ths.parent(".block_hotel").addClass("active");
    hotel = ths.attr("pr");
    hotel_link = ths.attr("blk");
    calc();
});

$("#tot_pr").click(function(){
    if(flight != 0 && hotel != 0){
        window.open(flight_link);
        window.open(hotel_link);
    }
});

function calc(){
    if(flight != 0 && hotel != 0){
        $("#tot_pr").html(curr + " " + parseFloat(parseFloat(flight) + parseFloat(hotel)).toFixed(2));
    }
}


    $("#not_close").click(function(){
        $("#notf_temp").fadeOut(500);
    });
	$("#not_close2").click(function(){
        $("#notf_temp2").fadeOut(500);
    });
    
    $("#dep").change(function(){
        $("#ret12").val(chk_date($(this).val(),7));
        $("#ret12").datepicker("option", "minDate", chk_date($(this).val(),1));
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
<script> window.location = "<?=Yii::app()->createUrl('travel/one_plus_two', array('trip_id' => $_GET['trip_id'], 'flight_search_id' => $_GET['flight_search_id'], 'hotel_search_id' => $_GET['hotel_search_id'], 'currency' => $_GET['currency']))?>"; </script>
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
                                <div class="span12">
                                    <span class="words" style="font-size: 20px;letter-spacing: normal;"><?php echo $from_airport; ?></span>&nbsp;&nbsp;To&nbsp;&nbsp;<span class="words" style="font-size: 20px;"><?php echo $to_airport; ?></span>
                                </div>
                            </div>

                            <div class="row-fluid">
                                <div class="span12">
                                	<i class="site_hint">Departing </i>
                                    <span class="site_color"><?php echo $depart; ?></span>
                                    <i class="site_hint">and Returning </i>
                                    <span class="site_color"><?php echo $return; ?></span>
                                </div>
                            </div>
                            <button id="onetwobtn" class="searchSahdowfull span2 margin pull-right"><span class="srchptn">CHANGE</span></button>
                        </div>

                    </div>
                </div>



                <div class="row-fluid" id="onetwosrch">
                    <div class="span12 color_div top50px">
                        <?php
                        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'flight-search-form',
                            'action' => Yii::app()->request->baseUrl . "/travel/opt_search",
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
                                            'style' => 'width:215px;'
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
                                            'style' => 'width:215px;'
                                        ),
                                    ));
                                    ?>
                                    <input name="to" type="hidden" value="<?php echo $to; ?>" id="to_ap" />

                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'search_keyword',
                                        'value' => $search_keyword,
                                        'source' => Yii::app()->request->baseUrl . '/travel/location_search',
                                        'options' => array(
                                            'minLength' => '1', // min chars to start search
                                            'select' => 'js:function(event, ui) { $("#loc").val(ui.item.id); $("#nm").removeAttr("readonly"); }'
                                        ),
                                        'htmlOptions' => array(
                                            'class' => 'span2',
                                            'placeholder' => 'Destination ..',
                                            'style' => 'width:215px;'
                                        ),
                                    ));
                                    ?>
                                    <input name="location_id" type="hidden" value="<?php echo $location_id; ?>" id="loc" />



                                </div>

                                <div style="float: left;width:100%;margin-bottom:5px;">
                                    <input type="text" name="name" class="span2" placeholder="Hotel Name ( Optional )" value="<?php echo $name; ?>" style="width: 215px;" />
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
                                    <div class="input-append date" id="ret_date">
                                        <?php
                                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'name' => 'return',
                                            'value' => $return,
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
                                        if ($cabin == "Economy") {
                                            echo 'selected';
                                        }
                                        ?> value="Economy">Economy Class</option>
                                        <option <?php
                                        if ($cabin == "Business") {
                                            echo 'selected';
                                        }
                                        ?> value="Business">Business Class</option>
                                        <option <?php
                                        if ($cabin == "First") {
                                            echo 'selected';
                                        }
                                        ?> value="First">First Class</option>
                                    </select>
                                </div>


                                <select name="rooms" class="span2">
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

                <?php if ($flights && $hotels) { ?>
                    <div class="row-fluid" id="notf_temp">
                        <div class="span12 color_div" style="border: 1px solid #3C9DBE;color: #3C9DBE;line-height: 40px;padding: 0 10px;">
                            <span>Once you're happy with your flight and hotel selection simply click on the price displayed for more information and to book.</span>
                            <span id="not_close" style="float: right;margin-right: 10px;font-size: 22px;cursor: pointer;">X</span>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="container">



                        </div>


                        <div style="clear: both;"></div>

                        <div class="row-fluid">
                            <div class="span12 color_div plus" style="padding-bottom:0;">
                                <div class="row-fluid">

                                    <div class= "span4">
                                        <p class="TravelAndHotel"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/travel-icon.jpg"> &nbsp;Travel :</p>
                                        <div class=" flight_res srchdiv filt" style="">
                                            <div class="row-fluid">
                                                <div class="color_div flightitem">
    												<!--<a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => 'duration', 'f_order' => $f_order)); ?>" class="btn btn-site btn-large search_filter <?php echo $f_filter_key == 'duration' ? "selected_filter" : ""; ?>" style="font-size: 13px;">Duration</a>
                                                    <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => 'depart', 'f_order' => $f_order)); ?>" class="btn btn-site btn-large search_filter <?php echo $f_filter_key == 'depart' ? "selected_filter" : ""; ?>" style="font-size: 13px;">Depart</a>
                                                    <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => 'price', 'f_order' => $f_order)); ?>" class="btn btn-site btn-large search_filter <?php echo $f_filter_key == 'price' ? "selected_filter" : ""; ?>" style="font-size: 13px;">Price</a>-->

                                                    <label style="display: inline;">Sort By:</label>
                                                    <!--<select id="flight_filter" style="width: 110px;">
                                                        <option <?php echo $f_filter_key == "price" ? "selected" : ""; ?> value="price">Price</option>
                                                        <option <?php echo $f_filter_key == "depart" ? "selected" : ""; ?> value="depart">Departure Time</option>
                                                        <option <?php echo $f_filter_key == "duration" ? "selected" : ""; ?> value="duration">Duration</option>
                                                    </select>

                                                    <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => $f_filter, 'f_order' => 'asc')); ?>" class="btn btn-site btn-large search_order2 <?php echo $f_order == 'asc' ? "selected_filter" : ""; ?>" style="font-size: 13px;">&#x25B2;</a>
                                                    <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => $f_filter, 'f_order' => 'desc')); ?>" class="btn btn-site btn-large search_order2 <?php echo $f_order == 'desc' ? "selected_filter" : ""; ?>" style="font-size: 13px;">&#x25BC;</a>-->
                                                    <div class="btn-group">
                                                        <a class="btn-info dropdown-toggle btn" data-toggle="dropdown" href="#">
                                                            <?
                                                                $cl='';
                                                                if(isset($f_filter_key))
                                                                {
                                                                    switch($f_filter_key)
                                                                    {
                                                                        case 'price':
                                                                            echo 'Price - '; 
                                                                            echo $f_order=='asc'?'low to high':'high to low';
                                                                            $cl="pr_".$f_order;
                                                                            break;
                                                                        case 'duration':
                                                                            echo 'Duration - '; 
                                                                            echo $f_order=='asc'?'Shortest first':'Highest first';
                                                                            $cl="dur_".$f_order;
                                                                            break;
                                                                        case 'depart':
                                                                            echo 'Departure Time - '; 
                                                                            echo $f_order=='asc'?'Earliest first':'Latest first';
                                                                            $cl="dep_".$f_order;
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
                                                            <li <?= $cl=="" || $cl=="pr_asc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => 'price', 'f_order' => 'asc')); ?>">Price - low to high</a></li>
                                                            <li <?= $cl=="pr_desc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => 'price', 'f_order' => 'desc')); ?>">Price - high to low</a></li>
                                                            <li <?= $cl=="dur_asc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => 'duration', 'f_order' => 'asc')); ?>">Duration - shortest first</a></li>
                                                            <li <?= $cl=="dur_desc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => 'duration', 'f_order' => 'desc')); ?>">Duration - longest first</a></li>
                                                            <li <?= $cl=="dep_asc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => 'depart', 'f_order' => 'asc')); ?>">Departure time - earliest first</a></li>
                                                            <li <?= $cl=="dep_desc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => $h_order, 'f_filter' => 'depart', 'f_order' => 'desc')); ?>">Departure time - latest first</a></li>
                                                        </ul>
                                                    </div>

                                                    <div style="clear: both;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12 hotelAndTravelWords" style="overflow-y: scroll;overflow-x: hidden;">
                                                <?php if ($flights) { ?>
                                                    <?php $y = 0; ?>
                                                    <?php foreach ($flights as $fl) { ?>
                                                        <div class="block_travel " style="float: none;height: 160px;">
                                                            <span class="txt1" style="height: 25px;line-height: 25px;width: auto;margin-right: 5px;">

                                                                <span class="site_hint">Number of Stops : <?php echo count($fl->outbound_segments) - 1; ?></span>
                                                            </span>
                                                            <?php
                                                            $str = Helper::get_currency_symbol(round(str_replace(',', '', $fl->best_fare->price) * ($adults + $childs), 2), $currency);
                                                            ?>
                                                            <span class="site_color" style="position: relative;top: 0;height: 25px;line-height: 25px;"><b><?php echo $str; ?></b></span>
                                                            <?php
                                                            $loc_d_time = Helper::flight_date($fl->outbound_segments[0]->departure_time);
                                                            $loc_a_time = Helper::flight_date($fl->outbound_segments[count($fl->outbound_segments) - 1]->arrival_time);
                                                            $loc_rd_time = Helper::flight_date($fl->inbound_segments[0]->departure_time);
                                                            $loc_ra_time = Helper::flight_date($fl->inbound_segments[count($fl->inbound_segments) - 1]->arrival_time);
                                                            ?>
                                                            <div style="margin-left: 10px;">Departs : <span style="color: red;"><?php echo $loc_d_time; ?></span></div>
                                                            <div style="margin-left: 10px;">Arrives : <span style="color: red;"><?php echo $loc_a_time; ?></span></div>
                                                            <div style="margin-left: 10px;">The return flight :</div>
                                                            <div style="margin-left: 10px;">Departs : <span style="color: red;"><?php echo $loc_rd_time; ?></span></div>
                                                            <div style="margin-left: 10px;">Arrives : <span style="color: red;"><?php echo $loc_ra_time; ?></span></div>
                                                            <?php
                                                            $airlines = array();
                                                            foreach ($fl->outbound_segments as $obs) {
                                                                if (!in_array($obs->airline_name, $airlines)) {
                                                                    $airlines[] = $obs->airline_name;
                                                                }
                                                            }
                                                            $airline_name = $airlines[0];
                                                            if (count($airlines) > 1) {
                                                                $airline_name = "Multiple Airlines";
                                                            }
                                                            ?>
                                                            <div style="margin-left: 10px;">Airline : <span style="color: red;"><?php echo $airline_name; ?></span></div>
                                                            <!--<button class="btn btn-site" role="button" data-toggle="modal" href="#flight_info_<?php echo $y; ?>" style="right: 5px;bottom: 60px;width: 67px;">Info</button>-->
                                                            <a class="btn btn-site" href="<?php echo $fl->best_fare->deeplink; ?>" target="_blank" style="right: 5px;bottom: 60px;width: 37px;">Info</a>
                                                            <button class="btn btn-site ot_f_sel" style="right: 5px;width: 67px;" blk="<?php echo $fl->best_fare->deeplink; ?>" pr="<?php echo ($fl->best_fare->price * ($adults + $childs)); ?>" >Select</button>

                                                        </div>
                                                        <?php $y++; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span1 PlusandEqualbuttons">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/plus.png">
                                    </div>

                                    <div class="span4">
                                        <p class="TravelAndHotel"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hotel.jpg"> &nbsp;Hotel :</p>
                                        <div class=" flight_res srchdiv filt" style="">
                                            <div class="row-fluid">
                                                <div class="color_div flightitem">
    <!--                                                    <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => 'stars', 'h_order' => $h_order, 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>" class="btn btn-site btn-large search_filter <?php echo $h_filter_key == 'stars' ? "selected_filter" : ""; ?>" style="font-size: 13px;">Stars</a>
                                                    <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => 'name', 'h_order' => $h_order, 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>" class="btn btn-site btn-large search_filter <?php echo $h_filter_key == 'name' ? "selected_filter" : ""; ?>" style="font-size: 13px;">Name</a>
                                                    <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => 'price', 'h_order' => $h_order, 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>" class="btn btn-site btn-large search_filter <?php echo $h_filter_key == 'price' ? "selected_filter" : ""; ?>" style="font-size: 13px;">Price</a>
                                                    <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => 'popularity', 'h_order' => $h_order, 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>" class="btn btn-site btn-large search_filter <?php echo $h_filter_key == 'popularity' ? "selected_filter" : ""; ?>" style="font-size: 13px;">Popularity</a>-->

                                                    <label style="display: inline;">Sort By:</label>
                                                    <!--<select id="hotel_filter" style="width: 110px;">
                                                        <option <?php echo $h_filter_key == "popularity" ? "selected" : ""; ?> value="popularity">Popularity</option>
                                                        <option <?php echo $h_filter_key == "price" ? "selected" : ""; ?> value="price">Price</option>
                                                        <option <?php echo $h_filter_key == "name" ? "selected" : ""; ?> value="name">Name</option>
                                                        <option <?php echo $h_filter_key == "stars" ? "selected" : ""; ?> value="stars">Stars</option>
                                                    </select>

                                                    <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => 'asc', 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>" class="btn btn-site btn-large search_order2 <?php echo $h_order == 'asc' ? "selected_filter" : ""; ?>" style="font-size: 13px;">&#x25B2;</a>
                                                    <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => $h_filter, 'h_order' => 'desc', 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>" class="btn btn-site btn-large search_order2 <?php echo $h_order == 'desc' ? "selected_filter" : ""; ?>" style="font-size: 13px;">&#x25BC;</a>-->
                                                    
                                                    <div class="btn-group">
                                                        <a class="btn-info dropdown-toggle  btn" data-toggle="dropdown" href="#">
                                                            <?
                                                                $cla='';
                                                                if(isset($h_filter_key))
                                                                {
                                                                    switch($h_filter_key)
                                                                    {
                                                                        case 'stars':
                                                                            echo 'Rating - ';
                                                                            echo $h_order=='asc'?'low to high':'high to low';
                                                                            $cla="st_".$h_order;
                                                                            break;
                                                                        case 'price':
                                                                            echo 'Price - '; 
                                                                            echo $h_order=='asc'?'low to high':'high to low';
                                                                            $cla="pr_".$h_order;
                                                                            break;
                                                                        case 'popularity':
                                                                            echo "Popularity";
                                                                            $cla='';
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
                                                            <li <?= $cla==""? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => 'popularity', 'h_order' => 'asc', 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>">Popularity</a></li>
                                                            <li <?= $cla=="pr_asc"? "style='display:none;'":""?>> <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => 'price', 'h_order' => 'asc', 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>">Price - low to high</a></li>
                                                            <li <?= $cla=="pr_desc"? "style='display:none;'":""?>> <a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => 'price', 'h_order' => 'desc', 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>">Price - high to low</a></li>
                                                            <li <?= $cla=="st_asc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => 'stars', 'h_order' => 'asc', 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>">Rating - low to high</a></li>
                                                            <li <?= $cla=="st_desc"? "style='display:none;'":""?>><a href="<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_filter' => 'stars', 'h_order' => 'desc', 'f_filter' => $f_filter, 'f_order' => $f_order)); ?>">Rating - high to low</a></li>
                                                        </ul>
                                                    </div>

                                                    <div style="clear: both;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12 hotelAndTravelWords" style="overflow-y: scroll;overflow-x: hidden;">
                                                <?php if ($hotels) { ?>
                                                    <?php foreach ($hotels as $ht) { ?>
                                                        <div class="block_hotel">
                                                            <img src="<?php echo $ht->image; ?>" class="hotel_img">
                                                            <span class="txt1">
                                                                <ul class="ul_block site_hint" style="width: 170px;">
                                                                    <li><b><a href="<?php echo Yii::app()->createUrl('travel/hotel_details/', array("search_id" => $hotel_search_id, 'currency' => $user_currency, 'id' => $ht->id, 'days' => $days, 'rooms' => $rooms)); ?>" target="_blank"><?php echo $ht->name; ?></a></b></li>
                                                                    <li><?php echo $ht->address; ?></li>
                                                                    <li>
                                                                        <?php
                                                                        if ($ht->stars) {
                                                                            echo $ht->stars . " stars";
                                                                        } else {
                                                                            echo "no rating.";
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                </ul>
                                                            </span>
                                                            <span class="site_color"><?php
                                                                $str = Helper::get_currency_symbol(round(str_replace(',', '', $ht->room_rate_min->price_str) * $days * $rooms, 2), $ht->room_rate_min->currency_code);

                                                                $best = 0;
                                                                if ($ht->room_rate_min) {
                                                                    echo $str;
                                                                    $best = round(str_replace(',', '', $ht->room_rate_min->price_str) * $days * $rooms, 2);
                                                                } else {
                                                                    echo "not available";
                                                                    $best = 0;
                                                                }
                                                                ?></span>
                                                            <button class="btn btn-site ot_h_sel" blk="<?php echo Yii::app()->createUrl('travel/book/', array("search_id" => $hotel_search_id, 'hotel_id' => $ht->id, 'room_id' => $ht->room_rate_min->id)) ?>" pr="<?php echo $best; ?>">Select</button>>
                                                            <a class="btn btn-site" href="<?php echo Yii::app()->createUrl('travel/hotel_details/', array("search_id" => $hotel_search_id, 'currency' => $user_currency, 'id' => $ht->id, 'days' => $days, 'rooms' => $rooms)); ?>" target="_blank" style="bottom: 60px;width: 37px;">Info</a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="span1 PlusandEqualbuttons">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/equal.jpg">
                                    </div>

                                    <div class="totalPrice span2">
                                        <button class="PriceButton" id="tot_pr">0</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row-fluid">
                            <div class="span12 color_div flightitem">
                                <h3 style="color: #3C9DBE; margin-left: 40px;margin-bottom: 60px;margin-top: 60px;font-size: 22px;">Unfortunately we were unable to find an exact match for your search requirements.<br />Please check that you selected an option from our drop-down lists for all search boxes (including a hotel location if searching for flights + hotel).</h3>
                            </div>
                        </div>
                    <?php } ?>


                </div>
                	
                    <div class="row-fluid" id="notf_temp2">
                        <div class="span12 color_div" style="border: 1px solid #3C9DBE;color: #3C9DBE;line-height: 40px;padding: 0 10px;">
                            <span>Scroll down through your flight and hotel results to see more
fabulous prices, or use our filter options to create your perfect trip.
</span>
                            <span id="not_close2" style="float: right;margin-right: 10px;font-size: 22px;cursor: pointer;">X</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!--=================================== end content -->


    <?php if ($flights) { ?>
        <?php $z = 0; ?>
        <?php foreach ($flights as $flight) { ?>
            <div id="flight_info_<?php echo $z; ?>" class="modal hide fade flight-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 id="myModalLabel">Flight Info</h3>
                </div>
                <div class="modal-body share-div">
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
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
            </div>
            <?php $z++; ?>
        <?php } ?>
    <?php } ?>

    <script>
        $("document").ready(function() {
            var flight_filter = "<?php echo $f_filter; ?>";
            var hotel_filter = "<?php echo $h_filter; ?>";
            var url = "<?php echo Yii::app()->createUrl('travel/one_plus_two', array('flight_search_id' => $flight_search_id, 'hotel_search_id' => $hotel_search_id, 'trip_id' => $trip_id, 'currency' => $currency, 'h_order' => $h_order, 'f_order' => $f_order)); ?>";

            $("#flight_filter").change(function() {
                var x = $(this).val();
                if (x != flight_filter) {
                    window.location = url + "&h_filter=" + hotel_filter + "&f_filter=" + x;
                }
            });

            $("#hotel_filter").change(function() {
                var x = $(this).val();
                if (x != hotel_filter) {
                    window.location = url + "&h_filter=" + x + "&f_filter=" + flight_filter;
                }
            });
        });
    </script>
