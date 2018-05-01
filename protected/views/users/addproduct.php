<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
?>



 <!-- Join Modal -->
                <div class="modal popup fade" id="xml-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Xml</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/fetchFromMyXml" ?>" enctype='multipart/form-data'>
<?php 

$cats = Category::model()->findAll();
?>
     <select class="form-control" name="category" required>
         <option value="">select Category</option>
         <?php
foreach ($cats as $cat){
    ?>
         <option value="<?php echo $cat->id; ?>"> <?php echo $cat->title; ?></option>
         <?php
}
         ?>
     </select>
     
     <select class="form-control" name="seller">
                    
                    <?php foreach ($sellers as $seller){
                        ?>
                    <option value="<?php echo $seller->id; ?>"><?php echo $seller->username ?></option>
                    <?php
                    } ?>
                </select> 
            <input type="file" name="xmlfile" class="filename" required />
            <input type="submit" value="upload" name="upload" class="form-submit"/>
                            </form>
      
      <a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadXml" ?>">Download Xml Guide</a>

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->


                
                
                
 <!-- Join Modal -->
                <div class="modal popup-e fade" id="excel-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Excel</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/fetchFromExcel" ?>" enctype='multipart/form-data'>

            <input type="file" name="excelfile" class="filename" required />
            <input type="submit" value="upload" name="uploadexcel" class="form-submit"/>
                            </form>
      
      <a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadExcel" ?>">Download Excel Guide</a>

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
                
                
                
              <!-- Join Modal -->
                <div class="modal popup-e fade" id="csv-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Excel Or Csv</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/fetchFromMyCsv" ?>" enctype='multipart/form-data'>

     <?php 

$cats = Category::model()->findAll();
?>
     <select class="form-control" name="category" required>
         <option value="">select Category</option>
         <?php
foreach ($cats as $cat){
    ?>
         <option value="<?php echo $cat->id; ?>"> <?php echo $cat->title; ?></option>
         <?php
}
         ?>
     </select>
     
     <select class="form-control" name="seller">
                    
                    <?php foreach ($sellers as $seller){
                        ?>
                    <option value="<?php echo $seller->id; ?>"><?php echo $seller->username ?></option>
                    <?php
                    } ?>
                </select> 
            <input type="file" name="csvfile" class="filename" required />
            <input type="submit" value="upload" name="uploadecsv" class="form-submit"/>
                            </form>
      
      <a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadCsv" ?>">Download Csv Guide</a>

      <a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadExcel" ?>">Download Excel Guide</a>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->   
                
                
                
                
       <!-- Join Modal -->
                <div class="modal popup fade" id="amazon-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Amazon</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/testAmazon" ?>" enctype='multipart/form-data'>
<div class="form-group">
     <input type="text"  name="search_value" placeholder="Search" class="form-control"/>
</div>
     
     <div class="form-group">
     <select id="category" name="category" class="form-control">
      <option value="Blended">ALL</option>
      <option value="Books">Books</option>
      <option value="DVD">DVD</option>
      <option value="Apparel">Apparel</option>
      <option value="Automotive">Automotive</option>
      <option value="Electronics">Electronics</option>
      <option value="GourmetFood">GourmetFood</option>
      <option value="Kitchen">Kitchen</option>
      <option value="Music">Music</option>
      <option value="PCHardware">PCHardware</option>
      <option value="PetSupplies">PetSupplies</option>
      <option value="Software">Software</option>
      <option value="SoftwareVideoGames">SoftwareVideoGames</option>
      <option value="SportingGoods">SportingGoods</option>
      <option value="Tools">Tools</option>
      <option value="Toys">Toys</option>
      <option value="VHS">VHS</option>
      <option value="VideoGames">VideoGames</option>
    </select>
     </div>
    
     <div class="form-group">
     <select id="country" name="country" class="form-control">
      <option value="de">DE</option>
      <option value="com">USA</option>
      <option value="co.uk">ENG</option>
      <option value="ca">CA</option>
      <option value="fr">FR</option>
      <option value="co.jp">JP</option>
      <option value="it">IT</option>
      <option value="cn">CN</option>
      <option value="es">ES</option>
    </select>
     </div>
     
     
<!--     <div class="form-group">
     <input type="text" name="browse_search" class="form-control"  placeholder="Browse Search"/>
</div>            -->
<!--<input type="file" name="xmlfile" class="filename" required />-->
            <input type="submit" value="search" name="upload" class="form-submit"/>
                            </form>
      
      <!--<a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadXml" ?>">Download Xml Guide</a>-->

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
          
                
                
       <!-- Join Modal -->
                <div class="modal popup fade" id="affiliate-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">affiliate window</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/affiliateWindow" ?>" enctype='multipart/form-data'>
