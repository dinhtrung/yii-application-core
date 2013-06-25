<?php

$this->breadcrumbs=array(
	Yii::t('core', 'Manage Block Types') =>array('index'),
	Yii::t('core', 'Create'),
);

$this->renderPartial('_menuBlock');
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('core', 'Create') . ' ' . Yii::t('core', 'Blocktypes'); ?>
</h1>

<?php $this->renderPartial('_formBlockType', array('model'=>$model)); ?>

