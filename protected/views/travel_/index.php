<?php
$this->pageTitle = Yii::app()->name . ' - Home';
?>



<?php
Yii::app()->clientScript->registerScript('find', '

    $("#hotel-search-form").submit(function(e){
        if($("#loc").val() == ""){
            $("#h_sk").addClass("sb_error");
            alert("Please enter your destination slowly and select an option from the drop down list");
            return false;
        }else{
            if($("#h_rms").val() > $("#h_gst").val()){
                alert("Please ensure the number of rooms does not exceed the number of guests.");
                return false;
            }
        }
    });
    
    $("#h_sk").on("input", function() {
        if($(this).val().trim() != ""){
            $("#h_load").show();
        } else {
            $("#h_load").hide();
        }
    });
    
    $("#flight-search-form").submit(function(e){
        if($("#from_ap").val() == "" || $("#to_ap").val() == ""){
            if($("#from_ap").val() == ""){
                $("#fa_sk").addClass("sb_error");
            }
            if($("#to_ap").val() == ""){
                $("#ta_sk").addClass("sb_error");
            }
            alert("Please enter your origin and destination slowly and select an option from the drop down list");
            return false;
        }
    });
    
    $("#fa_sk").on("input", function() {
        if($(this).val().trim() != ""){
            $("#fo_load").show();
        } else {
            $("#fo_load").hide();
        }
    });
    
    $("#ta_sk").on("input", function() {
        if($(this).val().trim() != ""){
            $("#fd_load").show();
        } else {
            $("#fd_load").hide();
        }
    });
    
    $("#all-search-form").submit(function(e){
        if($("#all_from_ap").val() == "" || $("#all_to_ap").val() == "" || $("#all_loc").val() == ""){
            if($("#all_from_ap").val() == ""){
                $("#afa_sk").addClass("sb_error");
            }
            if($("#all_to_ap").val() == ""){
                $("#ata_sk").addClass("sb_error");
            }
            if($("#all_loc").val() == ""){
                $("#ah_sk").addClass("sb_error");
            }
            alert("Please enter your flight origin, destination and hotel location and select an option from the drop down list in order to proceed");
            return false;
        }else{
            if($("#al_rms").val() > (parseInt($("#al_gst").val()) + parseInt($("#al_chl").val()))){
                alert("Please ensure the number of rooms does not exceed the number of guests.");
                return false;
            }
        }
    });
    
    $("#afa_sk").on("input", function() {
        if($(this).val().trim() != ""){
            $("#afo_load").show();
        } else {
            $("#afo_load").hide();
        }
    });
    
    $("#ata_sk").on("input", function() {
        if($(this).val().trim() != ""){
            $("#afd_load").show();
        } else {
            $("#afd_load").hide();
        }
    });
    
    $("#ah_sk").on("input", function() {
        if($(this).val().trim() != ""){
            $("#ah_load").show();
        } else {
            $("#ah_load").hide();
        }
    });
    
    $("input[type=radio][name=type]").change(function(){
        if($(this).val() == "oneWay"){
            $("#ret_date").hide();
        }else{
            $("#ret_date").show();
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
    
    $("#dep22").change(function(){
        $("#ret122").val(chk_date($(this).val(),7));
        $("#ret122").datepicker("option", "minDate", chk_date($(this).val(),1));
    });
    
    $("#ret122").change(function(){
        var dateParts = $(this).val().split("/");
        var date_obj = new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
        
        var dateParts2 = $("#dep22").val().split("/");
        var date_obj2 = new Date(dateParts2[2], (dateParts2[1] - 1), dateParts2[0]);
        
        if(date_obj2.getTime() >= date_obj.getTime()){
            $("#ret122").val(chk_date($("#dep22").val(),7));
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

<!-- content
        ================================================== --> 
<div class="row-fluid">
    <div class="container">
        <div class="row-fluid">

            <!-- taps
            ================================================== --> 
           
            	
            <div class="row-fluid top20px">

				
                <div class="row-fluid">
                
                	
                
                    <div class="span12">
                        <ul class="nav nav-tabs pull-left">
                            <li class="active">
                                <a href="#tab1" data-toggle="tab"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/tap1.png" />Hotels</a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/tap2.png" />Flights</a>
                            </li>
                            <li>
                                <a href="#tab3" data-toggle="tab"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/tap4.png" />Flights + Hotel</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row-fluid color_div2">  

                    <div class="span7">
                        <div class="slider">
                            <div id="myCarousel" class="carousel slide" >
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <?php if ($banners) { ?>
                                        <?php $x = 0; ?>
                                        <?php foreach ($banners as $banner) { ?>
                                            <?php
                                            $sel = "";
                                            if ($x == 0) {
                                                $sel = "active";
                                            }
                                            ?>
                                            <div class="<?php echo $sel; ?> item">
                                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/banner/thumbs/<?php echo $banner->image; ?>"/>
                                                <div class="carousel-caption">
                                                    <p><?php echo $banner->details; ?></p>
                                                </div>
                                            </div>
                                            <?php $x++; ?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>    
                            </div>
                        </div>
                    </div>
                    <div class="span5 tab-content">

                        <div class="tab-pane active" id="tab1">
                            <p class="s-title" style="text-align: center;font-weight: bold;width:100%; float:left;">Search Thousands of Hotels from Hundreds of Travel Companies</p>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                'id' => 'hotel-search-form',
                                'action' => Yii::app()->request->baseUrl . "/travel/search_hotels",
                                'method' => 'get',
                                'enableAjaxValidation' => false,
                                'htmlOptions' => array(
                                    'class' => 'form-normal top10px',
                                ),
                            ));
                            ?>

                            <div class="control-group" style="margin-bottom: 9px;float:left">
                                <!--<label class="control-label">Destination:</label>-->
                                <div class="controls" style="position:relative;">
                                    <i class="fa-li fa fa-spinner fa-spin" id="h_load" style="position:absolute;left:320px;top:7px;display: none;"></i>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'search_keyword',
                                        'value' => '',
                                        //'source' => Yii::app()->request->baseUrl . '/home/location_search',
                                        'source' => 'js: function(request, response) {
                                            $.ajax({
                                                url: "' . Yii::app()->request->baseUrl . '/travel/location_search",
                                                dataType: "json",
                                                data: {
                                                    term: request.term,
                                                },
                                                success: function (data) {
                                                    $("#h_load").hide();
                                                    response(data);
                                                }
                                            })
                                        }',
                                        'options' => array(
                                            'minLength' => '1', // min chars to start search
                                            'select' => 'js:function(event, ui) { 
                                                            $("#loc").val(ui.item.id);
                                                            $("#h_sk").removeClass("sb_error");
                                                        }'
                                        ),
                                        'htmlOptions' => array(
                                            //'placeholder' => 'Destination...',
                                            'placeholder' => 'Where would you like to stay?',
                                            'style' => 'width:333px;',
                                            'id' => 'h_sk'
                                        ),
                                    ));
                                    ?>
                                    <input name="location_id" type="hidden" value="" id="loc" />
                                </div>
                            </div>   
                            <div class="clearfix"></div>
                            <div class="control-group" style="margin-bottom: 9px;">
                                <!--<label class="control-label">Hotel Name:</label>-->
                                <div class="controls">

                                    <input type="text" name="name" class="large_input" placeholder="Name of your preferred hotel (optional)" style="width:333px;" />
                                    <!--<span class="smalltxt site_hint">( Optional )</span>-->
                                </div>
                            </div>

                            <div class="control-group" style="margin-bottom: 9px;">
                                <label class="control-label" style="line-height: 30px;">Check-in:</label>
                                <div class="controls">
                                    <div class="input-append date ">
                                        <?php
                                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'name' => 'check_in',
                                            'value' => date('d/m/Y'),
                                            'options' => array(
                                                'showAnim' => 'fold',
                                                'dateFormat' => 'dd/mm/yy',
                                                'minDate' => date('d/m/Y'),
                                            ),
                                            'htmlOptions' => array(
                                                'size' => '16',
                                                'readonly' => true,
                                                'id' => 'cin',
                                                'style' => 'cursor:pointer;'
                                            ),
                                        ));
                                        ?>
                                        <span class="add-on cal_ico" cd="#cin" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                    </div> 
                                </div>
                            </div>

                            <div class="control-group" style="margin-bottom: 9px;">
                                <label class="control-label" style="line-height: 30px;">Check-out:</label>
                                <div class="controls">
                                    <div class="input-append date ">
                                        <?php
                                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'name' => 'check_out',
                                            'value' => date('d/m/Y', time() + (60 * 60 * 24)),
                                            'options' => array(
                                                'showAnim' => 'fold',
                                                'dateFormat' => 'dd/mm/yy',
                                                'minDate' => date('d/m/Y', time() + (60 * 60 * 24)),
                                            ),
                                            'htmlOptions' => array(
                                                'size' => '16',
                                                'readonly' => true,
                                                'id' => 'cout',
                                                'style' => 'cursor:pointer;'
                                            ),
                                        ));
                                        ?>
                                        <span class="add-on cal_ico" cd="#cout" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                    </div>
                                </div>
                            </div> 

                            <div class="control-group" style="margin-bottom: 9px;">
                                <!--<label class="control-label">Rooms:</label>-->
                                <div class="controls">
                                    <select name="rooms" class="large_select" id="h_rms" style="width: 347px;">
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <?php
                                            $str = "Rooms";
                                            if ($i == 1) {
                                                $str = "Room";
                                            }
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group" style="margin-bottom: 9px;">
                                <!--<label class="control-label">Guests:</label>-->
                                <div class="controls">
                                    <select name="guests" class="medium_select" id="h_gst" style="width: 347px;">
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <?php
                                            $str = "Guests";
                                            if ($i == 1) {
                                                $str = "Guest";
                                            }
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group" style="margin-bottom: 9px;">
                                <label class="control-label" style="line-height: 26px;">Currency:</label>
                                <div class="controls">
                                    <select name="currency" class="medium_select" style="width: 247px">
                                        <?php if ($currencies) { ?>
                                            <?php foreach ($currencies as $curr) { ?>
                                                <?php
                                                $str = "";
                                                if ($curr->default == 1) {
                                                    $str = "selected";
                                                }
                                                ?>
                                                <option <?php echo $str; ?> value="<?php echo $curr->iso_code; ?>"><?php echo $curr->title . " (" . $curr->iso_code . ")"; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <script type='text/javascript' src='http://openx.wayfareinteractive.com/openx/www/delivery/spcjs.php?id=420&amp;zones=14732'></script>
                            <script type='text/javascript'>OA_show('14732');</script>

                            <div class="control-group">
                                <button class="btn btn-site btn-large pull-right txtbold" id="find_hotel" style="border-radius: 5px;" type="submit">Search</button>
                            </div>

                            <?php $this->endWidget(); ?>
                        </div>

                        <div class="tab-pane" id="tab2">
                            <p class="s-title" style="text-align: center;font-weight: bold;">Compare Flight Prices from Hundreds of Travel Companies</p>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                'id' => 'flight-search-form',
                                'action' => Yii::app()->request->baseUrl . "/travel/search_flights",
                                'method' => 'get',
                                'enableAjaxValidation' => false,
                                'htmlOptions' => array(
                                    'class' => 'form-vertical form-normal top10px',
                                ),
                            ));
                            ?>

                            <div class="control-group">
                                <label class="control-label" style="line-height: 30px;margin-right: 20px;width: auto;"><input style="margin-top: 0;" type="radio" name="type" value="oneWay" />&nbsp;One Way</label>
                                <label class="control-label" style="line-height: 30px;width: auto;"><input style="margin-top: 0;" type="radio" name="type" checked="" value="roundTrip" />&nbsp;Round Trip</label>
                                <div style="clear: both;"></div>
                            </div>

                            <div class="control-group" style="margin-bottom: 9px;float:left">
                                <!--<label class="control-label" style="line-height: 30px;">Flying From:</label>-->
                                <div class="controls">
                                    <i class="fa-li fa fa-spinner fa-spin" id="fo_load" style="position:absolute;left:320px;top:7px;display: none;"></i>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'from_airport',
                                        'value' => '',
