<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
?>
<div class="row profile">

   
<div class="col-md-12">
<ol class="breadcrumb">
      <li><a href="<?= Yii::app()->request->baseUrl ?>/users/Dashboard">Dashboard</a></li>
      <li class="active">Orders</li>
    </ol>
    
    </div>


    <div class="col-md-12 col-xs-12 profile-title">
        <p class="profile-name"><?php echo $user->username; ?></p>
    </div>
  <!--appear-->
    <?php $this->renderpartial('../home/menu', array('user' => $user)); ?>
    <!--end appear-->

<div class="col-md-9 col-sm-8 col-xs-12 order-table">
<div class="table-responsive">
<table class="table table-striped">
      <thead>
        <tr>
          <th>Order no.</th>
          <th>Order date</th>
          <th>price</th>
<!--          <th>client</th>-->
          <th>status</th>
          <th>view</th>
<!--          <th>delete</th>-->
        </tr>
      </thead>
      <tbody>
         
      <?php 
      $count=1;
      foreach ($buyer_orders as $order){ 
          
 $order_owner=User::model()->findByAttributes(array('id'=>$order->buyer_id));
if($order->status_id==1){
    $status="Pending";
}elseif($order->status_id==2)
{
    $status="Cancelled";
}elseif($order->status_id==3)
{
     $status="Payment Completed";
}
          
          ?>
        <tr>
          <td><a href="#"><?= $count ?></a></td>
          <td><?= $order->creation_date ?></td>
          <td><?= $order->net_price ?> GBP</td>
<!--          <td><?= $order_owner->username ?></td>-->
          <td><?= $status ?></td>
          <td><a href="<?= Yii::app()->request->baseUrl ?>/users/OrderDetails/id/<?=  $order->id  ?>"><i class="fa fa-eye"></i></a></td>
<!--          <td><a href="<?php  // echo Yii::app()->request->baseUrl; ?>/users/deleteOrder/id/<?php // echo $order->id; ?>" onclick="return confirm('Do you want delete this Order : <?php // echo  $order->id ?>?')"><i class="fa fa-trash-o"></i></a></td>-->
          
      <?php 
      $count++;
} ?>
          
        </tr>
      </tbody>
    </table>
    </div>
</div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->



</div>
</div>
