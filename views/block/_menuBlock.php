<?php 
$this->menu['index'] = array(
	'label' => Yii::t('core', 'Manage Block'),
	'url'   => array('index'),
	'visible' => Yii::app()->user->checkAccess('core/block/index'),
);
$this->menu['create'] = array(
	'label' => Yii::t('core', 'Create Block'),
	'url'   => array('create'),
	'visible' => Yii::app()->user->checkAccess('core/block/create'),
);
?>