<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
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



 <div class="container">
     <div class="wrap">
     <div class="col-md-12 col-xs-12 welcome">
     <p>Save time, pay less, travel more</p>
     <span>search 700 sites in the time it takes to search one</span>
     </div><!--end welcome-->
     
     <div class="col-md-12 col-xs-12 forms">
     <div class="col-md-4 col-sm-4 col-xs-12 book-form">
     <p class="form-title"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight-icon.png">flight</p>
     
     <!--<form role="form" class="form-horizontal fligh-form" action="<?php echo Yii::app()->getBaseUrl(true); ?>/home/hotels">-->
     
     
     
          <?php
                            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                'id' => 'flight-search-form',
                                'action' => Yii::app()->request->baseUrl . "/travel/search_flights",
                                'method' => 'get',
                                'enableAjaxValidation' => false,
                                'htmlOptions' => array(
                                    'class' => 'form-horizontal fligh-form',
                                ),
                            ));
                            ?>
     
     
     
     <div class="form-group">
       <div class="col-sm-12">
<!--          <input type="email" placeholder="Londonderry, United Kingdom(LDY)" id="" class="form-control">
        -->
       
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
                                            'class' => 'form-control',
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
      
      <div class="form-group">
       <div class="col-sm-12">
          <!--<input type="email" placeholder="To" id="" class="form-control">-->
           
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
                                            'class' => 'form-control',
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
      
       <div class="form-group">
       <div class="col-sm-12">
       <div class="form-control trip">
       <a href="javascript:void(0)" class="round-trip active"  id="round-trip">Round trip</a>
       <a href="javascript:void(0)" class="oneway" id="one-way">one way</a>
       <input style="margin-top: 0;" id="round-type" type="hidden" name="type" value="oneWay" />
       </div>
       </div>
       </div>
     
     <script>
     $(function(){
        $("#round-trip").click(function(){
            $("#round-type").val("roundTrip")
        }); 
        $("#one-way").click(function(){
            $("#round-type").val("oneWay")
        }); 
     });
     </script>
      
      <div class="form-group">
       <div class="col-sm-6">
          <!--<input type="email" placeholder="Depart" id="" class="form-control departure">-->
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
                                                'style' => 'cursor:pointer;',
                                                'class'=>'form-control departure'
                                            ),
                                        ));
                                        ?>

          <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/calender.png"></i>
        </div> 
        
        <div class="col-sm-6">
<!--          <input type="email" placeholder="Return" id="" class="departure form-control return-visible">
          <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/calender.png"></i>
          <input placeholder="Return" id="" class="form-control departure return-invisible" disabled="disabled">-->
            
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
                                                'style' => 'cursor:pointer;',
                                                'class'=>'departure form-control return-visible'
                                            ),
                                        ));
                                        ?>
            
          <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/calender.png"></i>
        </div> 
       
      </div>
      
      <div class="form-group">
       <div class="col-sm-6">
           <select class="form-control" name="adults">
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
        </div> 
        
        <div class="col-sm-6">
            <select class="form-control" name="children"> 
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
      
      
      
      <div class="form-group">
       <div class="col-sm-12">
          <select class="form-control">
         <option value="economy">Economy Class</option>
                                        <option value="business">Business Class</option>
                                        <option value="first">First Class</option>

      </select>
        </div> 
       
      </div>
     
     
     
                       