//                                        'source' => Yii::app()->request->baseUrl . '/home/iata_search',
                                        'source' => 'js: function(request, response) {
                                            $.ajax({
                                                url: "' . Yii::app()->request->baseUrl . '/travel/iata_search",
                                                dataType: "json",
                                                data: {
                                                    term: request.term,
                                                },
                                                success: function (data) {
                                                    $("#fo_load").hide();
                                                    response(data);
                                                }
                                            })
                                        }',
                                        'options' => array(
                                            'minLength' => '1', // min chars to start search
                                            'select' => 'js:function(event, ui) { 
                                                            $("#from_ap").val(ui.item.id);
                                                            $("#fa_sk").removeClass("sb_error");
                                                        }'
                                        ),
                                        'htmlOptions' => array(
                                            'class' => 'large_input',
                                            //'placeholder' => 'Flying From...',
                                            'placeholder' => 'Where would you like to fly from?',
                                            'style' => 'width:333px;',
                                            'id' => 'fa_sk'
                                        ),
                                    ));
                                    ?>
                                    <input name="from" type="hidden" value="" id="from_ap" />
                                </div>
                            </div>


                            <div class="control-group" style="margin-bottom: 9px;float:left">
                                <!--<label class="control-label" style="line-height: 30px;">Going To:</label>-->
                                <div class="controls">
                                    <i class="fa-li fa fa-spinner fa-spin" id="fd_load" style="position:absolute;left:320px;top:7px;display: none;"></i>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'to_airport',
                                        'value' => '',