<div class="form-group">
     <input type="text"  name="search_value" placeholder="Search" class="form-control"/>
</div>
     

     
<!--     <div class="form-group">
     <input type="text" name="browse_search" class="form-control"  placeholder="Browse Search"/>
</div>            -->
<!--<input type="file" name="xmlfile" class="filename" required />-->
            <input type="submit" value="search" name="upload" class="form-submit"/>
                            </form>
      
      <!--<a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadXml" ?>">Download Xml Guide</a>-->

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
                
                
                
                
       <!-- Join Modal -->
                <div class="modal popup fade" id="comm-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Commission Junction</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/junction" ?>" enctype='multipart/form-data'>
<div class="form-group">
     <input type="text"  name="search_value" placeholder="Search" class="form-control"/>
</div>
   
     
 
<!--     <div class="form-group">
     <select id="country" name="country" class="form-control">
      <option value="de">ar</option>
      <option value="com">bn</option>
      <option value="co.uk">zh</option>
      <option value="ca">cs</option>
      <option value="fr">da</option>
      <option value="co.jp">nl</option>
      <option value="it">en</option>
      <option value="cn">fi</option>
      <option value="es">fr</option>
      <option value="es">de</option>
      
      <option value="de">el</option>
      <option value="com">bn</option>
      <option value="co.uk">zh</option>
      <option value="ca">cs</option>
      <option value="fr">da</option>
      <option value="co.jp">nl</option>
      <option value="it">en</option>
      <option value="cn">fi</option>
      <option value="es">fr</option>
      <option value="es">de</option>
      
    </select>
     </div>-->
     
     
<!--     <div class="form-group">
     <input type="text" name="browse_search" class="form-control"  placeholder="Browse Search"/>
</div>            -->
<!--<input type="file" name="xmlfile" class="filename" required />-->
            <input type="submit" value="search" name="upload" class="form-submit"/>
                            </form>
      
      <!--<a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadXml" ?>">Download Xml Guide</a>-->

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
          
     
                

                
                
                 <!-- Join Modal -->
                <div class="modal popup fade" id="trade-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Trade Doubler</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/tradeDoubler" ?>" enctype='multipart/form-data'>
<div class="form-group">
     <input type="text"  name="search_value" placeholder="Search" class="form-control"/>
</div>
     
     <div class="form-group">
     <select id="category" name="tdCategoryId" class="form-control">
    <option value="">ALL</option>
    <?php foreach ($trade_cats as $trade_cat){
        ?>
      <option value="<?php echo $trade_cat['id'] ?>"><?php echo $trade_cat['name'] ?></option>
    
    <?php
    } ?>
      
    </select>
     </div>
     
  
     
    
   <!--   <div class="form-group">
     <select id="country" name="country" class="form-control">
     <option value="de">DE</option>
      <option value="com">USA</option>
      <option value="co.uk">ENG</option>
      <option value="ca">CA</option>
      <option value="fr">FR</option>
      <option value="co.jp">JP</option>
      <option value="it">IT</option>
      <option value="cn">CN</option>
      <option value="es">ES</option>
    </select>
     </div>-->
     
     
<!--     <div class="form-group">
     <input type="text" name="browse_search" class="form-control"  placeholder="Browse Search"/>
</div>            -->
<!--<input type="file" name="xmlfile" class="filename" required />-->
            <input type="submit" value="search" name="upload" class="form-submit"/>
                            </form>
      

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
          
                
                
                
                
                
                
                 <!-- Join Modal -->
                <div class="modal popup fade" id="zanox-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" style="width: 500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Zanox</h4>
                            </div>

                            <div class="modal-body">
 <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/zanox" ?>" enctype='multipart/form-data'>
<div class="form-group">
     <input type="text"  name="search_value" placeholder="Search" class="form-control"/>
</div>
     
     
        
     <div class="form-group">
     <input type="text"  name="min_price" placeholder="min price" class="form-control"/>
</div>
     
     <div class="form-group">
     <input type="text"  name="max_price" placeholder="max price" class="form-control"/>
</div>
     
<!--     <div class="form-group">
     <select id="category" name="category" class="form-control">
    <option value="">ALL</option>-->
    <?php // foreach ($zanox_cats as $zanox_cat){
//        $zanox_cat = (array)$zanox_cat;
        ?>
      <!--<option value="<?php echo $zanox_cat['@id'] ?>"><?php echo $zanox_cat['$'] ?></option>-->
    
    <?php
   // } ?>
      