<!--                 <script type='text/javascript' src='http://openx.wayfareinteractive.com/openx/www/delivery/spcjs.php?id=420&amp;zones=14737'></script>
                            <script type='text/javascript'>OA_show('14737');</script>-->


                            <div class="control-group">
                                <button class="btn btn-site btn-large pull-right txtbold" style="border-radius: 5px;" id="find_flight" type="submit">Search</button>
                            </div>
                            <?php $this->endWidget(); ?>
     
     </div><!--end book-form-->
     
     <div class="col-md-4 col-sm-4 col-xs-12 book-form">
     <p class="form-title"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/hotel-icon.png">hotels</p>
     
     <!--<form role="form" class="form-horizontal fligh-form" action="<?php echo Yii::app()->getBaseUrl(true); ?>/home/hotels">-->
     
         
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
       <div class="col-sm-12">
          <!--<input type="email" placeholder="Location" id="" class="form-control">-->
           
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
                                            'id' => 'h_sk',
                                            'class'=>'form-control'
                                        ),
                                    ));
                                    ?>
                                    <input name="location_id" type="hidden" value="" id="loc" />
        </div> 
       
      </div>
      
      <div class="form-group">
          <div class="col-sm-12">
              <input type="text" name="name" class="form-control" placeholder="Name of your preferred hotel (optional)" style="width:333px;" />
              </div>
          </div>
     
      <div class="form-group">
       <div class="col-sm-6">
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
                                                'style' => 'cursor:pointer;',
                                                'class'=>'form-control departure'
                                            ),
                                        ));
                                        ?>
           <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/calender.png"></i>
        </div> 
        
        <div class="col-sm-6">
          <!--<input type="email" placeholder="Return" id="" class="form-control departure">-->
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
                                                'style' => 'cursor:pointer;',
                                                'class'=>'form-control departure'
                                            ),
                                        ));
                                        ?>
          
          <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/calender.png"></i>
        </div> 
       
      </div>
      
      <div class="form-group">
       <div class="col-sm-6">
          <select class="form-control" name="rooms">
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
        
        <div class="col-sm-6">
            <select class="form-control" name="guests">
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
      
      
      
      <div class="form-group">
       <div class="col-sm-12">
           <select name="currency" class="form-control" style="width: 247px">
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
      
      <button class="btn btn-default" id="find_hotel" style="border-radius: 5px;" type="submit">search</button>
      <?php $this->endWidget(); ?>
    <!--</form>-->
     
     </div><!--end book-form-->
     </div><!--end forms-->
     
   
     
     <div class="col-md-12 col-xs-12 listing">
     <ul role="tablist" class="nav nav-tabs" id="myTab">
    
      <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" 
      id="flight-tab" href="#flight">flights</a></li>
      <li role="presentation"><a data-toggle="tab" id="hotel-tab" role="tab" href="#hotel">hotels</a></li>
     
      
    </ul>
    
    <div class="tab-content" id="myTabContent">
      <div aria-labelledby="flight-tab" id="flight" class="tab-pane fade in active" role="tabpanel">
        
        <div id="flights" class="tab-pane fade active in" role="tabpanel">
        <p class="col-md-12 col-xs-12 list-title">Top International Flight Destinations</p>
       
        <?php foreach ($cities as $city){
              $depart2 = date('d-m-Y');
        $return2 = date("d-m-Y", time()+(86400*7)); 
            ?>
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight2.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name"><?php echo $city->name ?></a>
        <span class="place"><?php echo $city->country_name ?></span>
        <!--<span class="price">£325</span>-->
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true) ?>/travel/search_flights?from=LON&to=<?= $city->iata_code?>&type=roundTrip&depart=<?= $depart2?>&return=<?= $return2?>&adults=1&children=0">Search Flights</a>
        </div>
        </div><!--end flight-->
        <?php } ?>
        <div id="appended" class="appended">

            </div>
        <div class="col-md-12 col-xs-12 show">
         <button onclick="doAjax()" class="btn btn-default more">show more</button>
        </div>
        
        
<!--        <p class="col-md-12 col-xs-12 list-title">Top Domestic Flight Destinations</p>
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight2.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight3.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight4.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight5.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight6.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        <div id="appended2" class="appended">

            </div>
        <div class="col-md-12 col-xs-12 show"><button onclick="doAjax2()" class="btn btn-default more">show more</button></div>
     -->
        </div>
        
        
      </div>
      
      <div aria-labelledby="hotel-tab" id="hotel" class="tab-pane fade" role="tabpanel">
     
          
          
          <p class="col-md-12 col-xs-12 list-title">Top International hotel Destinations</p>
          
          <div class="loader"><img src="<?php echo Yii::app()->getBaseUrl(true)."/image/travel/ajax-loader.gif" ?>" ></div>
         
          
          
           <div class="hotel-cont" class="appended">

            </div>
 
        
        <div id="appended3" class="appended">

            </div>
        
         <div class="col-md-12 col-xs-12 show">
             <div class="more-loader"><img src="<?php echo Yii::app()->getBaseUrl(true)."/image/travel/ajax-loader.gif" ?>" ></div>
         
             <button id="load-more-hotels" class="btn btn-default more">show more</button></div>
        
        
<!--        <p class="col-md-12 col-xs-12 list-title">Top Domestic hotel Destinations</p>
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight2.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight3.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight4.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight5.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        
        <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="<?php echo Yii::app()->getBaseUrl(true); ?>/flight"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flight6.png"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="#" class="flight-name">HEART ISLAND</a>
        <span class="place">australia</span>
        <span class="price">£325</span>
        <a class="btn btn-default book-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/details">book now</a>
        </div>
        </div>end flight
        <div id="appended4" class="appended">

            </div>
        <div class="col-md-12 col-xs-12 show">
         
        <button onclick="doAjax4()" class="btn btn-default more">show more</button>
        </div>-->
      </div>
      
      
    </div>
    </div><!--end listing-->
    
    
     
     
     
     </div>
     </div>    
     

<div class="dest-country">
<div class="container">
<div class="wrap">
<p class="col-md-12 col-xs-12 list-title">Top Flight Destinations by Country</p>
<div class="col-md-4 col-sm-4 col-xs-12 country">

<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">

                <?php for($i=0;$i<6 ;$i++){ 
                    $city_of_country = IataCodes::model()->find("country_name = '".$countries[$i]->country_name."' and app_location_type = 'City' ")->iata_code;
                    ?>
                <li><a href="<?php echo Yii::app()->getBaseUrl(true) ?>/travel/search_flights?from=LON&to=<?= $city_of_country ?>&type=roundTrip&depart=<?= $depart2?>&return=<?= $return2?>&adults=1&children=0"><span><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flag1.png">
                        </span>Flights to <?= $countries[$i]->country_name ?>s</a></li>
                <?php } ?>


            </ul>


