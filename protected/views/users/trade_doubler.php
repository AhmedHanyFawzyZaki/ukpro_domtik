
<div class="row items">



    <form method="post" name="trade_form" action="<?php echo Yii::app()->getBaseUrl(true) . "/users/saveTradeDoubler" ?>" >

        <div class="clearfix"></div>
        
        <div class="col-md-12 col-sm-12 col-xs-12">
            
            
            
            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 amazon-form">

               <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Category:</label>
                    <div class="col-md-6 col-sm-7 col-xs-12">

                        <select class="form-control" name="main_category" id="main_category">
                            <option value="">select category</option>
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
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Product Category:</label>
                    <div class="col-md-6 col-sm-7 col-xs-12">

                     <select class="form-control" name="pro_category" id="pro_category">

                                
                        </select> 

                    </div>
                    
                       
                </div>

                 <div class="clearfix" style="margin: 10px 0;"></div>

                 
                 <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Sub Category:</label>
                    <div class="col-md-6 col-sm-7 col-xs-12">

                   <select class="form-control" name="sub_category" id="sub_category">

                             
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
        
        
        <input type="hidden" name="tdCategoryId" value="<?php echo $tdCategoryId ?>"/>
        <input type="hidden" name="search_value" value="<?php echo $search_value ?>"/>

        <?php
        for ($i = 0; $i < sizeof($products); $i++) {
            $item = $products[$i];
//            print_r($item);die;
            ?>

           <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12 amazon item-box">
                    <input type="checkbox" name="check[]"  value="<?php echo $item['offers'][0]['id']  ?>"/>
                    <input type="hidden" name="asin[]" value="<?php echo $item['offers'][0]['id'] ?>"/>
                    <div class="col-md-12 col-sm-12 col-xs-12 item-img amazon-img">
                        <a target="_blank" class="prod-img" href="<?php echo $item['offers'][0]['productUrl'] ?>"><img alt="Product 2" src="<?php echo $item['productImage']['url'] ?>"></a>



                    </div>
<?php // $fields = $item['fields'] ?>
                    <div class="item-info amazon-info">
                        <span class="item-name"><a target="_blank" href="<?php echo $item['offers'][0]['productUrl'] ?>"><?php echo $item['name'] ?></a></span>
<!--                        <span class="item-categ"><a href="/projects/2014/domtik/realstate">REAL STATE</a></span>-->
                        <span class="item-price"><?php echo $item['offers'][0]['priceHistory'][0]['price']['value'].' '.$item['offers'][0]['priceHistory'][0]['price']['currency'] ?></span>
                    </div>

                </div>
            </div>
        <?php } ?>



    </form>


</div>
</div>


<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->





<script>
$(function(){
//    $(".checkk").click(function(){
//          if($(this).is(":checked")){
//              $(this).val('1');
//          }else{
//               $(this).val('0');
//          } 
//    })
// 

$("#main_category").change(function(){
 var cat_id = $(this).val();
  $.ajax({
        url: '<?php echo Yii::app()->createUrl('users/getProCats'); ?>',
        type:'post',
        data: "cat_id="+cat_id,
       
        success: function (data) {
            //alert(data);
   
            console.log(data);
          $("#pro_category").html(data);  	
					
                    
        }
}); 
 
});



$(document).on('change',"#pro_category",function(){
 var procat_id = $(this).val();
  $.ajax({
        url: '<?php echo Yii::app()->createUrl('users/getSubCats'); ?>',
        type:'post',
        data: "procat_id="+procat_id,
       
        success: function (data) {
            //alert(data);
   
            console.log(data);
          $("#sub_category").html(data);  	
					
                    
        }
}); 
 
});

});
</script>