<?php 
$this->menu['block/create'] = array(
	'label' => Yii::t('core', 'Create Block'),
	'url'   => array('create'),
	'visible' => Yii::app()->user->checkAccess('core/block/create'),
);
?>