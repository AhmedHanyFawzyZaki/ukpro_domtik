<script src="http://code.highcharts.com/highcharts.js"></script>


<div class="row-fluid">

    <h3><?php echo 'Website Categories'; ?> VS <?php echo 'Sellers'; ?></h3>

    <div class="panel panel-default">

        <div class="panel-body">
            <div id="columnchart"></div>
            <script>
                $(function() {
                    $('#columnchart').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: [
<?php
$allcats = Category::model()->findAll();
foreach ($allcats as $cat) {
    echo "'" . $cat->title . "',";
}
?>

                            ]
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Orders'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [
<?php
$criteriaseller = new CDbCriteria;
$criteriaseller->condition = 'groups_id=1 or groups_id=4';
$users = User::model()->findAll($criteriaseller);
foreach ($users as $user) {
    ?>
                                {
                                    name: '<?php echo $user->username ?>',
                                    data: [<?php
    foreach ($allcats as $cat) {
//        $criteria = new CDbCriteria();
//        $criteria->select = 'SUM(t.quantity) as total';
//        $criteria->condition = "seller_id=:seller_id and product_id IN(SELECT id FROM product WHERE category_id=:category_id and user_id=:user_id)";
//        $criteria->params = array(":seller_id" => $user->id, ":category_id" => $cat->id, ":user_id" => $user->id);
//        $tot_point = OrderDetails::model()->find($criteria);
//        echo $tot_point->total.',';
        $criteria = new CDbCriteria();
        $criteria->condition = "seller_id=:seller_id and product_id IN(SELECT id FROM product WHERE category_id=:category_id and user_id=:user_id)";
        $criteria->params = array(":seller_id" => $user->id, ":category_id" => $cat->id, ":user_id" => $user->id);
        $orders = OrderDetails::model()->findAll($criteria);

        $servicecriteria = new CDbCriteria();
        $servicecriteria->condition = "reciever_id=:reciever_id and product_id IN(SELECT id FROM product WHERE category_id=:category_id and user_id=:user_id)";
        $servicecriteria->params = array(":reciever_id" => $user->id, ":category_id" => $cat->id, ":user_id" => $user->id);
        $services = Message::model()->findAll($servicecriteria);
        $tot_point = 0;
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $tot_point = $tot_point + $order->quantity;
            }
        }
        if (!empty($services)) {
            foreach ($services as $service) {
                $tot_point = $tot_point + 1;
            }
        }
        echo $tot_point . ',';
    }
    ?>]
                                },
<?php } ?>

                        ]
                    });
                });
            </script>



        </div>
    </div>



</div>

<div class="row-fluid">

    <h3><?php echo 'Payments Percentage'; ?></h3>

    <div class="panel panel-default">

        <div class="panel-body">
            <div id="donutchart"></div>
            <script>

                $(function() {
                    $('#donutchart').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 1, //null,
                            plotShadow: false
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                                type: 'pie',
                                name: 'Payments Percentage',
                                data: [
<?php
foreach ($allcats as $cat) {
    $servicescount=0;
    $ordercount=0;
    $criteria = new CDbCriteria();
    $criteria->condition = "product_id IN(SELECT id FROM product WHERE category_id=:category_id)";
    $criteria->params = array(":category_id" => $cat->id);
    $ordercount = count(OrderDetails::model()->findAll($criteria));

    $servicecriteria = new CDbCriteria();
    $servicecriteria->condition = "product_id IN(SELECT id FROM product WHERE category_id=:category_id)";
    $servicecriteria->params = array(":category_id" => $cat->id);
    $servicescount = count(Message::model()->findAll($servicecriteria));
    $counts=$ordercount+$servicescount;
    echo "['" . $cat->title . "'," . $counts . "],";
}
?>
                                ]
                            }]
                    });
                });


            </script>

        </div>
    </div>




</div>

