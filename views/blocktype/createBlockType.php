<?php

$this->breadcrumbs=array(
	Yii::t('core', 'Manage Block Types') =>array('index'),
	Yii::t('core', 'Create'),
);

$this->renderPartial('_menuBlockType');
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('core', 'Create Block Type'); ?>
</h1>

<?php $this->renderPartial('_formBlockType', array('model'=>$model)); ?>

