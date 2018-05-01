<?php
// set the page title
$this->pageTitle = Yii::app()->name . ' - FAQ';
?>
<div class="row">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a></li>
            <li class="active">FAQ</li>
        </ol>

    </div>



    <div class="col-md-12">
        <div class="col-md-12 contact faq">

            <?php 
           // print_r($faqcats);
            foreach ($faqcats as $faqcat) { ?>
                <p class="title"><?php echo $faqcat->title ?></p>
                <?php
                $criteria = new CDbCriteria;
                $criteria->condition = 'cat_id=:CatID and active=1';
                $criteria->params = array(':CatID' => $faqcat->id);
                $facs = Faq::model()->findAll($criteria);
                foreach ($facs as $fac) {
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapse<?php echo $fac->id; ?>" data-parent="#accordion" data-toggle="collapse" class="">
                                    <?php echo $fac->quest; ?>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse<?php echo $fac->id; ?>" style="">
                            <div class="panel-body">
                                <?php echo $fac->answer; ?>                            
                            </div>
                        </div>
                    </div>
                <?php }
            }
            ?>


            <!--end static-->

        </div>

    </div>

</div>

    <!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
    <!--end appear-->
</div>
</div>