<div class="row-fluid">
    <h3>main parts</h3>
    <ul class="shortcuts span12">

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/settings">
                <span class="fa fa-cogs"></span>
                <span class="shortcuts-label">Website Settings</span>
            </a>
        </li>

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/user">
                <span class="fa fa-user"></span>
                <span class="shortcuts-label">Users</span>
            </a>
        </li>

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/banner">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Site Slider</span>
            </a>
        </li>

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/ads">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Manage category advertisement</span>
            </a>
        </li>

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/sponsor">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Sponsors</span>
            </a>
        </li>

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/country">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">All world countries</span>
            </a>
        </li>

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/city">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Manage world cities</span>
            </a>
        </li>
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/colors">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Colors</span>
            </a>
        </li>
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/sizes">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Sizes</span>
            </a>
        </li>

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/brand">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">All Brands</span>
            </a>
        </li>
    </ul>
    <h3>Static Pages</h3>
    <ul class="shortcuts span12">
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/pageCat">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Pages Categories</span>
            </a>
        </li>

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/pages">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Manage Pages</span>
            </a>
        </li>

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/errormessage">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Error Pages</span>
            </a>
        </li>
    </ul>
    <h3>FAQ's</h3>
    <ul class="shortcuts span12">
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/faqCat">
                <span class="fa fa-question-circle"></span>
                <span class="shortcuts-label">FAQ's Categories</span> </a>
        </li>

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/faq">
                <span class="fa fa-question-circle"></span>
                <span class="shortcuts-label">Manage FAQ's</span> </a>
        </li>

    </ul>
    <h3>Categories</h3>
    <ul class="shortcuts span12">

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/Category">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Web site categories</span>
            </a>
        </li>
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/ProductCategory">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Product Category</span>
            </a>
        </li>
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/SubCategory">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Sub Category</span>
            </a>
        </li>



    </ul>

    <h3>Products</h3>
    <ul class="shortcuts span12">

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/make">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Motors Manufacturers</span>
            </a>
        </li>
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/motorModel">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Motors Models </span>
            </a>
        </li>
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/Gas">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Gas </span>
            </a>
        </li> <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/Door">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Door </span>
            </a>
        </li> <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/Kmage">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Kmage </span>
            </a>
        </li> <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/Age">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Age </span>
            </a>
        </li> <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/Emission">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Emission </span>
            </a>
        </li> <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/Engine">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Engine </span>
            </a>
        </li>
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/decorStyle">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label"> Home Decor Style</span>
            </a>
        </li>
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/decorType">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label"> Home Decor Type</span>
            </a>
        </li>

        <!--        <li class="events">
                    <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/product">
                        <span class="fa fa-file"></span>
                        <span class="shortcuts-label">Product </span>
                    </a>
                </li>-->

        <!--        <li class="events">
                    <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/size">
                        <span class="fa fa-file"></span>
                        <span class="shortcuts-label">size </span>
                    </a>
                </li>
                <li class="events">
                    <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/color">
                        <span class="fa fa-file"></span>
                        <span class="shortcuts-label">color </span>
                    </a>
                </li>-->

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/review">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Products Reviews </span>
            </a>
        </li>

        <!--        <li class="events">
                    <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/message">
                        <span class="fa fa-file"></span>
                        <span class="shortcuts-label">Message </span>
                    </a>
                </li>
        
                <li class="events">
                    <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/reply">
                        <span class="fa fa-file"></span>
                        <span class="shortcuts-label">Reply </span>
                    </a>
                </li>
                <li class="events">
                    <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/favourite">
                        <span class="fa fa-file"></span>
                        <span class="shortcuts-label">Favourite </span>
                    </a>
                </li>-->

    </ul>

    <h3>Payment</h3>
    <ul class="shortcuts span12">

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/FeePackage">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Fee Packages</span>
            </a>
        </li>
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/Commission">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Website Commissions </span>
            </a>
        </li>
        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/ShippingValue">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Shipping Values </span>
            </a>
        </li>


        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/Orders">
                <span class="fa fa-file"></span>
                <span class="shortcuts-label">Order </span>
            </a>
        </li>



        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/dashboard/logout">
                <span class="fa fa-power-off"></span>
                <span class="shortcuts-label">LogOut</span> </a>
        </li>
    </ul>
    <h3>LogOut</h3>
    <ul class="shortcuts span12">

        <li class="events">
            <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/admin/dashboard/logout">
                <span class="fa fa-power-off"></span>
                <span class="shortcuts-label">LogOut</span> </a>
        </li>
    </ul>

</div>

