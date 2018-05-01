<div class="tiles-container  m-b-20">
    <div class="tiles white p-t-20 p-l-15 p-r-15 p-b-30">
        <h2 class="">Update  Item <span class="semi-bold text-success"><i class=""><?php echo $model->name; ?></i></span></h2>
        <!--            <h4 class="text-center muted m-l-10 m-r-10">The talent of success is nothing more than doing 
                      what you can do, well. </h4>-->
        <div id="pageAlerts"></div>

         <div class="tree-form">
        <?php  echo $this->renderPartial('_form', array('model' => $model)); ?>
         </div>
    </div>
</div>