</ul>

</div><!--end country-->

<div class="col-md-4 col-sm-4 col-xs-12 country">

<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">

                 <?php for($i=6;$i<12 ;$i++){ 
                    $city_of_country = IataCodes::model()->find("country_name = '".$countries[$i]->country_name."' and app_location_type = 'City' ")->iata_code;
                    ?>
                <li><a href="<?php echo Yii::app()->getBaseUrl(true) ?>/travel/search_flights?from=LON&to=<?= $city_of_country ?>&type=roundTrip&depart=<?= $depart2?>&return=<?= $return2?>&adults=1&children=0"><span><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flag1.png">
                        </span>Flights to <?= $countries[$i]->country_name ?></a></li>
                <?php } ?>

</ul>

</div><!--end country-->

<div class="col-md-4 col-sm-4 col-xs-12 country">

<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">

 <?php for($i=12;$i<18 ;$i++){ 
                    $city_of_country = IataCodes::model()->find("country_name = '".$countries[$i]->country_name."' and app_location_type = 'City' ")->iata_code;
                    ?>
                <li><a href="<?php echo Yii::app()->getBaseUrl(true) ?>/travel/search_flights?from=LON&to=<?= $city_of_country ?>&type=roundTrip&depart=<?= $depart2?>&return=<?= $return2?>&adults=1&children=0"><span><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/flag1.png">
                        </span>Flights to <?= $countries[$i]->country_name ?></a></li>
                <?php } ?>


</ul>

</div><!--end country-->
</div>
</div>
</div><!--end dest-country-->




<form method="post">
<input type="hidden" name="default_search_id" id="default_search_id" value="">
<input type="hidden" name="page" id="page" value="">
</form>
<script>

$(function(){
   $(document).ready(function(){
       $("#default_search_id").val('');
       $("#page").val('');
          $.ajax({
            url: "<?= Yii::app()->request->getBaseUrl(true) ?>/travel/getDefaultHotels",
            //dataType: "HTML",
            success: function (data) {
              // console.log(data);
               $("#default_search_id").val(data);
               
               
        setTimeout(function(){ 
        var search_id = $("#default_search_id").val(); 
        var page = $("#page").val();
           $.ajax({
            url: "<?= Yii::app()->request->getBaseUrl(true) ?>/travel/getHotelsResults",
            type:"POST",
            dataType: "json",
            data: "search_id="+search_id+"&page="+page,
            success: function (data) {
            //   console.log(data);
               $(".hotel-cont").html(data['hotels']);
               $("#page").val(parseInt(data['page'])+1);
              $(".loader").fadeOut();
            }
        });
    
    }, 10000);
    
            }
        });
        
//        setTimeout(function(){ 
//        var search_id = $("#default_search_id").val(); 
//        var page = $("#page").val();
//           $.ajax({
//            url: "<?= Yii::app()->request->getBaseUrl(true) ?>/travel/getHotelsResults",
//            type:"POST",
//            dataType: "json",
//            data: "search_id="+search_id+"&page="+page,
//            success: function (data) {
//            //   console.log(data);
//               $(".hotel-cont").html(data['hotels']);
//                $("#page").val(parseInt(data['page'])+1);
//            }
//        });
//    
//    }, 10000);
        
   });
   
   $("#load-more-hotels").click(function(){
    $(".more-loader").fadeIn();
      $.ajax({
            url: "<?= Yii::app()->request->getBaseUrl(true) ?>/travel/getDefaultHotels",
            //dataType: "HTML",
            success: function (data) {
               console.log(data);
               $("#default_search_id").val(data);
               
                   setTimeout(function(){ 
        var search_id = $("#default_search_id").val(); 
        var page = $("#page").val();
           $.ajax({
            url: "<?= Yii::app()->request->getBaseUrl(true) ?>/travel/getHotelsResults",
            type:"POST",
            dataType: "json",
            data: "search_id="+search_id+"&page="+page,
            success: function (data) {
            //   console.log(data);
            
               $("#appended3").append(data['hotels']);
                $("#page").val(parseInt(data['page'])+1);
                 $(".more-loader").fadeOut();
              
            }
        });
    
    }, 10000);
    
            }
        });
        
    
        
    
   });
   
   
});
</script>



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
<script>
    function doAjax2()
    {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/home/ajax",
            //dataType: "HTML",
            success: function (result) {
                //alert("akjahjk");            
                $("#appended2").append(result);
            }
        });
    }
</script>
<script>
    function doAjax3()
    {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/home/ajax",
            //dataType: "HTML",
            success: function (result) {
                //alert("akjahjk");            
                $("#appended3").append(result);
            }
        });
    }
</script>
<script>
    function doAjax4()
    {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/home/ajax",
            //dataType: "HTML",
            success: function (result) {
                //alert("akjahjk");            
                $("#appended4").append(result);
            }
        });
    }
</script>


<style>
    
    .loader{
        margin-left: 50%;
    }
    .more-loader{
       // margin-left: 50%;
       display: none;
    }
</style>