<!--

<?php //$item = $response->Items->Item[0]; ?>
<a href="<?php echo $item->DetailPageURL ?>" target="_blank"><h1><?php echo $item->ItemAttributes->Title ?></h1></a>
 <h3>label <?php echo $item->ItemAttributes->Label ?></h3>
ASIN<p><?php echo $item->ASIN ?></p>

Artist<p><?php echo $item->ItemAttributes->Artist ?></p>
Binding<p><?php echo $item->ItemAttributes->Binding ?></p>
Brand<p><?php echo $item->ItemAttributes->Brand ?></p>
Price<p><?php echo $item->ItemAttributes->ListPrice->FormattedPrice ?></p>
Manufacturer<p><?php echo $item->ItemAttributes->Manufacturer ?></p>
PackageQuantity<p><?php echo $item->ItemAttributes->PackageQuantity ?></p>
ProductGroup<p><?php echo $item->ItemAttributes->ProductGroup ?></p>
ProductTypeName<p><?php echo $item->ItemAttributes->ProductTypeName ?></p>
Publisher<p><?php echo $item->ItemAttributes->Publisher ?></p>

<img src="<?php echo $item->LargeImage->URL ?>" />
<img src="<?php echo $item->MediumImage->URL ?>" />
<img src="<?php echo $item->SmallImage->URL ?>" />
-->


<div class="row items">



    <form method="post" name="amazon_form" action="<?php echo Yii::app()->getBaseUrl(true) . "/users/saveAmazon" ?>" >

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
        for ($i = 0; $i < sizeof($response->Items->Item); $i++) {
            $item = $response->Items->Item[$i];
            ?>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12 amazon item-box">
                    <input type="checkbox" name="check[]"  value="<?php echo $item->ASIN ?>"/>
                    <input type="hidden" name="asin[]" value="<?php echo $item->ASIN ?>"/>
                    <div class="col-md-12 col-sm-12 col-xs-12 item-img amazon-img">
                        <a target="_blank" class="prod-img" href="<?php echo $item->DetailPageURL ?>"><img alt="Product 2" src="<?php echo $item->LargeImage->URL ?>"></a>



                    </div>

                    <div class="item-info amazon-info">
                        <span class="item-name"><a target="_blank" href="<?php echo $item->DetailPageURL ?>"><?php echo $item->ItemAttributes->Title ?></a></span>
                        <!--<span class="item-categ"><a href="/projects/2014/domtik/realstate">REAL STATE</a></span>-->
                        <span class="item-price"><?php echo $item->ItemAttributes->ListPrice->FormattedPrice ?></span>
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

