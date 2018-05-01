
<div class="row items">
<?php 
//print_r($response);die;
?>


    <form method="post" name="affilate_form" action="<?php echo Yii::app()->getBaseUrl(true) . "/users/saveAffilate" ?>" >

        <div class="clearfix"></div>
        
        <div class="col-md-12 col-sm-12 col-xs-12">
            
            
            
            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 amazon-form">

                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Category:</label>
                    <div class="col-md-6 col-sm-7 col-xs-12">

                        <select class="form-control" name="main_category">

                            <?php foreach ($cats as $cat) {
                                ?>
                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->title ?></option>
                            <?php }
                            ?>
                        </select> 

                    </div>
                </div>

                <div class="clearfix" style="margin: 10px 0;"></div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Owner:</label>
                    <div class="col-md-6 col-sm-7 col-xs-12">

                        <select class="form-control" name="seller">

                            <?php foreach ($sellers as $seller) {
                                ?>
                                <option value="<?php echo $seller->id; ?>"><?php echo $seller->username ?></option>
                            <?php }
                            ?>
                        </select> 

                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3"></label>
                    <div class="col-md-6 col-sm-7 col-xs-12">
                        <input type="submit" class="btn btn-default register-bt" value="save" name="submit">
                    </div>
                </div>

            </div><!--end item-box-->
        </div>
        
        
        <input type="hidden" name="category" value="<?php echo $category ?>"/>
        <input type="hidden" name="country" value="<?php echo $country ?>"/>
        <input type="hidden" name="search_value" value="<?php echo $search_value ?>"/>

        <?php
         $products = $response->oProduct;
        for ($i = 0; $i < sizeof($products); $i++) {
            $item = $products[$i];
            ?>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12 amazon item-box">
                    <input type="checkbox" name="check[]" class="checkk" value="<?php echo $item->iId ?>" />
                    <input type="hidden" name="iId[]" value="<?php echo $item->iId ?>"/>
                    <div class="col-md-12 col-sm-12 col-xs-12 item-img amazon-img">
                        <a target="_blank" class="prod-img" href="<?php echo $item->sAwDeepLink; ?>"><img alt="Product 2" src="<?php echo $item->sAwThumbUrl ?>"></a>



                    </div>

                    <div class="item-info amazon-info">
                        <span class="item-name"><a target="_blank" href="<?php echo $item->sAwDeepLink; ?>"><?php echo $item->sName ?></a></span>
                        <!--<span class="item-categ"><a href="/projects/2014/domtik/realstate">REAL STATE</a></span>-->
                        <span class="item-price"><?php echo $item->fPrice ?></span>
                    </div><!--end item-info-->

                </div><!--end item-box-->
            </div>
        <?php } ?>



    </form>


</div>
</div>


<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->



<script>
//$(function(){
//    $(".checkk").click(function(){
//          if($(this).is(":checked")){
//              $(this).val('1');
//          }else{
//               $(this).val('0');
//          } 
//    })
// 
//});
</script>