//                                        'source' => Yii::app()->request->baseUrl . '/home/iata_search',
                                        'source' => 'js: function(request, response) {
                                            $.ajax({
                                                url: "' . Yii::app()->request->baseUrl . '/travel/iata_search",
                                                dataType: "json",
                                                data: {
                                                    term: request.term,
                                                },
                                                success: function (data) {
                                                    $("#fd_load").hide();
                                                    response(data);
                                                }
                                            })
                                        }',
                                        'options' => array(
                                            'minLength' => '1', // min chars to start search
                                            'select' => 'js:function(event, ui) { 
                                                            $("#to_ap").val(ui.item.id);
                                                            $("#ta_sk").removeClass("sb_error");
                                                        }'
                                        ),
                                        'htmlOptions' => array(
                                            'class' => 'large_input',
                                            //'placeholder' => 'Going To...',
                                            'placeholder' => 'Where are you flying to?',
                                            'style' => 'width:333px;',
                                            'id' => 'ta_sk'
                                        ),
                                    ));
                                    ?>
                                    <input name="to" type="hidden" value="" id="to_ap" />
                                </div>
                            </div> 
                            <div class="clearfix"></div>
                            <div class="control-group" style="margin-bottom: 9px;">
                                <label class="control-label" style="line-height: 30px;">Departing:</label>
                                <div class="controls">
                                    <div class="input-append date ">
                                        <?php
                                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'name' => 'depart',
                                            'value' => date('d/m/Y'),
                                            'options' => array(
                                                'showAnim' => 'fold',
                                                'dateFormat' => 'dd/mm/yy',
                                                'minDate' => date('d/m/Y'),
                                            ),
                                            'htmlOptions' => array(
                                                'size' => '16',
                                                'readonly' => true,
                                                'id' => 'dep',
                                                'style' => 'cursor:pointer;'
                                            ),
                                        ));
                                        ?>
                                        <span class="add-on cal_ico" cd="#dep" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                    </div> 
                                </div>
                            </div>  

                            <div class="control-group" id="ret_date" style="margin-bottom: 9px;">
                                <label class="control-label" style="line-height: 30px;">Returning:</label>
                                <div class="controls">
                                    <div class="input-append date ">
                                        <?php
                                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'name' => 'return',
                                            'value' => date('d/m/Y', time() + (60 * 60 * 24 * 7)),
                                            'options' => array(
                                                'showAnim' => 'fold',
                                                'dateFormat' => 'dd/mm/yy',
                                                'minDate' => date('d/m/Y'),
                                            ),
                                            'htmlOptions' => array(
                                                'size' => '16',
                                                'readonly' => true,
                                                'id' => 'ret12',
                                                'style' => 'cursor:pointer;'
                                            ),
                                        ));
                                        ?>
                                        <span class="add-on cal_ico" cd="#ret12" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                    </div>
                                </div>
                            </div> 

                            <div class="control-group" style="margin-bottom: 9px;">
                                <!--<label class="control-label">Cabin:</label>-->
                                <div class="controls">
                                    <select name="class" class="large_select" style="width: 347px;">
                                        <option value="economy">Economy Class</option>
                                        <option value="business">Business Class</option>
                                        <option value="first">First Class</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group" style="margin-bottom: 9px;">
                                <!--<label class="control-label">Adults:</label>-->
                                <div class="controls">
                                    <select name="adults" class="medium_select" style="width: 172px;">
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <?php
                                            $str = "Adults";
                                            if ($i == 1) {
                                                $str = "Adult";
                                            }
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                        <?php } ?>
                                    </select>
                                    <select name="children" class="medium_select" style="width: 171px;">
                                        <?php for ($i = 0; $i <= 10; $i++) { ?>
                                            <?php
                                            $str = "Children";
                                            if ($i == 1) {
                                                $str = "Child";
                                            }
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                        <?php } ?>
                                    </select>
                                    <!--<span class="smalltxt site_hint">( 12+ )</span>-->
                                </div>
                            </div>

                            <div class="control-group" style="margin-bottom: 9px;">
                                <!--<label class="control-label">Adults :</label>-->
                                <div class="controls">
                                    <span style="width: 171px;font-weight: bold;">(12+ Years)</span>
                                    <span style="width: 171px;font-weight: bold;margin-left: 89px;">(2-11 Years)</span>
                                    <!--<span class="smalltxt site_hint">( 12+ )</span>-->
                                </div>
                            </div>

                            <div class="control-group" style="margin-bottom: 9px;">
                                <label class="control-label" style="line-height: 26px;">Currency:</label>
                                <div class="controls">
                                    <select name="currency" class="medium_select" style="width: 248px;">
                                        <?php if ($currencies) { ?>
                                            <?php foreach ($currencies as $curr) { ?>
                                                <?php
                                                $str = "";
                                                if ($curr->default == 1) {
                                                    $str = "selected";
                                                }
                                                ?>
                                                <option <?php echo $str; ?> value="<?php echo $curr->iso_code; ?>"><?php echo $curr->title . " (" . $curr->iso_code . ")"; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <script type='text/javascript' src='http://openx.wayfareinteractive.com/openx/www/delivery/spcjs.php?id=420&amp;zones=14737'></script>
                            <script type='text/javascript'>OA_show('14737');</script>


                            <div class="control-group">
                                <button class="btn btn-site btn-large pull-right txtbold" style="border-radius: 5px;" id="find_flight" type="submit">Search</button>
                            </div>
                            <?php $this->endWidget(); ?>
                            
                            <div class="control-group clear">
                                <br>
                                <div class="controls" style="font-size: 13px;">
                                    For information on booking children under 2 years of age please see our <a target="_blank" href="<?= Yii::app()->request->baseUrl; ?>/home/faq">FAQ section</a>.
                                </div>
                            </div>
                        </div> 

                        <div class="tab-pane" id="tab3">
                            <p class="s-title" style="text-align: center !important;font-weight: bold;">Search Hundreds of Travel Companies to Create Your Perfect Trip</p>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                'id' => 'all-search-form',
                                'action' => Yii::app()->request->baseUrl . "/travel/opt_search",
                                'method' => 'get',
                                'enableAjaxValidation' => false,
                                'htmlOptions' => array(
                                    'class' => 'form-vertical form-normal top10px',
                                ),
                            ));
                            ?>

                            <div class="control-group" style="float:left">
                                <!--<label class="control-label" style="width: 140px;">Flying From:</label>-->
                                <div class="controls">
                                    <i class="fa-li fa fa-spinner fa-spin" id="afo_load" style="position:absolute;left:320px;top:7px;display: none;"></i>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'from_airport',
                                        'value' => '',
