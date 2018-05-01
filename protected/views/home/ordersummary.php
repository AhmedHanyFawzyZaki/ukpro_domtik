<div class="row">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?= Yii::app()->request->baseUrl ?>">Home</a></li>
            <li class="active">Shopping cart</li>
        </ol>

    </div>
    

    <?php
    //print_r($shippingadress);
   // die;
    
    if ($cart) {
        $total_shipping=0;
        $total_price = 0;
        $total_net_price = 0;
        foreach ($cart as $cat_id => $products) {
            $cat = Category::model()->findByPk($cat_id);
            $category_total_price = 0;
            $category_total_shipping = 0;
            $category_total_net_price = 0;
            ?>
            <div class="col-md-12 cart-table">
                <p class="cart-heading"><i class="fa fa-list"></i><?= $cat->title ?></p>
                <div class="table-responsive">
                    <table class="table table-striped">

                        <colgroup>
                            <col class="col-xs-1">
                            <col class="col-xs-2">
                            <col class="col-xs-1">
                            <col class="col-xs-1">
                            <col class="col-xs-1">
                            <col class="col-xs-2">
                            <col class="col-xs-2">
                            <col class="col-xs-1">
                            <col class="col-xs-1">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>item image</th>
                                <th>item name</th>
                                <?php
                                if ($cat_id == 3 || $cat_id == 4) {
                                    echo '<th>Size</th>';
                                }
                                if ($cat_id == 7) {
                                    echo '<th>Color</th>';
                                } elseif ($cat_id == 1 || $cat_id == 8 || $cat_id == 6) {
                                    echo '<th>Size</th>';
                                    echo '<th>Color</th>';
                                }
                                ?>
                                <th>quantity</th>
                                <th>item price</th>
                                <th>shipping</th>
                                <th>item total price</th>
                                <th>Remove</th>

                            </tr>
                        </thead>
                        <tbody>
        <?php
        // print_r($products);die;
        if ($products) {
            foreach ($products as $pro_id => $details) {
                $category_total_net_price+=$details['price'] * $details['qty'];
                $product = Product::model()->findByPk($pro_id);
                $shipp = ShippingValue::model()->findByAttributes(array('user_id' => $product->user_id, 'country_id' => $shippingadress['shipping_country']));
                $category_total_shipping+=$shipp->title;                                        
                ?>
                                    <tr>
                                        <td><div class="item-pic"><img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>" alt="" /></div></td>
                                        <td><?= $product->title ?></td>
                                    <?php
                                    if ($cat_id == 3 || $cat_id == 4) {
                                        echo '<td>' . $details['size'] . '</td>';
                                    } elseif ($cat_id == 7) {
                                        echo '<td>' . $details['color'] . '</td>';
                                    } elseif ($cat_id == 1 || $cat_id == 8 || $cat_id == 6) {
                                        echo '<td>' . $details['size'] . '</td>';
                                        echo '<td>' . $details['color'] . '</td>';
                                    }
                                    ?>
                                        <td>
                                         <?= $details['qty'] ?> 
                                        </td>
                                        <td><?= $details['price'] ?> GBP</td>
                                        <td><?= $shipp->title ?> GBP</td>
                                        <td><?= $details['qty'] * $details['price'] + $details['ship_price'] ?> GBP</td>
                                        <td><a href="<?= Yii::app()->request->baseUrl ?>/home/Removeordersummary?cat_id=<?= $cat_id ?>&id=<?= $pro_id ?>"><i class="fa fa-trash-o"></i></a></td>



                                    </tr>
                <?php
            }
            $category_total_price=$category_total_net_price+$category_total_shipping;
            //$category_total_price = $category_total_net_price;
        }
        ?>
                            <tr class="total-row">
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php
                            //add empty cells to keep the design layout
                            if ($cat_id == 3 || $cat_id == 4) {
                                echo '<td></td>';
                            } elseif ($cat_id == 7) {
                                echo '<td></td>';
                            } elseif ($cat_id == 1 || $cat_id == 8 || $cat_id == 6) {
                                echo '<td></td>';
                                echo '<td></td>';
                            }
                            ?>
                                <td>Items Total Price <span><?= $category_total_net_price ?> GBP</span></td>
                                <td>Total Shipping <span><?= $category_total_shipping ?> GBP</span></td>
                                <td>Total Price <span><?= $category_total_price ?> GBP</span></td>
                                <td></td>
                            </tr>


                        </tbody>
                    </table>
                </div>

            </div><!--end cart-table-->
                                <?php
                                $total_shipping+=$category_total_shipping;
                                $total_price+=$category_total_price;
                                $total_net_price+=$category_total_net_price;
                            }
                            ?>
        <div class="col-md-4 pull-right">
            <div class="col-md-12 total">
                <dl class="dl-horizontal">
                    <dt>Items Total Price:</dt>
                    <dd><?= $total_net_price ?> GBP</dd>
                    <dt>Total Shipping:</dt>
                    <dd><?= $total_shipping ?> GBP</dd>
                </dl>

                <div class="col-md-12 result">
                    <span><?= $total_price ?> GBP</span>
                </div>
                <div class="col-md-12 result">
        <?php
        if (Yii::app()->user->isGuest)
            echo '<a data-target="#login-modal" data-toggle="modal" data-dismiss="modal" class="btn btn-info">Checkout</a>';
        else
            echo '<a href="' . Yii::app()->request->baseUrl . '/home/paynow" class="btn btn-info">Checkout</a>';
        ?>
                </div>
            </div>
        </div>
    <?php
} //end of cart condition
else {
    ?>
        <div style="margin-top: 55px;">
            <div class="alert alert-danger">Your Cart Is Empty</div>
        </div>
                    <?php
                }
                ?>
</div>
</div>
</div>