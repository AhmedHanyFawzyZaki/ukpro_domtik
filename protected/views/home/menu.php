<div class="col-md-3 col-sm-4 col-xs-12">





    <div class="profile-img">
        <?php if (!empty($user->image)) { ?>
            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/members/<?php echo $user->image ?>" alt="<?php echo $user->fname . ' ' . $user->lname; ?>" />
        <?php } else { ?>
            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/profile-img.png" alt="<?php echo $user->fname . ' ' . $user->lname; ?>" />
        <?php } ?>
        <?php if (Yii::app()->controller->action->id == 'editprofile') { ?>
            <!--
          <a onclick="myFunction()" class="cam-bt" href="javascript:void(0)"><img src="img/cam-icon.png" alt="" /></a>
          <input type="file" name="User[image]" accept="image/*" id="pp_uploader">
            -->
            <!--
            <a onclick="myFunction()" class="upload-img" href="javascript:void(0)">Upload image</a>
            <input type="file" name="User[image]" accept="image/*" id="pp_uploader">-->
        <?php } ?>
    </div><!--end profile-img-->

    <ul style="max-width: 300px;" class="nav nav-pills nav-stacked profile-menu">

        <li><a href="<?= Yii::app()->request->baseUrl ?>/users/<?php if (Yii::app()->controller->action->id == 'editprofile') {
            echo "dashboard";
        } else {
            echo "editprofile";
        } ?>"><i class="fa fa-eye"></i><?php if (Yii::app()->controller->action->id == 'editprofile') {
            echo "Profile Details";
        } else {
            echo "Edit Profile";
        } ?></a></li>
        <?php if ($user->groups_id == 1 or $user->groups_id == 4) { ?>
            <li><a href="<?= Yii::app()->request->baseUrl ?>/users/addproduct"><i class="fa fa-plus-circle"></i>add product</a></li>
            <li><a href="<?= Yii::app()->request->baseUrl ?>/users/allproduct"><i class="fa fa-reorder"></i>all products</a></li>
<?php } ?>

<?php if ($user->groups_id == 3) { ?>  
            <li><a href="<?= Yii::app()->request->baseUrl ?>/users/Order"><i class="col-md-12 col-xs-12"></i>Orders</a></li>
    <?php
} else {
    ?>

            <li><a href="#order" data-parent="#accordion" data-toggle="collapse" class="collapsed"> 
                    <i class="fa fa-reorder"></i>Orders <span class="caret"></span></a>

                <div class="panel-collapse collapse shipping-collaps" id="order" style="height: 0px;">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/users/SellerOrders" class="col-md-12 col-xs-12">Required Orders</a>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/users/buyerorders" class="col-md-12 col-xs-12">My  Orders</a>

                </div>  
            </li>

    <?php }
?>
<?php if ($user->groups_id == 1 or $user->groups_id == 4) { ?>

            <li><a href="#shipping" data-parent="#accordion" data-toggle="collapse" class="collapsed">

                    <i class="fa fa-reorder"></i>manage shipping <span class="caret"></span></a>



                <div class="panel-collapse collapse shipping-collaps" id="shipping" style="height: 0px;">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/users/allshipping" class="col-md-12 col-xs-12">all shipping</a>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/users/addShippingValue" class="col-md-12 col-xs-12">add shipping</a>

                </div>  
            </li>
<?php } ?>

        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/favorites"><i class="fa fa-heart-o"></i>My favorites</a></li>

        <li><a href="#message" data-parent="#accordion" data-toggle="collapse" class="collapsed">

                <i class="fa fa-reorder"></i>Messages <span class="caret"></span></a>



            <div class="panel-collapse collapse shipping-collaps" id="message" style="height: 0px;">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/users/receivedMessage" class="col-md-12 col-xs-12">Inbox</a>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/users/sendmessage" class="col-md-12 col-xs-12">OutBox</a>
                 <a href="<?php echo Yii::app()->request->baseUrl; ?>/users/chat" class="col-md-12 col-xs-12">Chat With Admin</a>

            </div>  
        </li>



    </ul>



</div>

<script>
    function myFunction() {
        $('#pp_uploader').click();
    }
</script>