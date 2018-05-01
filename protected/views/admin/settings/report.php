<?php
$this->breadcrumbs = array(
    'Stores' => array('index'),
    'Manage',
);

$this->menu = array(

);

?>

<h1>See Reports </h1>


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'store-grid',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'columns' => array(
        'email',
        'page',
        'message',
        'date_create',

    ),
));
?>
