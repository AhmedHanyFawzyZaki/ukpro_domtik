<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2013
 */

class HtmlHelper
 {
 	/**
 	 * Helper::HtmlPageLink()
 	 *
 	 * @param mixed $page_id
 	 * @param mixed $class
 	 * @return
 	 */
 	public static function HtmlPageLink($page_id, $class='')
 	{
 		$page= Pages::model()->findByPk($page_id);
 		if($page  === null)
 		{
 			return 'Not-Found';
 		}

 		$page_link = 'home/page/view/'.$page->url;

 		return '<a href="'.Yii::app()->getBaseUrl(true)."/". $page_link.'">'.$page->title.'</a>';
 	}
  }
?>