<!--    </select>
     </div>-->
    
   <!--   <div class="form-group">
     <select id="country" name="country" class="form-control">
     <option value="de">DE</option>
      <option value="com">USA</option>
      <option value="co.uk">ENG</option>
      <option value="ca">CA</option>
      <option value="fr">FR</option>
      <option value="co.jp">JP</option>
      <option value="it">IT</option>
      <option value="cn">CN</option>
      <option value="es">ES</option>
    </select>
     </div>-->
     
     
<!--     <div class="form-group">
     <input type="text" name="browse_search" class="form-control"  placeholder="Browse Search"/>
</div>            -->
<!--<input type="file" name="xmlfile" class="filename" required />-->
            <input type="submit" value="search" name="upload" class="form-submit"/>
                            </form>
      

                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->
          
                
                
                
                
                
                
<!--  <div class="popup">
      <a href="#"  id="close" class="close-pop">X</a>         
        <form method="post" action="<?php echo Yii::app()->getBaseUrl(true)."/users/fetchFromXml" ?>" enctype='multipart/form-data'>

            <input type="file" name="xmlfile" class="filename" required=""/>
            <input type="submit" value="upload" name="upload" class="form-submit"/>
                            </form>
      
      <a target="_blank" class="download-link" href="<?php echo Yii::app()->getBaseUrl(true)."/users/downloadXml" ?>">Download Xml Guide</a>
                        </div>-->
<div class="row profile">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>
            <li class="active">Add Prodcut</li>
        </ol>

    </div>


  
    
    
    
    <div class="col-md-12 col-xs-12 profile-title">
        <p class="profile-name"><?php echo $user->username; ?></p>
    </div>
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'editprofile-form',
        'enableAjaxValidation' => false,
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'
        ),
    ));
    ?>

    <!--appear-->
    <?php $this->renderpartial('../home/menu', array('user' => $user)); ?>
    <!--end appear-->


    <div class="col-md-9 col-sm-8 col-xs-12">
        
       <?php  if (Yii::app()->user->hasFlash('add-error')) {
            ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('add-error'); ?>.
            </div>
        <?php } ?>
        <div class="info seller-profile">
            <p class="profile-name" data-toggle="modal" data-target="#xml-popup">add new item<span>
                        Upload with <a href="#" id="upload"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Xml</span></p>


<!--                        <p class="profile-name" data-toggle="modal" data-target="#excel-popup">add new item<span>
                        Upload With<a href="#" id="upload"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Excel</span></p>-->

                         <p class="profile-name" data-toggle="modal" data-target="#csv-popup">add new item<span>
                        Upload With<a href="#" id="upload"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Csv or Excel</span></p>

                        
                        
                        <p class="profile-name" data-toggle="modal" data-target="#amazon-popup">add new item<span>
                        Upload With<a href="#" id="upload-amazon"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Amazon</span></p>

                         <p class="profile-name" data-toggle="modal" data-target="#affiliate-popup">add new item<span>
                        Upload With<a href="#" id="upload-Affiliate"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Affiliate Window</span></p>


                        
                         <p class="profile-name" data-toggle="modal" data-target="#comm-popup">add new item<span>
                        Upload With<a href="#" id="upload-comm"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Commission Junction</span></p>


                         <p class="profile-name" data-toggle="modal" data-target="#trade-popup">add new item<span>
                        Upload With<a href="#" id="upload-trade"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Trade Doubler</span></p>

        
                          <p class="profile-name" data-toggle="modal" data-target="#zanox-popup">add new item<span>
                        Upload With<a href="#" id="upload-trade"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Zanox</span></p>

<?php //echo $form->error($model); ?>
            <div class="form-group">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">category:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                    <?php echo $form->dropDownList($model, 'category_id', CHtml::listData(Category::model()->findAll(), 'id', 'title'), array(
                        'prompt' => 'Select Category', 'class' => 'form-control', 'id' => 'cat', 'required' => 'required'));
                    ?>
                    <?php echo $form->error($model, 'category_id'); ?>
                </div>
            </div>


            <div class="form-group" style="display:none"id="protype">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Type:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                    <p><?php echo $form->dropDownList($model, 'type', array("0" => "product","1" => "service"), array('class' => 'form-control', 'id' => 'type')); ?></p>
                       <?php echo $form->error($model, 'type'); ?>
                </div>
            </div>
                        
                        
<!--                         <div class="form-group" style="display:none"id="protype2">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Type:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                    <p><?php echo $form->dropDownList($model, 'type', array("1" => "service"), array('class' => 'form-control', 'id' => 'type')); ?></p>
                       <?php echo $form->error($model, 'type'); ?>
                </div>
            </div>-->



            <div class="form-group">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Product name:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                    <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'required' => 'required')); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>
            </div>



