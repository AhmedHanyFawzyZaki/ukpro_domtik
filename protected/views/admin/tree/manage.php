<?php
//$this->breadcrumbs = array(
//    'Trees' => array('index'),
//    'Manage',
//);
//
//$this->menu = array(
//    array('label' => 'List Tree', 'url' => array('index')),
//    array('label' => 'Create Tree', 'url' => array('create')),
//);
?>

    <!--////////////-->
    <div class="col-md-12">
    <div class="grid simple">
        <div class="grid-body no-border"> <br>
            <div class="">
    <!--///////////////-->
    
    <div class="span6">
        <div class="grid simple">
            <div class="grid-body no-border">

                <div id="tree-view" style="background-color: '#EBF1FD'">
                    <?php
                    $this->widget('application.extensions.SimpleTreeWidget.SimpleTreeWidget', array(
                        'id' => 'simple-tree-widget',
                        'model' => 'Tree',
                        'modelPropertyParentId' => 'parent_id',
                        'modelPropertyPosition' => 'position',
                        'modelPropertyName' => 'name',
                        'rootTitle' => Tree::getTypeList($type),
                        'defaults' => "'field_type':'$type'",
                        'conditions' => "type='$type'",
                        'ajaxUrl' => Yii::app()->createUrl('admin/tree/simpleTree'),
                        'theme' => 'apple', //default,apple,classic
                        'onSelect' => 'if(data.inst.get_selected().attr("id")){
            var id = data.inst.get_selected().attr("id").replace("node_","");
            $("#tree-item-view").load("' . Yii::app()->createUrl('admin/tree/update/id') . '/"+id);
        }'
                    ));
                    ?>
                </div>
            </div></div></div>

    <div class="span6">
        <div class="grid simple">
            <!--            <div class="grid-title no-border">
                          <h4>Form <span class="semi-bold">Options</span></h4>
                          <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                        </div>-->
            <!--<div class="grid-body no-border">-->
                <div id="tree-item-view">
                    Click on any link of the tree at the left...
                </div>
        <!--</div>-->
            
    </div>
        
                </div>

    
    <!--/////////////////////-->
                </div></div></div></div>
    <!--////////////////////////-->
<!--</div>-->
                
             