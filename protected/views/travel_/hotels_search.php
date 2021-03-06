<?php
$this->pageTitle = Yii::app()->name . ' - Hotels Search';
?>

<script type='text/javascript' src='http://openx.wayfareinteractive.com/openx/www/delivery/spcjs.php?id=420&amp;zones=14410'></script>
<script type='text/javascript'>OA_show(14410);</script>

<?php
Yii::app()->clientScript->registerScript('find', '
    
    $("#hotel-search-form").submit(function(e){
        if($("#loc").val() == ""){
            $("#h_sk").addClass("sb_error");
            alert("Please enter a destination");
            return false;
        }else{
            if($("#h_rms").val() > $("#h_gst").val()){
                alert("Please ensure the number of rooms does not exceed the number of guests.");
                return false;
            }
        }
    });
    
    $("#cin").change(function(){
        $("#cout").val(chk_date($(this).val(),1));
        $("#cout").datepicker("option", "minDate", chk_date($(this).val(),1));
    });
    
    $("#cout").change(function(){
        var dateParts = $(this).val().split("/");
        var date_obj = new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
        
        var dateParts2 = $("#cin").val().split("/");
        var date_obj2 = new Date(dateParts2[2], (dateParts2[1] - 1), dateParts2[0]);
        
        if(date_obj2.getTime() >= date_obj.getTime()){
            $("#cout").val(chk_date($("#cin").val(),1));
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
<script> window.location = "<?=Yii::app()->createUrl('travel/hotel_results', array('search_id' => $_GET['search_id'], 'currency' => $_GET['currency']))?>"; </script>
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
                                    <span class="words" style="font-size: 25px;letter-spacing: normal;"><?php echo $hotel_location; ?></span>
                                </div>
                            </div>

                            <div class="row-fluid">
                                <div class="span12">
                                    <span class="site_color"><?php echo $from; ?></span>
                                    <i class="site_hint">to</i>
                                    <span class="site_color"><?php echo $to; ?></span>
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
                            'id' => 'hotel-search-form',
                            'action' => Yii::app()->request->baseUrl . "/travel/search_hotels",
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
                                            'class' => 'span2',
                                            'placeholder' => 'Destination ..',
                                            'style' => 'width:215px;',
                                            'id' => 'h_sk',
                                        ),
                                    ));
                                    ?>
                                    <input name="location_id" type="hidden" value="<?php echo $location_id; ?>" id="loc" />
                                    <input type="text" name="name" class="span2" placeholder="Hotel Name ( Optional )" value="<?php echo $name; ?>" style="width: 215px;" />
                                    <select name="rooms" id="h_rms" class="span2">
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
                                    <select name="guests" id="h_gst" class="span2">
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
                                <div class="input-append date">
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
                                            'class' => 'w110px',
                                            'style' => 'cursor:pointer;'
                                        ),
                                    ));
                                    ?>
                                    <span class="add-on cal_ico" cd="#cin" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                
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
                                            if ($curr->iso_code == $currency) {
                                                $str = "selected";
                                            }
                                            ?>
                                            <option <?php echo $str; ?> value="<?php echo $curr->iso_code; ?>"><?php echo $curr->title . " (" . $curr->iso_code . ")"; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                
                                </div>
                                <div class="input-append date ">
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
                                            'class' => 'w110px',
                                            'style' => 'cursor:pointer;'
                                        ),
                                    ));
                                    ?>
                                    <span class="add-on cal_ico" cd="#cout" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                </div>
                               
                            </div>
                            <button type="submit" id="find_hotel" class="searchSahdowfull span2 margin pull-right"><span class="srchptn">SEARCH</span></button>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>

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
                                            <?
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

                <div class="row-fluid">
                    <div class="span12 flight_res">

                        <?php if ($hotels) { ?>
                            <?php foreach ($hotels as $hotel) { ?>
                                <div class="row-fluid">
                                    <div class="span12 color_div">
                                        <div class="row-fluid">
                                            <div class="span3" style="width: 100px;height: 100px;">
                                                <img src="<?php echo $hotel->image; ?>" class="mid_img" style="height:100px;"/>
                                            </div>
                                            <div class="span9">
                                                <div class="page-header">
                                                    <h4 style="width:600px;float: left;" class="site_color"><?php echo $hotel->name; ?></h4>
                                                    <a target="_blank" style="float:right;margin-top: 0px !important;margin-left: 20px;" href="<?php echo Yii::app()->createUrl('travel/book/', array("search_id" => $search_id, 'hotel_id' => $hotel->id, 'room_id' => $hotel->summary_room_rates[0]->id)) ?>" class="btn btn-site btn-large pull-right top20px">View Deal</a>
                                                    <a target="_blank" style="float:right;margin-top: 0px !important;" href="<?php echo Yii::app()->createUrl('travel/hotel_details/', array("search_id" => $search_id, 'currency' => $currency, 'id' => $hotel->id, 'days' => $days, 'rooms' => $rooms)); ?>" class="btn btn-site btn-large pull-right top20px">Hotel Details</a>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="row-fluid">

                                                    <ul class="span6 ul_block">
                                                        <li>
                                                            <img src="<?= Yii::app()->request->baseUrl; ?>/img/si1.png" class="i"/>
                                                            <span class="head_txt site_color">Best Price : </span>
                                                            <span style="color: red;font-weight: bold;"><?php
                                                                if ($hotel->room_rate_min) {
                                                                    $str = Helper::get_currency_symbol(round(str_replace(',', '', $hotel->room_rate_min->price_str) * $days * $rooms, 2), $hotel->room_rate_min->currency_code);

                                                                    echo $str;
                                                                } else {
                                                                    echo "not available";
                                                                }
//                                                                
                                                                ?></span>
                                                        </li>

                                                        <li>
                                                            <img src="<?= Yii::app()->request->baseUrl; ?>/img/si2.png" class="i"/>
                                                            <span class="head_txt site_color">Rooms : </span>
                                                            <span><?php echo $hotel->rooms_count; ?> rooms</span>
                                                        </li>

                                                    </ul>

                                                    <ul class="span6 ul_block">
                                                        <li>
                                                            <img src="<?= Yii::app()->request->baseUrl; ?>/img/si4.png" class="i"/>
                                                            <span class="head_txt site_color">Reviews : </span>
                                                            <span><?php echo $hotel->total_reviews; ?> reviews</span>
                                                        </li>

                                                        <li>
                                                            <img src="<?= Yii::app()->request->baseUrl; ?>/img/si5.png" class="i"/>
                                                            <span class="head_txt site_color">Rating : </span>
                                                            <span><?php if ($hotel->stars) { ?>
                                                                    <?php for ($i = 0; $i < $hotel->stars; $i++) { ?>
                                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/si5.png"/>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <?php echo "no rating."; ?>
                                                                <?php } ?></span>
                                                        </li>

                                                        <li>
                                                            <img src="<?= Yii::app()->request->baseUrl; ?>/img/si6.png" class="i"/>
                                                            <span class="head_txt site_color">Location : </span>
                                                            <span><?php echo $hotel->address; ?></span>
                                                        </li>
                                                    </ul>

                                                    <div class="row-fluid">
                                                        <div class="span12">

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>  
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

                    </div>
                </div>

                <?php if ($total_pages) { ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="pagination pagination-centered">
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
</div>
<!--=================================== end content -->