//                                        'source' => Yii::app()->request->baseUrl . '/home/iata_search',
                                        'source' => 'js: function(request, response) {
                                            $.ajax({
                                                url: "' . Yii::app()->request->baseUrl . '/travel/iata_search",
                                                dataType: "json",
                                                data: {
                                                    term: request.term,
                                                },
                                                success: function (data) {
                                                    $("#afo_load").hide();
                                                    response(data);
                                                }
                                            })
                                        }',
                                        'options' => array(
                                            'minLength' => '1', // min chars to start search
                                            'select' => 'js:function(event, ui) { 
                                                            $("#all_from_ap").val(ui.item.id);
                                                            $("#afa_sk").removeClass("sb_error");
                                                        }'
                                        ),
                                        'htmlOptions' => array(
                                            'class' => 'large_input',
                                            //'placeholder' => 'Flying From...',
                                            'placeholder' => 'Where would you like to fly from?',
                                            'id' => "afa_sk",
                                            'style' => 'width:333px;'
                                        ),
                                    ));
                                    ?>
                                    <input name="from" type="hidden" value="" id="all_from_ap" />
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="control-group" style="float:left">
                                <!--<label class="control-label" style="width: 140px;">Going To:</label>-->
                                <div class="controls">
                                    <i class="fa-li fa fa-spinner fa-spin" id="afd_load" style="position:absolute;left:320px;top:7px;display: none;"></i>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'to_airport',
                                        'value' => '',
