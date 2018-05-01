<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Uk Pro.Solutions LTD">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
//$IPDetail = Helper::getvisitorinfo($ipaddress);
        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ipaddress);
        if ($xml->geoplugin_countryName != 'Egypt') {
            $show = 1;
            ?>
            <meta name="verification" content="defad876bcc1a7c994212a0ddfc8bc26" />
            <!-- TradeDoubler site verification 2452783 -->
        <?php } else $show = 0; ?>
        <link rel="shortcut icon" href="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png"> 
        <!--         css and js-->
        <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/travel/bootstrap.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/travel/style.css" rel="stylesheet">

        <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php if ($show == 1) { ?>
            <script>
                (function(i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function() {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-55669146-1', 'auto');
                ga('send', 'pageview');

            </script>
        <?php } ?>
        <div class="">







hi


        </div>





    </body>
</html>
