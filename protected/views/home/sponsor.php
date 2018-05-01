<div class="row appear">
<p class="title1">we appear in</p>
<img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/heading-border.png" alt="" width="1088" />
<ul class="appear-links">
    <?php
    $sponsers = Sponsor::model()->findAll(array('limit'=>'12'));
    if($sponsers){
        foreach($sponsers as $sponser){ ?>
            <li><a href="<?php $sponser->url; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/sponsors/<?= $sponser->image; ?>" alt="<?=$sponser->title;?>" /></a></li>
        <?php    
        }
    }
    ?>
</ul>

</div><!--end appear-->