//                                        'source' => Yii::app()->request->baseUrl . '/home/iata_search',
                                        'source' => 'js: function(request, response) {
                                            $.ajax({
                                                url: "' . Yii::app()->request->baseUrl . '/travel/iata_search",
                                                dataType: "json",
                                                data: {
                                                    term: request.term,
                                                },
                                                success: function (data) {
                                                    $("#afd_load").hide();
                                                    response(data);
                                                }
                                            })
                                        }',
                                        'options' => array(
                                            'minLength' => '1', // min chars to start search
                                            'select' => 'js:function(event, ui) { 
                                                            $("#all_to_ap").val(ui.item.id);
                                                            $("#ata_sk").removeClass("sb_error");
                                                        }'
                                        ),
                                        'htmlOptions' => array(
                                            'class' => 'large_input',
                                            //'placeholder' => 'Going To...',
                                            'placeholder' => 'Where are you flying to?',
                                            'id' => "ata_sk",
                                            'style' => 'width:333px;'
                                        ),
                                    ));
                                    ?>
                                    <input name="to" type="hidden" value="" id="all_to_ap" />
                                </div>
                            </div> 
                            <div class="clearfix"></div>
                            <div class="control-group" style="float:left">
                                <!--<label class="control-label" style="width: 140px;">Hotel Location:</label>-->
                                <div class="controls">
                                    <i class="fa-li fa fa-spinner fa-spin" id="ah_load" style="position:absolute;left:320px;top:7px;display: none;"></i>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'search_keyword',
                                        'value' => '',
