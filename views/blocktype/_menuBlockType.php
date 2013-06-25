<?php $this->menu['index'] = array(
	'label' => Yii::t('core', 'Manage Block Types'),
	'url'   => array('index'),
	'visible' => Yii::app()->user->checkAccess('core/blocktype/index'),
);
$this->menu['create'] = array(
	'label' => Yii::t('core', 'Create Block Type'),
	'url'   => array('create'),
	'visible' => Yii::app()->user->checkAccess('core/blocktype/create'),
);