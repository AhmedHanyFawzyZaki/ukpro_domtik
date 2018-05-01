<div class="row">

<div class="col-md-12">
<ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li class="active">static</li>
    </ol>
    
    </div>



<div class="col-md-12">
<div class="col-md-12 contact static">
<p class="title"><?= $pages->title ?></p>

<div class="col-md-8 col-md-offset-2 static-img">
<img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/<?php echo $pages->image; ?>" alt="" />

</div><!--end static-img-->

<div class="col-md-12">
<p><p><?= $pages->details ?></p></p>

</div>



</div><!--end static-->

</div>

</div>


<!--appear-->
<?php $this->renderpartial('../home/sponsor');?>
<!--end appear-->


</div>
</div>