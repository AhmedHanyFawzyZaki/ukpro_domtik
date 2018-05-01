<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
?>

<div class="row profile">

<div class="col-md-12">
<ol class="breadcrumb">
      
      <li><a href="<?= Yii::app()->request->baseUrl ?>/users/Dashboard">Dashboard</a></li>
      <li><a href="<?= Yii::app()->request->baseUrl ?>/users/Order">Orders</a></li>
      <li class="active">Order Details</li>
    </ol>
    
    </div>

<div class="col-md-12 col-xs-12 profile-title">
        <p class="profile-name"><?php echo $user->username; ?></p>
    </div>


    <!--appear-->
    <?php $this->renderpartial('../home/menu', array('user' => $user)); ?>
    <!--end appear-->


<div class="col-md-9 col-sm-8 col-xs-12">
<div class="info seller-profile">
<p class="profile-name">Order Details</p>


 <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'editprofile-form',
                        'enableAjaxValidation' => false,
                        'type' => 'vertical',
                        'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'
                        ),
                    ));
                    ?>


   



<?php
  $product = Product::model()->findByAttributes(array('id' => $order_detail->product_id));
    
    ?>
<div  style="width:761;min-height:200px;border: 2px solid #000;clear: both;margin-bottom: 30px;padding: 20px;">

<dl class="dl-horizontal">
      <dt>product name:</dt>
      <dd><?= $product->title ?></dd>
      <dt>date:</dt>
      <dd><?= $order->creation_date ?></dd>
<!--      <dt>Remaining Number:</dd>
      <dd>XX name</dd>-->
      <dt>Status:</dt>
      
      <dd><?php echo  OrderStatus::model()->findByPk($order->status_id)->title ?></dd>
       
<!--      <dd><p><?php // echo $form->dropDownListRow($order, 'status_id', CHtml::listData(OrderStatus::model()->findAll(), 'id', 'title'), array('prompt' => 'select Payment Status ', 'class' => 'form-control')); ?></p>
</dd>-->
      
       
      <dt>Client Name:</dt>
      <dd><?= $order_detail->order->userorders->username ?></dd>
      <dt>Client Address:</dt>
      <dd><?= $order_detail->shipping_address ?></dd>
  <dt>Shipping City:</dt>
      <dd><?= $order_detail->shipping_city ?></dd>
      <dt>Shipping Country:</dt>
      <dd><?= $order_detail->shipping_country ?></dd>
      <dt>Shipping Post code:</dt>
      <dd><?= $order_detail->shipping_postcode ?></dd>
      <dt>Shipping Price:</dt>
      <dd><?= $order_detail->shipping_price ?> GBP</dd>
      <dt>Total Price:</dt>
      <dd><?= $order_detail->total_price ?> GBP</dd>
      <dt>Net Price:</dt>
      <dd><?= $order_detail->net_price ?> GBP</dd>
       <dt>Quantity:</dt>
      <dd><?= $order_detail->quantity ?></dd>
       <dt>Color:</dt>
      <dd><?= $order_detail->color ?></dd>
       <dt>Size:</dt>
      <dd><?= $order_detail->size ?></dd>
       <dt>Commission Price:</dt>
      <dd><?= $order_detail->commission_price ?></dd>
    </dl>
</div>







    
    <div class="col-md-offset-6 col-md-6 col-sm-8 col-sm-offset-3 col-xs-12 col-xs-offset-0 n-button">
           <?php  // echo CHtml::submitButton('Save', array('class' => 'btn btn-default register-bt')); ?>

    </div>

  <?php $this->endWidget(); ?>
</div><!--end info-->
</div>

</div>




<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->



</div>
</div>