<div class='form-group'>
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Upload Image :</label>

    <div class='col-md-6 col-sm-7 col-xs-12'>
            <?php echo $form->fileField($model, 'main_image', array('class' => 'span5', 'maxlength' => 255)); ?>

        <?php
        if ($model->isNewRecord != '1' and $model->main_image != '') {
            ?>

            <div class="control-group ">

                <div class="">
                    <?php
                    if($model->flag !=1){
                    echo "<p id='image-cont'>" . Chtml::image(Yii::app()->baseUrl . '/media/product/' . $model->main_image, '', array('width' => 200)) . "</p>";
                   
                    }else{
                      echo "<p id='image-cont'>" . Chtml::image($model->main_image, '', array('width' => 200)) . "</p>";
                      
                    }
                    echo CHtml::ajaxLink(
                            'Delete Image', array('/admin/product/deleteimage/id/' . $model->id), array(
                        'success' => 'function(data){
                                                     //var obj = jQuery.parseJSON(data);
                                                     if(data =="done"){
                                                        document.getElementById("image-cont").innerHTML=" Image Deleted";
                                                    }
                                            }'
                            ), array('class' => 'left0px')
                    );
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>




            <div class="form-group">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">price:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                   <?php echo $form->textField($model, 'price', array('class' => 'form-control', 'required' => 'required','append' => 'GBP')); ?>
                   <?php echo $form->error($model, 'price'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">description:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                  <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'required' => 'required')); ?>
                  <?php echo $form->error($model, 'description'); ?>
                </div>
            </div>

            <div class="form-group" id="quant" style="display:none">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">quantity:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                  <?php echo $form->textField($model, 'quantity', array('class' => 'form-control', 'placeholder' => 'Quantity')); ?>
                  <?php echo $form->error($model, 'quantity'); ?>
                </div>
            </div>



            <div class="form-group">
                <div class="col-md-offset-3 col-md-6 col-sm-6 col-sm-offset-6 col-xs-12 col-xs-offset-0">
<?php echo CHtml::submitButton('Next Step', array('class' => 'btn btn-default register-bt')); ?>
                </div>
            </div>

<?php $this->endWidget(); ?>




        </div><!--end info-->
    </div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->






</div>
</div>


<script>
    $("#cat").click(function() {
        // alert($(this).val());
        if ($(this).val() == 1 || $(this).val() == 4 || $(this).val() == 6 || $(this).val() == 7 || $(this).val() == 8)
        {
            // alert($(this).val());
            $("#quant").css('display', 'block');
            $("#protype").css('display', 'none');
           // $("#protype2").css('display', 'none');

        }

        if ($(this).val() == 3 || $(this).val() == 2 )
        {
            // alert($(this).val());
            $("#quant").css('display', 'none');
            $("#protype").css('display', 'none');
            // $("#protype2").css('display', 'none');

        }
        if ($(this).val() == 5  || $(this).val() == 10)
        {
            $("#protype").css('display', 'none');
          //    $("#protype2").css('display', 'block');

            // alert($(this).val());
            $("#quant").css('display', 'none');
        }
        
        
         if ($(this).val() == 9 )
        {
            $("#protype").css('display', 'block');
          //   $("#protype2").css('display', 'none');
             

            // alert($(this).val());
            //$("#quant").css('display', 'none');
        }
        
        

    });
    
    
$("#upload").click(function(){
$('.popup').fadeIn(300);
    });
    
    $("#upload_excel").click(function(){
$('.excel_popup').fadeIn(300);
    });
    
    
    $("#close").click(function(){
$('.popup').fadeOut(300);
    });

    
    
</script>
<script>
    $("#type").click(function() {
        //alert($(this).val());

        if ($(this).val() == 1)
        {
            $("#quant").css('display', 'none');

        }
        if ($(this).val() == 0)
        {
            $("#quant").css('display', 'block');

        }



</script>


<style>
        
    .popup{
/*       background: #CCC;
width: 401px;
height: 139px;
left: 37%;
top: 30%;
display: none;
position: absolute;
z-index: 11111111;*/
    }
    .filename{
        margin: 20px;
    }
    .form-submit{
        margin-left: 81px;
margin-top: 14px;
width: 229px;
    }
    .download-link{
        margin-left: 128px;
color: #2a6496;
    }
    .close-pop{
        float: right;
font-weight: bolder;
font-size: 25px;
margin-right: 15px;
    }
</style>