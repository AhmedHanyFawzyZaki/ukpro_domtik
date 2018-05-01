

<div class="row items">
<?php 
//print_r($response);die;
?>


    <form method="post" name="comm_form" action="<?php echo Yii::app()->getBaseUrl(true) . "/users/savecomm" ?>" >

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
        
        
        <input type="hidden" name="category" value="<?php echo $category ?>"/>
        <input type="hidden" name="country" value="<?php echo $country ?>"/>
        <input type="hidden" name="search_value" value="<?php echo $search_value ?>"/>

        <?php
         $products = $products['products']['product'];
//         echo '<pre>';
//         print_r($prods);echo '<pre>';
//         die;
        for ($i = 0; $i < sizeof($products); $i++) {
            $item = $products[$i];
            ?>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12 amazon item-box">
                    <input type="checkbox" name="check[]" class="checkk" value="<?php echo $item['ad-id'] ?>" />
                    <input type="hidden" name="ad_id[]" value="<?php echo $item['ad-id'] ?>"/>
                    <div class="col-md-12 col-sm-12 col-xs-12 item-img amazon-img">
                        <a target="_blank" class="prod-img" href="<?php echo $item['buy-url']; ?>"><img alt="" src="<?php echo $item['image-url'] ?>"></a>



                    </div>

                    <div class="item-info amazon-info">
                        <span class="item-name"><a target="_blank" href="<?php echo $item['buy-url']; ?>"><?php echo $item['description'] ?></a></span>
                        <!--<span class="item-categ"><a href="/projects/2014/domtik/realstate">REAL STATE</a></span>-->
                        <span class="item-price"><?php echo $item['manufacturer-sku']['price'] ?></span>
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