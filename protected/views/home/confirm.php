<div class="row">

<div class="col-md-12">
<ol class="breadcrumb">
      <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>">Home</a></li>
      <li class="active">Messages</li>
    </ol>
    
    </div>



<div class="col-md-12">
<div class="col-md-12 contact static confirm-box">


<div class="col-md-12">
<i class="col-md-1"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/confirm-icon.png" alt="" /></i>
<?php if($flag==1){ ?>
<p class="confirm col-md-11">Thank you for registering, a confirmation e-mail was sent to the e-mail you provided. Please activate your account to be able to login. 
</p>
<?php } ?>
<?php if($flag==2){ ?>
<p class="confirm col-md-11">Please check your email to activate your account. 
</p>
<?php } ?>
<?php if($flag==3){ ?>
<p class="confirm col-md-11">Please Login first. 
</p>
<?php } ?>


<?php if($flag==4){ ?>
<p class="confirm col-md-11"> Thank you for completing the payment of monthly fee subscribe  now you can enjoy all your package features.<br/>
</p>
<?php } ?>


<?php if($flag==5){ ?>
<p class="confirm col-md-11"> Payment process is cancelled, please try again.<br/>
</p>
<?php } ?>



<?php if($flag==6){ ?>
<p class="confirm col-md-11"> Your subscribed period is finished, You can pay to renew your package.<br/>
</p>
<?php } ?>

<?php if($flag==8){ ?>
<p class="confirm col-md-11"> Your subscribed period is finished, You can pay to renew your package.<br/>
</p>
  <div class="form-group">
<div class="col-md-8 col-md-offset-4">
  <button class="btn btn-default register-bt" onclick="window.location.href='/users/services'">Upgrade your package</button>
</div>
</div>
  
   <div class="form-group">
<div class="col-md-8 col-md-offset-4">

    <button class="btn btn-default register-bt" onclick="window.location.href='/users/checkout'">Checkout to pay now</button>
</div>
</div>
<?php } ?>

<?php if($flag==9){ ?>
<p class="confirm col-md-11"> Please check your email. It will have a link to reset your password.<br/>
</p>
<?php } ?>

<?php if($flag==10){ ?>
<p class="confirm col-md-11"> Your password has been reset correctly, please login with your new credentials.<br/>
</p>
<?php } ?>

<?php if($flag==11){ ?>
<p class="confirm col-md-11"> Payment process  has been done successfully, please check your orders in your dashboard.<br/>
</p>
<?php } ?>
</div>



</div><!--end static-->

</div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor');?>
<!--end appear-->



</div>
</div>
