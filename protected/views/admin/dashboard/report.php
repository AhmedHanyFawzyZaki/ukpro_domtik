<?php
if($flag==1)
{
$this->breadcrumbs = array(
    'Products' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'The most selling products', 'url' => array('productreport')),
    array('label' => 'The most buying users', 'url' => array('buyerreport')),
    array('label' => 'The non buying users', 'url' => array('/admin/dashboard/buyerreport/not_buy/1')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php 
 $this->pageTitlecrumbs = 'The most selling products';
?>
<div class="summary pull-right">Total <?= count($products) ?> results.</div>
<table class="items table">
    <thead>
        <tr>
            <th id="product-grid_c0">Product Name</th>
            <th id="product-grid_cuser_id">Owner</th>
            <th id="product-grid_ccategory_id">Website Category</th>
            <th id="product-grid_c1">Price</th>
            <th id="product-grid_c2">Main Image</th>
            <th id="product-grid_c3" class="button-column"> </th>
        </tr>
    </thead>
    <tbody class="ui-sortable">
        <?php foreach ($products as $product) {
            ?>    
            <tr class="odd" data-id="782">
                <td><?= $product->title ?></td>
                <td><?= $product->user->username ?></td>
                <td><?= $product->category->title ?></td>
                <td><?= $product->price ?></td>

                <td>
                    <?php if ($product->flag == 1) { ?>
                        <img width="130" alt="" src="<?= $product->main_image ?>">
                    <?php } else { ?>
                        <img width="130" alt="" src="<?= Yii::app()->baseurl . '/media/product/' . $product->main_image ?>">
                    <?php } ?>
                </td>
                <td class="button-column">
                    <a class="view" href="<?= Yii::app()->baseurl . '/admin/product/view/id/' . $product->id ?>" rel="tooltip" title="" data-original-title="View">
                        <i class="icon-eye-open"></i>
                    </a>
                    <a class="update" href="<?= Yii::app()->baseurl . '/admin/product/update/id/' . $product->id ?>" rel="tooltip" title="" data-original-title="Update">
                        <i class="icon-pencil"></i>
                    </a>
                    <a class="delete" href="<?= Yii::app()->baseurl . '/admin/product/delete/id/' . $product->id ?>" rel="tooltip" title="" data-original-title="Delete">
                        <i class="icon-trash"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php }else { 
    
$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'The most selling products', 'url' => array('productreport')),
    array('label' => 'The most buying users', 'url' => array('buyerreport')),
    array('label' => 'The non buying users', 'url' => array('/admin/dashboard/buyerreport/not_buy/1')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<?php 
if($_REQUEST['not_buy']==1) $this->pageTitlecrumbs = 'The non buying users';
else $this->pageTitlecrumbs = 'The most buying users';
?>
<div class="summary pull-right">Total <?= count($products) ?> results.</div>
<table class="items table">
    <thead>
        <tr>
            
            <th id="product-grid_c0">Username</th>
            <th id="product-grid_cuser_id">Email</th>
            <th id="product-grid_ccategory_id">First name</th>
            <th id="product-grid_c1">Last name</th>
            <th id="product-grid_c2">Account Type</th>
            <th id="product-grid_c2">Image</th>
            <th id="product-grid_c3" class="button-column"> </th>
        </tr>
    </thead>
    <tbody class="ui-sortable">
        <?php foreach ($products as $product) {
            ?>    
            <tr class="odd" data-id="782">
                <td><?= $product->username ?></td>
                <td><?= $product->email ?></td>
                <td><?= $product->fname ?></td>
                <td><?= $product->lname ?></td>
                <td><?= $product->usergroup->group_title ?></td>

                <td>
                        <img width="130" alt="" src="<?= Yii::app()->baseurl . '/media/member/' . $product->image ?>">
                   
                </td>
                <td class="button-column">
                    <a class="view" href="<?= Yii::app()->baseurl . '/admin/user/view/id/' . $product->id ?>" rel="tooltip" title="" data-original-title="View">
                        <i class="icon-eye-open"></i>
                    </a>
                    <a class="update" href="<?= Yii::app()->baseurl . '/admin/user/update/id/' . $product->id ?>" rel="tooltip" title="" data-original-title="Update">
                        <i class="icon-pencil"></i>
                    </a>
                    <a class="delete" href="<?= Yii::app()->baseurl . '/admin/user/delete/id/' . $product->id ?>" rel="tooltip" title="" data-original-title="Delete">
                        <i class="icon-trash"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>