//                                        'source' => Yii::app()->request->baseUrl . '/home/location_search',
                                        'source' => 'js: function(request, response) {
                                            $.ajax({
                                                url: "' . Yii::app()->request->baseUrl . '/travel/location_search",
                                                dataType: "json",
                                                data: {
                                                    term: request.term,
                                                },
                                                success: function (data) {
                                                    $("#ah_load").hide();
                                                    response(data);
                                                }
                                            })
                                        }',
                                        'options' => array(
                                            'minLength' => '1', // min chars to start search
                                            'select' => 'js:function(event, ui) { 
                                                            $("#all_loc").val(ui.item.id);
                                                            $("#ah_sk").removeClass("sb_error");
                                                        }'
                                        ),
                                        'htmlOptions' => array(
                                            'class' => 'large_input',
                                            //'placeholder' => 'Hotel Location...',
                                            'placeholder' => 'Where would you like to stay?',
                                            'id' => "ah_sk",
                                            'style' => 'width:333px;'
                                        ),
                                    ));
                                    ?>
                                    <input name="location_id" type="hidden" value="" id="all_loc" />
                                </div>
                            </div>   
                            <div class="clearfix"></div>
                            <div class="control-group">
                                <!--<label class="control-label" style="width: 140px;">Hotel Name:</label>-->
                                <div class="controls">
                                    <input type="text" name="name" class="large_input" style="width: 333px;" placeholder="Name of your preferred hotel (optional)" />
                                    <!--<span class="smalltxt site_hint">( Optional )</span>-->
                                </div>
                            </div>



                            <div class="control-group">
                                <label class="control-label" style="line-height: 30px;">Departing:</label>
                                <div class="controls">
                                    <div class="input-append date " style="">
                                        <?php
                                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'name' => 'depart',
                                            'value' => date('d/m/Y'),
                                            'options' => array(
                                                'showAnim' => 'fold',
                                                'dateFormat' => 'dd/mm/yy',
                                                'minDate' => date('d/m/Y'),
                                            ),
                                            'htmlOptions' => array(
                                                'size' => '16',
                                                'readonly' => true,
                                                'id' => 'dep22',
                                                'style' => 'cursor:pointer;'
                                            ),
                                        ));
                                        ?>
                                        <span class="add-on cal_ico" cd="#dep22" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                    </div> 
                                </div>
                            </div>  

                            <div class="control-group">
                                <label class="control-label" style="line-height: 30px;">Returning:</label>
                                <div class="controls">
                                    <div class="input-append date " style="">
                                        <?php
                                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'name' => 'return',
                                            'value' => date('d/m/Y', time() + (60 * 60 * 24 * 7)),
                                            'options' => array(
                                                'showAnim' => 'fold',
                                                'dateFormat' => 'dd/mm/yy',
                                                'minDate' => date('d/m/Y', time() + (60 * 60 * 24)),
                                            ),
                                            'htmlOptions' => array(
                                                'size' => '16',
                                                'readonly' => true,
                                                'id' => 'ret122',
                                                'style' => 'cursor:pointer;'
                                            ),
                                        ));
                                        ?>
                                        <span class="add-on cal_ico" cd="#ret122" style="cursor: pointer;"><i class="icon-calendar"></i></span>
                                    </div>
                                </div>
                            </div> 

                            <div class="control-group">
                                <!--<label class="control-label" style="width: 140px;">Cabin / Rooms:</label>-->
                                <div class="controls">
                                    <select name="class" class="large_select" style="width: 169px;">
                                        <option value="economy">Economy Class</option>
                                        <option value="business">Business Class</option>
                                        <option value="first">First Class</option>
                                    </select>
                                    <select name="rooms" class="large_select" id="al_rms" style="width: 169px;">
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <?php
                                            $str = "Rooms";
                                            if ($i == 1) {
                                                $str = "Room";
                                            }
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <!--<label class="control-label" style="width: 140px;">Adults / Children:</label>-->
                                <div class="controls">

                                    <select name="adults" class="medium_select" id="al_gst" style="width: 169px;">
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <?php
                                            $str = "Adults";
                                            if ($i == 1) {
                                                $str = "Adult";
                                            }
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                        <?php } ?>
                                    </select>
                                    <select name="children" class="medium_select" id="al_chl" style="width: 169px;">
                                        <?php for ($i = 0; $i <= 10; $i++) { ?>
                                            <?php
                                            $str = "Children";
                                            if ($i == 1) {
                                                $str = "Child";
                                            }
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i . " " . $str; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group" style="margin-bottom: 9px;">
                                <!--<label class="control-label">Adults :</label>-->
                                <div class="controls">
                                    <span style="width: 171px;font-weight: bold;">(12+ Years)</span>
                                    <span style="width: 171px;font-weight: bold;margin-left: 89px;">(2-11 Years)</span>
                                    <!--<span class="smalltxt site_hint">( 12+ )</span>-->
                                </div>
                            </div>


                            <div class="control-group" style="margin-bottom: 9px;">
                                <label class="control-label" style="line-height: 26px;">Currency:</label>
                                <div class="controls">
                                    <select name="currency" class="medium_select" style="width: 248px;">
                                        <?php if ($currencies) { ?>
                                            <?php foreach ($currencies as $curr) { ?>
                                                <?php
                                                $str = "";
                                                if ($curr->default == 1) {
                                                    $str = "selected";
                                                }
                                                ?>
                                                <option <?php echo $str; ?> value="<?php echo $curr->iso_code; ?>"><?php echo $curr->title . " (" . $curr->iso_code . ")"; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="control-group">
                                <button class="btn btn-site btn-large pull-right txtbold" style="border-radius: 5px;" id="find_plus" type="submit">Search</button>
                            </div>
                            <?php $this->endWidget(); ?> 
                            
                            <div class="control-group clear">
                                <br>
                                <div class="controls" style="font-size: 13px;">
                                    For information on booking children under 2 years of age please see our <a target="_blank" href="<?= Yii::app()->request->baseUrl; ?>/home/faq">FAQ section</a>.
                                </div>
                            </div>

                        </div> 
                    </div>



                </div>
                <!--=================================== end taps -->
		<!--ads-->
        <!--
        <div class="ads_m">
<script type="text/javascript">

var uri = 'http://impgb.tradedoubler.com/imp?type(img)g(18962500)a(2416291)' + new String (Math.random()).substring (2, 11);

document.write('<a href="http://clkuk.tradedoubler.com/click?p=60261&a=2416291&g=18962500" target="_BLANK"><img src="'+uri+'" border=0></a>');

</script>
</div>
-->
        <!--ads-->
<div class="ads_b">
<!--<script type="text/javascript">
var uri = 'http://impgb.tradedoubler.com/imp?type(img)g(17950824)a(2416291)' + new String (Math.random()).substring (2, 11);
document.write('<a href="http://clkuk.tradedoubler.com/click?p=19300&a=2416291&g=17950824" target="_BLANK"><img src="'+uri+'" border=0></a>');
</script>-->
    <!--<a href="http://www.xoomrentalcars.com"><img src="https://www.cartrawler.com/affengine/banners/b24_728x90_eng.jpg" /></a>-->
    <script type="text/javascript">
 var uri = 'http://impgb.tradedoubler.com/imp?type[2](js)g(22095058)a(2443174)' + new String (Math.random()).substring (2,11);
 document.write('<sc'+'ript type="text/javascript" src="'+uri+'"charset="ISO-8859-1"></sc'+'ript>');
 </script>
</div>
                <div class="row-fluid top20px" style="padding:0 0 0 10px ">

                    <?php if ($info) { ?>
                        <?php foreach ($info as $inf) { ?>
                            <div class="span4 imageBack">
                                <?php
                                $img_bath = Yii::app()->request->baseUrl . "/img/unitedImage.jpg";
                                if ($inf->image) {
                                    $img_bath = Yii::app()->request->baseUrl . "/media/info/" . $inf->image;
                                }
                                ?>
                                <a href="<?php echo Yii::app()->request->baseUrl . "/home/info_details/" . $inf->id; ?>"><img src="<?php echo $img_bath; ?>" class="img"></a>
                                <a href="<?php echo Yii::app()->request->baseUrl . "/home/info_details/" . $inf->id; ?>" class="title2" style="font-weight: bold;"><?php echo $inf->title; ?></a>
                                <p class="title2">
                                    <?php
                                    $details = "";
                                    if (strip_tags($inf->details)) {
                                        $details = strip_tags($inf->details);
                                        if (strlen($details) > 95) {
                                            $details = mb_substr(strip_tags($inf->details), 0, 100) . "...";
                                        }
                                    }
                                    ?>
                                    <span class="site_color2"><?php echo $details; ?></span>
                                    <a href="<?php echo Yii::app()->request->baseUrl . "/home/info_details/" . $inf->id; ?>" class="pull-right">View Details</a>
                                </p>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div style="font-size: 20px;margin-bottom: 100px;">Sorry , there are no Company Info.</div>
                    <?php } ?>


                </div>
                



            </div>
        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
        setTimeout(function(){$(".winCmpMsg").html("Also compare:");},2000); 
    });
       
</script>
<!--=================================== end content -->

</script>