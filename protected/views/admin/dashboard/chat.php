<?php
$this->pageTitle = Yii::app()->name . ' - Chat';
?>
 <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
<iframe src="<?php echo Yii::app()->getBaseUrl(true)."/admin/dashboard/loadiframe"; ?>"  width="1000" height="700" frameborder="0"></iframe>
<!--<script>

$(function(){ 
   $(document).ajaxStart(function() {
console.log( "Triggered ajaxStart handler." );
$.ajax({
        url: '<?php echo Yii::app()->createUrl('users/newwindow'); ?>',
        type:'post',
       // data: "id="+file_id,
       
        success: function (data) {
            //alert(data);
   
            console.log(data);
        //  $(".modal-content").html(data);  	
					
                    
        }
}); 
}); 
});
</script>-->