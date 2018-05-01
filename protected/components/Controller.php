<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        
            /**
     * Performs the AJAX validation.
     * @param $model the model to be validated
     * @param $fromId the form id to be validated
     */
    protected function performAjaxValidation($model, $fromId) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === $fromId) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
        
        
}