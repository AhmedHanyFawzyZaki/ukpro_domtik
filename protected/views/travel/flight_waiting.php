<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - wait';
?>

<?php
YII::app()->clientScript->registerScript('gg', '
    $("#prog").animate({width : 400},10000,"linear",function(){
        window.location = "' . Yii::app()->createUrl('travel/flight_results', array('search_id' => $search_id, 'currency' => $currency, 'trip_id' => $trip_id,'flag'=>'oo')) . '";
    });
');
?>

<div class="row-fluid">
    <div class="span8 offset2 flight_res srchdiv top50px">
        <div class="row-fluid">
            <div class="span12 color_div flightitem">
                <h2 style="color: #3C9DBE; margin-left: 40px;text-align: center;">Please wait just a moment while we load the best prices from hundreds of travel companies.</h2>

                <div style="position: relative;height: 20px;width: 400px;margin: 40px auto;border: 1px solid #3C9DBE;">
                    <div id="prog" style="width: 0px;height: 20px;position: absolute;top: 0px;left: 0px;background: #3C9DBE;">

                    </div>
                </div>
                <!--ads
        <!--<div class="ads_w">
<script type="text/javascript">
var uri = 'http://impgb.tradedoubler.com/imp?type(img)g(21661188)a(2416291)' + new String (Math.random()).substring (2, 11);
document.write('<a href="http://clkuk.tradedoubler.com/click?p=231084&a=2416291&g=21661188" target="_BLANK"><img src="'+uri+'" border=0></a>');
</script>

</div>-->
<!--<div class="text-center">
<script type="text/javascript">
 var uri = 'http://impgb.tradedoubler.com/imp?type[2](js)g(22095058)a(2443174)' + new String (Math.random()).substring (2,11);
 document.write('<sc'+'ript type="text/javascript" src="'+uri+'"charset="ISO-8859-1"></sc'+'ript>');
 </script>
 </div>-->

        <!--ads-->
        <!--ads-->
<!--        <div class="ads_w">
<script type="text/javascript">
var uri = 'http://impgb.tradedoubler.com/imp?type(img)g(18962488)a(2416291)' + new String (Math.random()).substring (2, 11);
document.write('<a href="http://clkuk.tradedoubler.com/click?p=60261&a=2416291&g=18962488" target="_BLANK"><img src="'+uri+'" border=0></a>');
</script>-->


</div>
        <!--ads-->

            </div>
        </div>
    </div>
</div>
